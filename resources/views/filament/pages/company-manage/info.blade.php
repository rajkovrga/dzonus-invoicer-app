<x-filament-panels::page>
    {{ $this->infolist }}
    <div class="border-t border-gray-600 flex justify-between pt-3 pt-6 gap-3">
        <div>
            <h3 class="text-lg font-medium filament-breezy-grid-title">Generate KPO</h3>

            <p class="mt-1 text-sm text-gray-500 filament-breezy-grid-description">
                Generate and download KPO for this company
            </p>
        </div>
        <div>
            <x-filament::button wire:click="generateKpo">Download</x-filament::button>
        </div>
    </div>
</x-filament-panels::page>
