<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BankAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'iban',
        'swift',
        'company_id',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'company_id', 'id');
    }
}
