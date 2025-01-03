<?php

namespace App\Services;

use App\Contracts\Repositories\InvoiceRepositoryContract;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PdfExportService
{
    public function __construct(
        protected InvoiceRepositoryContract $invoiceRepository,

    )
    {
    }

    public function getInvoicePdf(Invoice|Model $invoice): string
    {
        $pdf = PDF::loadView('filament.pages.generates.pdf.invoice', compact('invoice'))
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isPhpEnabled', true)
            ->setOption('encoding', 'UTF-8');

        return $pdf->output();
    }

    public function getInvoiceFileName(Invoice|Model $invoice): string {
        $countOfInvoices = $invoice->user->company->invoices()->whereYear('created_at', Carbon::parse($invoice->value_date)->format('Y'))->count();

        return sprintf(
            '%s.%s %s-%s.pdf',
            $countOfInvoices,
            str_pad($invoice->invoice_number, 4, '0', STR_PAD_LEFT) . '.' .
            Carbon::parse($invoice->value_date)->format('Y'),
            $invoice->company->name,
            Carbon::parse($invoice->value_date)->format('d.m.Y'),
        );
    }
}
