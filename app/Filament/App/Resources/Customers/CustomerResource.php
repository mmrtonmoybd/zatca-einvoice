<?php

namespace App\Filament\App\Resources\Customers;

use App\Filament\App\Resources\Customers\Pages\ManageCustomers;
use App\Models\Customer;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;
use App\Traits\HasEnglishToArabic;

class CustomerResource extends Resource
{
    use HasEnglishToArabic;
    protected static string|UnitEnum|null $navigationGroup = 'Masters';

    protected static ?int $navigationSort = 3;

    protected static ?string $model = Customer::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Customer';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('display_name')
                    ->default(null),
                TextInput::make('arabic_name')
                    ->default(null)->suffixAction(self::englishToArabic('name', 'arabic_name')),
                TextInput::make('address')
                    ->required(),
                TextInput::make('arabic_address')
                    ->default(null)->suffixAction(self::englishToArabic('address', 'arabic_address')),
                TextInput::make('code')
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->default(null),
                TextInput::make('mobile')
                    ->default(null),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->default(null),
                TextInput::make('vat_no')
                    ->default(null),
<<<<<<< HEAD
                    TextInput::make('arabic_vat_no')
                    ->default(null)->suffixAction(self::englishToArabic('vat_no', 'arabic_vat_no')),
=======
                TextInput::make('arabic_vat_no')
                    ->default(null),
>>>>>>> refs/remotes/origin/main
                TextInput::make('cr_no')
                    ->default(null),
                TextInput::make('arabic_cr_no')
                    ->default(null)->suffixAction(self::englishToArabic('cr_no', 'arabic_cr_no')),
                TextInput::make('contact_person')
                    ->default(null),
                FileUpload::make('file')
                    ->default(null),
                Toggle::make('is_active')
                    ->required()->default(true),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('display_name')
                    ->placeholder('-'),
                TextEntry::make('arabic_name')
                    ->placeholder('-'),
                TextEntry::make('address'),
                TextEntry::make('arabic_address')
                    ->placeholder('-'),
                TextEntry::make('code'),
                TextEntry::make('phone')
                    ->placeholder('-'),
                TextEntry::make('mobile')
                    ->placeholder('-'),
                TextEntry::make('email')
                    ->label('Email address')
                    ->placeholder('-'),
                TextEntry::make('vat_no')
                    ->placeholder('-'),
                TextEntry::make('cr_no')
                    ->placeholder('-'),
                TextEntry::make('contact_person')
                    ->placeholder('-'),
                IconEntry::make('is_active')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Customer')
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                /*
                TextColumn::make('display_name')
                    ->searchable(),
                TextColumn::make('arabic_name')
                    ->searchable(),

                    */

                /*
                TextColumn::make('arabic_address')
                    ->searchable(),
                    */
                TextColumn::make('code')
                    ->searchable(),
                // TextColumn::make('phone')->searchable(),
                TextColumn::make('mobile')
                    ->searchable(),
                // TextColumn::make('email')->label('Email address') ->searchable(),
                TextColumn::make('vat_no')
                    ->searchable(),

                TextColumn::make('address')
                    ->searchable(),
                // TextColumn::make('cr_no')->searchable(),
                // TextColumn::make('contact_person')->searchable(),
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

    public static function getPages(): array
    {
        return [
            'index' => ManageCustomers::route('/'),
        ];
    }
}
