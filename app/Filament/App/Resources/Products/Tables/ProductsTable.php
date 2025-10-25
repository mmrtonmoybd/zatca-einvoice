<?php

namespace App\Filament\App\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

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
            ->filters([
                //
            ])
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
