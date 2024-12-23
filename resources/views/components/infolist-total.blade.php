@php
    $total = collect($this->record->invoiceItems)->sum(function ($item) {
        return $item->price * $item->quantity;
    });
    $currency = $this->record->currency->symbol ?? '';
@endphp

<div class="text-right">
    <span class="text-lg font-bold">Total:</span>
    <span class="text-2xl font-bold">{{ number_format($total, 2) }} {{ $currency }}</span>
</div>
