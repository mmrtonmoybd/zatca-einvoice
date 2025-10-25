<?php

namespace App\Filament\App\Resources\Sales\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SaleInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('team_id')
                    ->numeric(),
                TextEntry::make('bill_number'),
                TextEntry::make('date')
                    ->date(),
                TextEntry::make('narration')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('customer_id')
                    ->numeric(),
                TextEntry::make('type'),
                TextEntry::make('po_eference')
                    ->placeholder('-'),
                TextEntry::make('delivery_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('dn_reference')
                    ->placeholder('-'),
                TextEntry::make('due_date')
                    ->date()
                    ->placeholder('-'),
                IconEntry::make('is_vat')
                    ->boolean(),
                TextEntry::make('payment_terms')
                    ->placeholder('-'),
                TextEntry::make('invoice_period')
                    ->placeholder('-'),
                TextEntry::make('project_reference')
                    ->placeholder('-'),
                TextEntry::make('total_product_discount')
                    ->numeric(),
                TextEntry::make('total_cash_discount')
                    ->numeric(),

                TextEntry::make('file')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                IconEntry::make('is_active')
                    ->boolean(),
            ]);
    }
}
