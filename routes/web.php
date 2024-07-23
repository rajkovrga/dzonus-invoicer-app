<?php

use App\Filament\Resources\CompanyResource\Pages\ViewCompany;
use Illuminate\Support\Facades\Route;

Route::get('/company', [ViewCompany::class, 'render'])->name('view.default.company');
