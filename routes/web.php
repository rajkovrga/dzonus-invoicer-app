<?php

use App\Filament\Pages\SendInvoice;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/test', [TestController::class, 'index']);
Route::get('/admin/invoices/send/{invoiceId}', SendInvoice::class)
    ->name('filament.pages.invoices.send-invoice');
