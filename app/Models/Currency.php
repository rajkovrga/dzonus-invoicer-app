<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'arabic',
        'iso',
        'is_activated',
        'symbol',
        'exchange_rate',
    ];
}
