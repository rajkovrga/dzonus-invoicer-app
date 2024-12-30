<?php

namespace App\Services;

use App\Contracts\Repositories\InvoiceRepositoryContract;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
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
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isPhpEnabled', true)
            ->setOption('encoding', 'UTF-8');

        $fileName = sprintf(
            '%s.%s %s-%s.pdf',
            $this->invoiceRepository->getCountOfInvoicesForCompanyByYear($invoice->user->company, Carbon::parse($invoice->value_date)->format('Y')),
            str_pad($invoice->invoice_number, 4, '0', STR_PAD_LEFT) . '.' .
            Carbon::parse($invoice->value_date)->format('Y'),
            $invoice->company->name,
            Carbon::parse($invoice->value_date)->format('d.m.Y'),

        );
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $fileName);
    }
}
