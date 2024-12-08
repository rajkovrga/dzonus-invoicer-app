<?php

namespace App\Filament\Resources\BankAccountResource\Pages;

use App\Filament\Resources\BankAccountResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBankAccount extends EditRecord
{
    protected static string $resource = BankAccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function beforeSave(): void
    {
        $number = $this->record['number'];
        $swift = $this->record['swift'];
        $iban = $this->record['iban'];

        if (empty($swift) && empty($iban)) {
            $this->record['number'] = null;
        }

        if (empty($number)) {
            $this->record['swift'] = null;
            $this->record['iban'] = null;
        }
    }
}
