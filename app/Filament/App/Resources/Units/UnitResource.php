<?php

namespace App\Filament\App\Resources\Units;

use App\Filament\App\Resources\Units\Pages\ManageUnits;
use App\Models\Unit;
use App\Traits\HasEnglishToArabic;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
// use Filament\QueryBuilder\Constraints\TextConstraint;
use UnitEnum;

class UnitResource extends Resource
{
    use HasEnglishToArabic;

    protected static string|UnitEnum|null $navigationGroup = 'Masters';

    protected static ?int $navigationSort = 2;

    protected static ?string $model = Unit::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Measuring Unit';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('short_name')
                    ->required(),
                TextInput::make('arabic_name')
                    ->default(null)
                    ->suffixAction(self::englishToArabic('name', 'arabic_name')),
                TextInput::make('quantity')
                    ->required()
                    ->numeric(),

                Toggle::make('is_child')
                    ->required()->default(false)->live(),
                Select::make('unit_id')
                    ->relationship('unit', 'name')
                    ->preload()->visible(fn (Get $get) => $get('is_child')),
                Toggle::make('is_active')
                    ->required()->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Measuring Unit')
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('short_name')
                    ->searchable(),
                TextColumn::make('arabic_name')
                    ->searchable(),
                TextColumn::make('quantity')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->boolean(),
                IconColumn::make('is_child')
                    ->boolean(),
                TextColumn::make('unit.name')
                    ->searchable(),
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
                Filter::make('name')
                    ->schema([
                        TextInput::make('name')->placeholder('Search By name'),
                    ])->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['name'],
                            fn (Builder $query, $name): Builder => $query->where('name', 'LIKE', '%'.$name.'%'),
                        );
                    }),

                Filter::make('short_name')
                    ->schema([
                        TextInput::make('short_name')->placeholder('Search By short name'),
                    ])->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['short_name'],
                            fn (Builder $query, $name): Builder => $query->where('short_name', 'LIKE', '%'.$name.'%'),
                        );
                    }),

                TernaryFilter::make('is_child')
                    ->label('Is Child Unit?')
                    ->placeholder('All Units')
                    ->nullable()
                    ->queries(
                        true: fn (Builder $query) => $query->where('is_child', '!=', 0),
                        false: fn (Builder $query) => $query->where('is_child', '=', 0),
                        blank: fn (Builder $query) => $query, // In this example, we do not want to filter the query when it is blank.
                    ),
            ], layout: FiltersLayout::AboveContent)
            ->filtersFormColumns(3)
            ->deferFilters(false)
            ->recordActions([
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
            'index' => ManageUnits::route('/'),
        ];
    }
}
