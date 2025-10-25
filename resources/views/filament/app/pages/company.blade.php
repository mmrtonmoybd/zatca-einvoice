<x-filament-panels::page>
    {{-- Page content --}}
    <form wire:submit.prevent="save">
        {{ $this->form }}
        <br>
            <x-filament::button
                type="submit"
                
                class="w-full mt-10"
                size="lg"
                icon="heroicon-m-sparkles"
                >
                {{ Filament\Facades\Filament::getTenant()->company ? 'Update Company' : 'Create Company' }}
            </x-filament::button>
    </form>
    
</x-filament-panels::page>
