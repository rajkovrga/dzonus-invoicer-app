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
        $data['trading_place'] = auth()->user()->company->city;
        $data['company_id'] = auth()->user()->company->id;
        $data['user_id'] = auth()->user()->id;

        return $data;
    }
    protected function getFormSchema(): array
    {
        return [

        ];
    }
}
