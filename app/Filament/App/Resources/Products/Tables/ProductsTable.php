<?php

namespace App\Filament\App\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
// use Filament\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // ImageColumn::make('image'),

                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('category.name')
                    // ->numeric()
                    ->searchable(),
                // TextColumn::make('arabic_name')->searchable(),
                TextColumn::make('code')->searchable(),
                // TextColumn::make('description')->searchable(),
                TextColumn::make('tax_rate')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('sale_price')->numeric()->sortable(),
                TextColumn::make('pruchase_price')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_taxable')->boolean(),

                // TextColumn::make('minimum_stock_level')
                // ->numeric()
                // ->sortable(),
                // TextColumn::make('maximum_stock_level')
                // ->numeric()
                // ->sortable(),
                // TextColumn::make('mrp')
                // ->numeric()
                // ->sortable(),
                // IconColumn::make('is_multi_unit')
                // ->boolean(),
                // TextColumn::make('hsnCode')
                // ->searchable(),
                // TextColumn::make('avg_quantity')
                // ->numeric()
                // ->sortable(),
                // IconColumn::make('low_stock_alert')
                // ->boolean(),
                IconColumn::make('is_active')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                Filter::make('name')
                    ->schema([
                        TextInput::make('name')->placeholder('Search By name'),
                    ])->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['name'],
                            fn (Builder $query, $name): Builder => $query->where('name', 'LIKE', '%'.$name.'%'),
                        );
                    }),

                Filter::make('code')
                    ->schema([
                        TextInput::make('code')->placeholder('Search By code'),
                    ])->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['code'],
                            fn (Builder $query, $code): Builder => $query->where('code', 'LIKE', '%'.$code.'%'),
                        );
                    }),

                Filter::make('category')
                    ->schema([
                            Select::make('category_id')
                                ->relationship('category', 'name')->preload(),
                        ])->query(function (Builder $query, array $data): Builder {
                            return $query->when(
                                $data['category_id'],
                                fn (Builder $query, $category_id): Builder => $query->where('category_id', $category_id),
                            );
                        }),

                Filter::make('arabic_name')
                    ->schema([
                                TextInput::make('arabic_name')->placeholder('Search By arabic name'),
                            ])->query(function (Builder $query, array $data): Builder {
                                return $query->when(
                                    $data['arabic_name'],
                                    fn (Builder $query, $arabic_name): Builder => $query->where('arabic_name', 'LIKE', '%'.$arabic_name.'%'),
                                );
                            }),
            ], layout: FiltersLayout::AboveContent)
            ->filtersFormColumns(4)
            ->deferFilters(false)
            ->recordActions([
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
