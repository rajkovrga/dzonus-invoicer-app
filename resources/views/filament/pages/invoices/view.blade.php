<x-filament::page>
    {{ $this->infolist }}
    <div class="border-t border-gray-600 flex justify-between pt-3 pt-6 gap-3">
        <div>
            <h3 class="text-lg font-medium filament-breezy-grid-title">Generate Invoice in PDF</h3>

            <p class="mt-1 text-sm text-gray-500 filament-breezy-grid-description">
                Generate and download invoice in pdf format
            </p>
        </div>
        <div>
            <x-filament::button wire:click="generatePdf">Generate</x-filament::button>
        </div>
    </div>

    <div class="border-t border-gray-600 flex justify-between pt-3 pt-6 gap-3">
        <div>
            <h3 class="text-lg font-medium filament-breezy-grid-title">Generate and send invoice</h3>

            <p class="mt-1 text-sm text-gray-500 filament-breezy-grid-description">
                Generate and send invoice to client
            </p>
        </div>
        <div>
            <div class="p-2 flex justify-end">
                <x-filament::button tag="a" href="{{ route('filament.admin.pages.send-invoice', ['invoiceId' => $this->record->id]) }}" class="m-2">Generate and send</x-filament::button>
            </div>
        </div>
    </div>
</x-filament::page>
