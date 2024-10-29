<?php

namespace App\Contracts\Repositories;

use App\Models\Invoice;
use App\Models\User;

interface InvoiceRepositoryContract
{
    public function getNextInvoiceNumber(User $user): int;

    public function findById(int $id): Invoice;
}
