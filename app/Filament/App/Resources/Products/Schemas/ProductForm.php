<?php

namespace App\Filament\App\Resources\Products\Schemas;

use App\Models\Unit;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use App\Traits\HasEnglishToArabic;

class ProductForm
{
    use HasEnglishToArabic;
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image')
                    ->image(),

                TextInput::make('name')
                    ->required(),
                TextInput::make('arabic_name')
                    ->default(null)
                    ->suffixAction(self::englishToArabic('name', 'arabic_name')),
                TextInput::make('code')
                    ->required(),
                TextInput::make('description')
                    ->default(null),

                Select::make('category_id')
                    ->relationship('category', 'name')->preload()->required(),

                TextInput::make('sale_price')
                    ->numeric()
                    ->default(null),
                TextInput::make('pruchase_price')
                    ->numeric()
                    ->default(null),
                Toggle::make('is_taxable')
                    ->required()->default(false)->live(),
                TextInput::make('tax_rate')
                    ->numeric()
                    ->default(null)->visible(fn (Get $get) => $get('is_taxable')),

                TextInput::make('minimum_stock_level')
                    ->numeric()
                    ->default(null),
                TextInput::make('maximum_stock_level')
                    ->numeric()
                    ->default(null),
                TextInput::make('mrp')
                    ->numeric()
                    ->default(null),

                Select::make('unit_id')
                    ->relationship('unit', 'name')->preload()->required()->live(),

                Toggle::make('is_multi_unit')
                    ->default(false)->visible(fn (Get $get) => ! empty($get('unit_id')))->live(),
                Repeater::make('multi_units')
                    ->label('Multi Measuring Units')
                    ->maxItems(fn (Get $get) => Unit::where('unit_id', $get('unit_id'))->count('id') + 1)
                    ->columnSpanFull()
                    ->columns(5)
                    ->live()
                    ->schema([
                        Select::make('unit_id')
                            ->label('Measuring Unit')
                            ->options(function (Get $get) {
                                $unitId = $get('../../unit_id');
                                // dd($unitId, $get);
                                if (! $unitId) {
                                    return [];
                                }

                                $unit = Unit::find($unitId);
                                if (! $unit) {
                                    return [];
                                }

                                return Unit::where('unit_id', $unit->id)->orWhere('id', $unit->id)
                                    ->orWhere('id', $unit->unit_id)
                                    ->pluck('name', 'id')
                                    ->toArray();
                            })->afterStateUpdated(function (Set $set, Get $get) {
                                $selectedUnitId = $get('unit_id');
                                if (! $selectedUnitId) {
                                    $set('unit_name', null);
                                    $set('unit_short_name', null);

                                    return;
                                }

                                $unit = Unit::find($selectedUnitId);
                                if (! $unit) {
                                    return;
                                }

                                $set('unit_name', $unit->name);
                                $set('unit_short_name', $unit->short_name);
                            })
                            ->afterStateHydrated(function (Set $set, Get $get) {
                                $selectedUnitId = $get('unit_id');
                                if (! $selectedUnitId) {
                                    return;
                                }

                                $unit = Unit::find($selectedUnitId);
                                if (! $unit) {
                                    return;
                                }

                                $set('unit_name', $unit->name);
                                $set('unit_short_name', $unit->short_name);
                            })->live(),

                        TextInput::make('unit_name')->readOnly(),
                        TextInput::make('unit_short_name')->readOnly(),
                        TextInput::make('sale_price')->numeric()->default(fn (Get $get) => $get('../../sale_price') ?? null),
                        TextInput::make('pruchase_price')->numeric()->default(fn (Get $get) => $get('../../pruchase_price') ?? null),
                    ])
                    ->visible(fn (Get $get) => $get('is_multi_unit'))
                    ->live(),
                Textarea::make('remarks')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('element_used')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('hsnCode')
                    ->default(null),
                TextInput::make('avg_quantity')
                    ->numeric()
                    ->default(null),
                Toggle::make('low_stock_alert')
                    ->required()->default(false),
                Toggle::make('is_active')
                    ->required()->default(true),
            ]);
    }
}
