<?php

namespace App\Repositories;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class InvoiceRepository
{
    public function getNextInvoiceNumber(User $user): int
    {
        $lastInvoice = Invoice::query()
            ->where('company_id', $user->company->id)
            ->orderBy('invoice_number')
            ->first();

        if(!$lastInvoice) {
            return 1;
        }

        return $lastInvoice->invoice_number + 1;
    }

    public function findById(int $id): Invoice
    {
        return Invoice::query()
            ->find($id);
    }
}
