<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;


    public function bankAccounts(): HasMany
    {
        return $this->hasMany(BankAccount::class, 'company_id', 'id');
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'company_id', 'id');
    }

    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(Client::class, 'company_clients', 'client_id', 'company_id')
            ->withPivot('contract_url')
            ->withTimestamps();
    }

}
