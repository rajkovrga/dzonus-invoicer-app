<?php

namespace App\Services;

use App\Contracts\Repositories\InvoiceRepositoryContract;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Blade;
use Mpdf\HTMLParserMode;
use Mpdf\Mpdf;
use Mpdf\MpdfException;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PdfExportService
{
    public function __construct(
        protected InvoiceRepositoryContract $invoiceRepository,

    )
    {
    }

    /**
     * @throws MpdfException
     */
    public function invoice(int $invoiceId): StreamedResponse
    {
        $invoice = $this->invoiceRepository->findById($invoiceId);
        $html = view('filament.pages.generates.pdf.invoice');


        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);

        return response()->streamDownload(function () use ($mpdf) {
            echo $mpdf->Output();
        }, 'invoice.pdf');
    }
}
