<?php

namespace App\Providers;

use App\Contracts\Repositories\InvoiceRepositoryContract;
use App\Repositories\InvoiceRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->invoiceRepository();
    }

    private function invoiceRepository(): void
    {
        $this->app->singleton(
            InvoiceRepositoryContract::class,
            InvoiceRepository::class
        );
    }
}
