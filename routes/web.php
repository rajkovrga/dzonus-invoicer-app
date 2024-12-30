<?php

use App\Filament\Pages\SendInvoice;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/invoices/send/{id}', SendInvoice::class)
    ->name('filament.pages.invoices.send-invoice');
