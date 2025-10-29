<?php

namespace App\Filament\App\Pages;

use App\Models\Team;
use App\Traits\HasEnglishToArabic;
use BackedEnum;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;
use Filament\Support\Exceptions\Halt;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class Company extends Page implements HasForms
{
    use InteractsWithForms, HasEnglishToArabic;

    public ?array $data = [];

    protected static string|UnitEnum|null $navigationGroup = 'Admisnistration';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Company Info';

    protected static ?string $slug = 'company';

    protected string $view = 'filament.app.pages.company';

    /**
     * Mount form — prefill if company exists
     */
    public function mount(): void
    {
        $tenant = Filament::getTenant();

        if (! $tenant) {
            return;
        }

        $company = $tenant->company;

        if ($company) {
            // Prefill form for existing company
            $this->form->fill($company->attributesToArray());
        } else {
            // Leave form empty for first-time creation
            $this->form->fill();
        }
    }

    public static function canAccess(): bool
    {
        // dd(auth()->user()->current_team_id);
        $team = Team::find(auth()->user()->current_team_id);

        return (bool) ($team && $team->user_id === auth()->user()->id);
    }

    /**
     * Define form fields
     */
    public function form(Schema $form): Schema
    {
        return $form
            ->components([
                Tabs::make('CompanyTabs')
                    ->tabs([
                        Tabs\Tab::make('Company Information')
                            ->schema([
                                Grid::make(12)->schema([
                                    TextInput::make('name')
                                        ->label('Company Name')
                                        ->required()
                                        ->columnSpan(6),
                                    TextInput::make('arabic_name')
                                        ->label('Arabic Name')
                                        ->required()
                                        ->suffixAction($this->englishToArabic('name', 'arabic_name'))
                                        ->columnSpan(6),

                                    TextInput::make('address')
                                        ->label('Address')
                                        ->required()
                                        ->columnSpan(6),
                                    TextInput::make('arabic_address')
                                        ->label('Arabic Address')
                                        ->suffixAction($this->englishToArabic('address', 'arabic_address'))
                                        ->required()
                                        ->columnSpan(6),

                                    TextInput::make('vat_number')
                                        ->label('VAT Number')
                                        ->required()
                                        ->columnSpan(6),
                                    TextInput::make('arabic_vat_number')
                                        ->label('Arabic VAT Number')
                                        ->suffixAction($this->englishToArabic('vat_number', 'arabic_vat_number'))
                                        ->required()
                                        ->columnSpan(6),

                                    TextInput::make('cr_no')
                                        ->label('CR No')
                                        ->required()
                                        ->columnSpan(6),
                                    TextInput::make('arabic_cr_no')
                                        ->label('Arabic CR No')
                                        ->suffixAction($this->englishToArabic('cr_no', 'arabic_cr_no'))
                                        ->required()
                                        ->columnSpan(6),
                                ]),
                            ]),

                        Tabs\Tab::make('Bank Details')
                            ->schema([
                                Grid::make(12)->schema([
                                    TextInput::make('bank_account_name')
                                        ->label('Bank Account Name')
                                        ->columnSpan(6),
                                    TextInput::make('arabic_bank_account_name')
                                        ->label('Arabic Bank Account Name')
                                        ->suffixAction($this->englishToArabic('bank_account_name', 'arabic_bank_account_name'))
                                        ->columnSpan(6),

                                    TextInput::make('bank_name')
                                        ->label('Bank Name')
                                        ->columnSpan(6),
                                    TextInput::make('arabic_bank_name')
                                        ->label('Arabic Bank Name')
                                        ->suffixAction($this->englishToArabic('bank_name', 'arabic_bank_name'))
                                        ->columnSpan(6),

                                    TextInput::make('bank_account_number')
                                        ->label('Account No')
                                        ->columnSpan(6),
                                    TextInput::make('arabic_bank_account_number')
                                        ->label('Arabic Account No')
                                        ->suffixAction($this->englishToArabic('bank_account_number', 'arabic_bank_account_number'))
                                        ->columnSpan(6),

                                    TextInput::make('iban')
                                        ->label('IBAN')
                                        ->columnSpan(6),
                                    TextInput::make('arabic_iban')
                                        ->label('Arabic IBAN')
                                        ->suffixAction($this->englishToArabic('iban', 'arabic_iban'))
                                        ->columnSpan(6),

                                    TextInput::make('bank_swift_code')
                                        ->label('SWIFT Code')
                                        ->columnSpan(6),
                                ]),
                            ]),
                    ]),
            ])
            ->statePath('data');
    }

    /**
     * Save or update company
     */
    public function save(): void
    {
        $tenant = Filament::getTenant();

        if (! $tenant) {
            Notification::make()
                ->danger()
                ->title('Tenant not found.')
                ->send();

            return;
        }

        $data = $this->form->getState();

        try {
            if ($tenant->company) {
                // Update existing company
                $tenant->company->update($data);

                Notification::make()
                    ->success()
                    ->title('Company updated successfully.')
                    ->send();
            } else {
                // Create new company
                $tenant->company()->create($data);

                Notification::make()
                    ->success()
                    ->title('Company created successfully.')
                    ->send();
            }
        } catch (Halt $exception) {
            return;
        }
    }
}
