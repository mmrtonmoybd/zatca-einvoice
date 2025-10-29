<?php

namespace App\Traits;

use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Subhashladumor1\Translate\Facades\Translate;

trait HasEnglishToArabic
{
    /**
     * Create a reusable suffixAction that translates from English field → Arabic field.
     */
   public static function englishToArabic(string $englishField, string $arabicField, string $label = 'Translate'): Action
    {
        $actionName = 'translate_' . $arabicField;

        return Action::make($actionName)
            ->label($label)
            ->icon('heroicon-o-language')
            ->color('info')
            ->outlined()
            ->tooltip('Translate from English')
            // disable button while this action is running
            ->extraAttributes([
                'wire:loading.attr' => 'disabled',
                'wire:target' => $actionName,
                // keep layout consistent
                'class' => 'flex items-center',
            ])
            ->action(function (callable $get, callable $set) use ($englishField, $arabicField) {
                $englishValue = $get($englishField);

                if (blank($englishValue)) {
                    Notification::make()->title("No English value found for '{$englishField}'")->danger()->send();
                    return;
                }

                if (\is_numeric($englishValue)) {
                    // Assuming toArabicIndicDigits is a defined function/method available
                    try {
                        // Convert numeric value to Arabic Indic Digits
                        $converted = toArabicIndicDigits($englishValue); 
                    } catch (\Throwable $e) {
                         Notification::make()->title('Conversion to Arabic Indic Digits failed: '.$e->getMessage())->danger()->send();
                         return;
                    }
                    
                    if (blank($converted)) {
                        Notification::make()->title('No Arabic Indic Digits conversion result returned')->danger()->send();
                        return;
                    }
                    
                    $set($arabicField, $converted);
                    Notification::make()->title('Converted to Arabic Indic Digits successfully!')->success()->send();
                    return; // Stop execution, translation service is not needed
                }

                try {
                    $translated = Translate::translate($englishValue, 'ar');
                } catch (\Throwable $e) {
                    Notification::make()->title('Translation failed: '.$e->getMessage())->danger()->send();
                    return;
                }

                if (blank($translated)) {
                    Notification::make()->title('No translation result returned')->danger()->send();
                    return;
                }

                $set($arabicField, $translated);
                Notification::make()->title('Translated successfully!')->success()->send();
            });
    }
}
