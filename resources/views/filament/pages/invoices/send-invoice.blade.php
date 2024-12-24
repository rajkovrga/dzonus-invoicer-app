<x-filament::page class="w-full ">
    <div>
        <form>
            {{ $this->form }}
            <div class="py-3">
                <x-filament::button class="w-full" wire:click="sendInvoice">Send invoice</x-filament::button>
            </div>
        </form>
    </div>
</x-filament::page>
