<?php

namespace App\Filament\Admin\Resources\Teams\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class TeamForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label(__('Owner'))
                    ->relationship('owner', 'name')
                    ->required(),
                TextInput::make('name')
                    ->required(),

                DatePicker::make('expires_at')->label('Expiration Date'),
                Toggle::make('is_active')->default(true),
                Toggle::make('is_with_header')->label('Include Bannar in Invoice')->default(false)->live(),

                FileUpload::make('header_bannar')
                    ->label('Invoice Header Bannar')
                    ->requiredIfAccepted('is_with_header')
                    ->image()
                    ->visible(fn (Get $get) => $get('is_with_header')),

                FileUpload::make('footer_bannar')
                    ->label('Invoice Footer Bannar')
                    ->requiredIfAccepted('is_with_header')
                    ->image()
                    ->visible(fn (Get $get) => $get('is_with_header')),

            ]);
    }
}
