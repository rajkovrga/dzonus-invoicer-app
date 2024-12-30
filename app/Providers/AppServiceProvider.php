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
        $this->app->singleton(PdfExportService::class, function ($app) {
            return new PdfExportService(
                $app->make(InvoiceRepositoryContract::class)
            );
        });

        $this->app->singleton(SendInvoice::class, function ($app) {
            return new SendInvoice(
                $app->make(InvoiceRepositoryContract::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->singleton(PdfExportService::class, function ($app) {
            return new PdfExportService(
                $app->make(InvoiceRepositoryContract::class)
            );
        });

        $this->app->singleton(SendInvoice::class, function ($app) {
            return new SendInvoice(
                $app->make(InvoiceRepositoryContract::class)
            );
        });
    }
}
