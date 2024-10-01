<?php

namespace App\Services;

use App\Repositories\InvoiceRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class PdfExportService
{
    public function __construct(
    )
    {
    }

    public function invoice(int $invoiceId): Response
    {
        $invoice = (new InvoiceRepository())->findById($invoiceId);

        $pdf = PDF::loadView('filament.pages.generates.pdf.invoice', compact('invoice'));

        return $pdf->download('testtest.pdf');
    }
}
