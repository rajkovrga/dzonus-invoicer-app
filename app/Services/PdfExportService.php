<?php

namespace App\Services;

use App\Contracts\Repositories\InvoiceRepositoryContract;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;
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

        $pdf = Pdf::loadView('filament.pages.generates.pdf.invoice', ['invoice' => $invoice], encoding: 'UTF-8')
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isPhpEnabled', true)
            ->setPaper('A4', 'portrait');;
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'invoice.pdf');
    }
}
