<?php

use App\Filament\Pages\SendInvoice;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/send-invoice/{id}', SendInvoice::class)
    ->whereNumber('id');
