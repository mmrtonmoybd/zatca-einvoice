<?php

namespace App\Filament\App\Resources\Sales\Tables;

use App\Models\Product;
use App\Models\Sale;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
// use Filament\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;

class SalesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('bill_number')
                    ->searchable(),
                TextColumn::make('date')
                    ->date()
                    ->sortable(),
                TextColumn::make('customer_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('po_eference')
                    ->searchable(),
                TextColumn::make('delivery_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('final_total_amount')
                    ->numeric()
                    ->label('Total')
                    ->summarize(Sum::make()->money('SAR')->label(''))
                    ->sortable(),
                TextColumn::make('final_total_tax')
                    ->numeric()
                    ->label('Tax')
                    ->summarize(Sum::make()->money('SAR')->label(''))
                    ->sortable(),
                TextColumn::make('grand_total')
                    ->numeric()
                    ->label('Grand Total')
                    ->summarize(Sum::make()->money('SAR')->label(''))
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_active')
                    ->boolean(),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                Filter::make('bill_number')
                    ->schema([
                        TextInput::make('bill_number')->placeholder('Search By bill number'),
                    ])->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['bill_number'],
                            fn (Builder $query, $bill_number): Builder => $query->where('bill_number', 'LIKE', '%'.$bill_number.'%'),
                        );
                    }),

                DateRangeFilter::make('date'),

                Filter::make('customer_id')
                    ->schema([
                        Select::make('customer_id')->relationship('customer', 'name'),
                    ])->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['customer_id'],
                            fn (Builder $query, $customer_id): Builder => $query->where('customer_id', 'LIKE', '%'.$customer_id.'%'),
                        );
                    }),

                Filter::make('type')
                    ->schema([
                        Select::make('type')
                            ->required()
                            ->options([
                                'credit' => 'Credit',
                                'cash' => 'Cash',
                            ]),
                    ])->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['type'],
                            fn (Builder $query, $type): Builder => $query->where('type', 'LIKE', '%'.$type.'%'),
                        );
                    }),

                Filter::make('po_eference')
                    ->label('PO.Ref Number')
                    ->schema([
                        TextInput::make('po_eference')->placeholder('Search By PO.Ref Number'),
                    ])->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['po_eference'],
                            fn (Builder $query, $po_eference): Builder => $query->where('po_eference', 'LIKE', '%'.$po_eference.'%'),
                        );
                    }),

                Filter::make('customer_id')
                    ->schema([
                    Select::make('product_id')
                        ->label('Product')
                        ->options(fn () => Product::where('team_id', auth()->user()->currentTeam->id)->pluck('name', 'id')),
                    ])->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['product_id'],
                            function (Builder $query, $product_id) {
                                $query->where(function ($q) use ($product_id) {
                                    $q->whereRaw("JSON_SEARCH(products, 'one', ?, NULL, '$[*].product_id') IS NOT NULL", [$product_id]);
                                });
                            }
                        );

                    }),

                Filter::make('grand_total')
                    ->label('grand_total')
                    ->schema([
                    TextInput::make('grand_total')->placeholder('Search By grand total'),
                    ])->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['grand_total'],
                            fn (Builder $query, $grand_total): Builder => $query->where('grand_total', 'LIKE', '%'.$grand_total.'%'),
                        );
                    }),

                DateRangeFilter::make('due_date'),

                Filter::make('narration')
                    ->schema([
                    TextInput::make('narration')->placeholder('Search By narration'),
                    ])->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['narration'],
                            fn (Builder $query, $narration): Builder => $query->where('narration', 'LIKE', '%'.$narration.'%'),
                        );
                    }),

                TernaryFilter::make('is_vat')
                    ->label('Search by TAX')
                    ->placeholder('All')
                    ->trueLabel('Tax Included')
                    ->falseLabel('Tax Excluded')
                    ->nullable()
                    ->queries(
                        true: fn (Builder $query) => $query->where('is_vat', 1),
                        false: fn (Builder $query) => $query->where('is_vat', 0),
                        blank: fn (Builder $query) => $query, // In this example, we do not want to filter the query when it is blank.
                    ),

            ], layout: FiltersLayout::AboveContent)
            ->filtersFormColumns(4)
            ->deferFilters(false)
            ->recordActions([
                Action::make('download invoice with header')
                    ->url(fn (Sale $record) => route('sale.invoice2.pdf', $record))
                    ->icon('heroicon-s-printer')
                    ->iconButton()
                    ->visible(fn () => auth()->user()->currentTeam->is_with_header)
                   // ->tableIcon('heroicon-s-printer')
                    ->openUrlInNewTab(),
                Action::make('download invoice without header')
                    ->url(fn (Sale $record) => route('sale.invoice.pdf', $record))
                    ->icon('heroicon-s-printer')
                    ->iconButton()
                   // ->tableIcon('heroicon-s-printer')
                    ->openUrlInNewTab(),
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
