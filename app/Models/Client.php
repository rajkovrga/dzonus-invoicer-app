<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $casts = [
        'is_active' => 'boolean',
    ];
    protected $fillable = [
        'name',
        'address',
        'vat_id',
        'owner_id',
        'phone',
        'registration_number',
        'registration_date',
        'tax_id',
        'registration_agent',
        'is_active',
        'city'
    ];

}
