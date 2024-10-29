<?php

namespace App\Filament\Resources\InvoiceResource\Pages;

use App\Filament\Resources\InvoiceResource;
use App\Services\PdfExportService;
use Filament\Actions;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\View;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ViewInvoice extends ViewRecord
{
    protected static string $view = 'filament.pages.invoices.view';
    protected static string $resource = InvoiceResource::class;
    private PdfExportService $pdfExportService;
    public function __construct()
    {
        $this->pdfExportService = app(PdfExportService::class);
    }


    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema(components: [
            TextEntry::make('invoice_info')
                ->label('Invoice Information')
                ->default("{$this->record->invoice_number} / " . date('Y', strtotime($this->record->dated))),
            TextEntry::make('value_date'),
            TextEntry::make('trading_place'),
            TextEntry::make('client.name'),
            TextEntry::make('currency.name'),
        ]);
    }

    public function generatePdf(): StreamedResponse
    {
        return $this->pdfExportService->invoice($this->record->id);
    }
}
