<?php

namespace App\Services;

use App\Contracts\Repositories\InvoiceRepositoryContract;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Blade;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PdfExportService
{
    public function __construct(
        protected InvoiceRepositoryContract $invoiceRepository
    )
    {
    }

    public function invoice(int $invoiceId): StreamedResponse
    {
        $invoice = $this->invoiceRepository->findById($invoiceId);
        return response()->streamDownload(function () use ($invoice) {
            echo Pdf::loadHTML(
                Blade::render('filament.pages.generates.pdf.invoice', ['invoice' => $invoice])
            )->stream();
        },'invoice.pdf');
    }
}
