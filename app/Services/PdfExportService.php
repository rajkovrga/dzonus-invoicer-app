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

    $pdf = Pdf::loadView('filament.pages.generates.pdf.invoice', ['invoice' => $invoice], encoding: 'UTF-8');
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'invoice.pdf');

        return $pdf->download();
        $invoice = $this->invoiceRepository->findById($invoiceId);
        return response()->streamDownload(function () use ($invoice) {
            $css = mb_convert_encoding(file_get_contents(public_path('css/app.css')), 'UTF-8', 'auto');

            echo Pdf::loadHTML(
                Blade::render('filament.pages.generates.pdf.invoice', ['invoice' => $invoice]), encoding: 'UTF-8'
            )
                ->setOption('isHtml5ParserEnabled', true)
                ->setOption('isPhpEnabled', true)
                ->setOption('customCss', $css)
                ->download();
        },'invoice.pdf');
    }
}
