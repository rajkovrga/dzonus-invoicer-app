<?php

namespace App\Services;

use App\Contracts\Repositories\InvoiceRepositoryContract;
use Barryvdh\DomPDF\Facade\Pdf;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PdfExportService
{
    public function __construct(
        protected InvoiceRepositoryContract $invoiceRepository,

    )
    {
    }

    public function invoice(int $invoiceId): StreamedResponse
    {
        $invoice = $this->invoiceRepository->findById($invoiceId);

        $pdf = PDF::loadView('filament.pages.generates.pdf.invoice', compact('invoice'))
            ->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);

        $pdf->setOption('encoding', 'UTF-8');

        $pdfContent = $pdf->output();

        return response()->streamDownload(function () use ($pdfContent) {
            echo $pdfContent;
        }, 'invoice.pdf');
    }
}
