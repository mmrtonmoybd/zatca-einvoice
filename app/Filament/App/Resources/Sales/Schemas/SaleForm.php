<?php

namespace App\Filament\App\Resources\Sales\Schemas;

use App\Models\Product;
use App\Models\Sale;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class SaleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('bill_number')
                    ->required()
                    ->readonly()
                    ->default(function () {
                        $lastSale = Sale::latest()
                            ->where('team_id', auth()->user()->currentTeam->id)
                            ->first();

                        $lastNumber = $lastSale ? intval(ltrim($lastSale->bill_number, 'SL-')) : 0;

                        return 'SL-'.($lastNumber + 1);
                    }),

                DatePicker::make('date')->required(),
                TextInput::make('narration')->default(null)->columnSpanFull(),
                Select::make('customer_id')->required()->relationship('customer', 'name'),
                Select::make('type')
                    ->required()
                    ->options([
                        'credit' => 'Credit',
                        'cash' => 'Cash',
                    ])
                    ->default('credit'),
                TextInput::make('po_eference')->default(null),
                DatePicker::make('delivery_date'),
                TextInput::make('dn_reference')->default(null),
                DatePicker::make('due_date'),
                Toggle::make('is_vat')->required()->default(true)->live(),
                TextInput::make('payment_terms')->default(null),
                TextInput::make('invoice_period')->default(null),
                TextInput::make('project_reference')->default(null),

                // ------------------ Repeater ------------------
                Repeater::make('products')
                    ->live()
                    ->reactive()
                    ->afterStateHydrated(fn (Get $get, Set $set) => self::updateTotals($get, $set))
                    ->afterStateUpdated(fn (Get $get, Set $set) => self::updateTotals($get, $set))
                    ->deleteAction(fn ($action) => $action->after(fn (Get $get, Set $set) => self::updateTotals($get, $set)))
                    ->columnSpanFull()
                    ->columns(12)
                    ->extraAttributes(['class' => 'overflow-x-auto min-w-max'])
                    ->required()
                    ->schema([
                        Select::make('product_id')
                            ->label('Product')
                            ->options(fn () => Product::where('team_id', auth()->user()->currentTeam->id)->pluck('name', 'id'))
                            ->required()->columnSpan(2)
                            ->afterStateUpdated(function (Get $get, Set $set) {
                                $product = Product::find($get('product_id'));
                                if (! $product) {
                                    $set('unit_id', null);
                                    $set('sale_price', 0);

                                    return;
                                }

                                // Auto-select first available unit when product changes
                                if ($product->is_multi_unit && is_array($product->multi_units) && count($product->multi_units) > 0) {
                                    $first = $product->multi_units[0];
                                    $set('unit_id', $first['unit_id']);
                                    $set('sale_price', $first['sale_price']);
                                } elseif ($product->unit) {
                                    $set('unit_id', $product->unit->id);
                                    $set('sale_price', $product->sale_price);
                                }

                                self::updateTotals($get, $set);
                            }),

                        Select::make('unit_id')
                            ->label('Unit')
                            ->options(function (Get $get) {
                                $product = Product::find($get('product_id'));
                                if (! $product) {
                                    return [];
                                }

                                if ($product->is_multi_unit && is_array($product->multi_units)) {
                                    return collect($product->multi_units)
                                        ->mapWithKeys(fn ($unit) => [
                                            $unit['unit_id'] => "{$unit['unit_short_name']} (Sale: {$unit['sale_price']})",
                                        ])
                                        ->toArray();
                                }

                                if ($product->unit) {
                                    return [
                                        $product->unit->id => "{$product->unit->short_name} (Sale: {$product->sale_price})",
                                    ];
                                }

                                return [];
                            })
                            ->reactive()
                            ->afterStateUpdated(function (Get $get, Set $set, $state) {
                                $product = Product::find($get('product_id'));
                                if (! $product) {
                                    return;
                                }

                                // Handle multi-unit products
                                if ($product->is_multi_unit && is_array($product->multi_units)) {
                                    $selected = collect($product->multi_units)->firstWhere('unit_id', $state);
                                    if ($selected) {
                                        $set('sale_price', $selected['sale_price']);
                                    }
                                } else {
                                    // Single-unit product fallback
                                    $set('sale_price', $product->sale_price);
                                }

                                self::updateTotals($get, $set);
                            })
                            ->afterStateHydrated(function (Get $get, Set $set, $state) {
                                $product = Product::find($get('product_id'));
                                if (! $product) {
                                    return;
                                }

                                if ($product->is_multi_unit && is_array($product->multi_units)) {
                                    $selected = collect($product->multi_units)->firstWhere('unit_id', $state)
                                        ?? collect($product->multi_units)->first();
                                    if ($selected) {
                                        $set('unit_id', $selected['unit_id']);
                                        $set('sale_price', $selected['sale_price']);
                                    }
                                } else {
                                    if ($product->unit) {
                                        $set('unit_id', $product->unit->id);
                                        $set('sale_price', $product->sale_price);
                                    }
                                }

                                self::updateTotals($get, $set);
                            })
                            ->columnSpan(2),

                        // ---------- Quantity & Prices ----------
                        TextInput::make('quantity')
                            ->numeric()
                            ->default(1)
                            ->required()
                            ->columnSpan(1)
                            ->reactive()
                            ->afterStateUpdated(fn (Get $get, Set $set) => self::updateTotals($get, $set)),

                        TextInput::make('sale_price')
                            ->numeric()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn (Get $get, Set $set) => self::updateTotals($get, $set)),

                        TextInput::make('discount')
                            ->numeric()
                            ->default(0)
                            ->afterStateUpdated(fn (Get $get, Set $set) => self::updateTotals($get, $set)),

                        TextInput::make('vat')
                            ->numeric()
                            ->label('VAT %')
                            ->default(0)
                            ->visible(fn (Get $get) => $get('../../is_vat'))
                            ->afterStateUpdated(fn (Get $get, Set $set) => self::updateTotals($get, $set)),

                        // ---------- Calculated Fields ----------
                        TextInput::make('product_total')->numeric()->readOnly()->reactive(),
                        TextInput::make('after_discount_total')->numeric()->readOnly()->reactive(),
                        TextInput::make('total_tax')->numeric()->readOnly()->reactive(),
                        TextInput::make('total_amount')->numeric()->readOnly()->reactive(),
                    ]),

                // ------------------ Top-level totals ------------------
                TextInput::make('final_total_amount')->numeric()->readOnly()->reactive(),
                TextInput::make('final_total_tax')->numeric()->readOnly()->reactive(),
                TextInput::make('total_product_discount')->numeric()->readOnly()->reactive(),
                TextInput::make('total_cash_discount')
                    ->numeric()
                    ->default(0)
                    ->live()
                    ->reactive()
                    ->afterStateUpdated(fn (Get $get, Set $set) => self::updateTotals($get, $set)),

                TextInput::make('grand_total')->numeric()->readOnly()->reactive(),

                FileUpload::make('file')->default(null),
                Toggle::make('is_active')->required()->default(true),
            ]);
    }

    // ------------------ Per-row and top-level calculations ------------------
    protected static function updateTotals(Get $get, Set $set): void
    {
        // Get the raw repeater array (preserves keys)
        $allRows = $get('products') ?? [];

        $totalAmount = 0;
        $totalTax = 0;
        $totalDiscount = 0;

        foreach ($allRows as $index => $row) {
            // if this row has no product selected, clear its calculated fields and skip
            if (empty($row['product_id'])) {
                $set("products.$index.product_total", 0);
                $set("products.$index.after_discount_total", 0);
                $set("products.$index.total_tax", 0);
                $set("products.$index.total_amount", 0);

                continue;
            }

            // Retrieve canonical sale price from product + selected unit (do NOT trust the row value alone)
            $sale_price = 0.0;
            $product = Product::find($row['product_id']);

            if ($product) {
                if ($product->is_multi_unit && is_array($product->multi_units)) {
                    $unitId = $row['unit_id'] ?? null;
                    $selected = collect($product->multi_units)->firstWhere('unit_id', $unitId)
                        ?? collect($product->multi_units)->first(); // fallback to first
                    if ($selected) {
                        $sale_price = floatval($selected['sale_price'] ?? 0);
                    } else {
                        $sale_price = floatval($product->sale_price ?? 0);
                    }
                } else {
                    $sale_price = floatval($product->sale_price ?? 0);
                }
            } else {
                $sale_price = floatval($row['sale_price'] ?? 0);
            }

            // write canonical sale_price back for this row
            $set("products.$index.sale_price", $sale_price);

            $qty = floatval($row['quantity'] ?? 0);
            $discount = floatval($row['discount'] ?? 0);
            $vatPercent = floatval($get('is_vat') ? ($row['vat'] ?? 0) : 0);

            $product_total = $qty * $sale_price;
            $after_discount_total = $product_total - $discount;
            $tax = ($after_discount_total * $vatPercent) / 100;
            $row_total_amount = $after_discount_total + $tax;

            // Fill per-row values using the original index
            $set("products.$index.product_total", $product_total);
            $set("products.$index.after_discount_total", $after_discount_total);
            \Log::info($tax);
            $set("products.$index.total_tax", $tax);
            $set("products.$index.total_amount", $row_total_amount);

            // accumulate top-level totals
            $totalAmount += $row_total_amount;
            $totalTax += $tax;
            $totalDiscount += $discount;
        }

        $totalCashDiscount = $get('total_cash_discount') ?? 0;
        $grandTotal = $totalAmount - $totalCashDiscount;

        // Set top-level totals
        $set('final_total_amount', $totalAmount);
        $set('final_total_tax', $totalTax);
        $set('total_product_discount', $totalDiscount);
        $set('grand_total', $grandTotal);
    }
}
