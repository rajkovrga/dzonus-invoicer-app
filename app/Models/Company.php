<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $casts = [
        'is_active' => 'boolean',
    ];
    protected $fillable = [
        'name',
        'address',
        'city',
        'vat_id',
        'owner_id',
        'phone',
        'registration_number',
        'registration_date',
        'tax_id',
        'registration_agent',
        'global_email_draft',
        'stamp_url',
        'logo_url',
        'is_active'
    ];

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

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

}
