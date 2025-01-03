<?php

namespace App\Providers;

use App\Contracts\Repositories\InvoiceRepositoryContract;
use App\Filament\Pages\SendInvoice;
use App\Services\PdfExportService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
