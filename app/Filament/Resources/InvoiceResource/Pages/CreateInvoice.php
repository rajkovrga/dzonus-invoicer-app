<?php

namespace App\Filament\Resources\InvoiceResource\Pages;

use App\Filament\Resources\InvoiceResource;
use App\Repositories\InvoiceRepository;
use Filament\Actions;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\CreateRecord;

class CreateInvoice extends CreateRecord
{
    protected static string $resource = InvoiceResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        $data['company_id'] = auth()->user()->company_id;

        return $data;
    }
    protected function getFormSchema(): array
    {
        return [
            TextEntry::make('message')
                ->label('')
                ->content('Hello World'),
            // Other form fields...
        ];
    }
}
