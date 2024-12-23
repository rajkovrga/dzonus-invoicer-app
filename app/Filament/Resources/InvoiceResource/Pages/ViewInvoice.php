<?php

namespace App\Filament\Resources\InvoiceResource\Pages;

use App\Filament\Resources\InvoiceResource;
use App\Services\PdfExportService;
use Filament\Actions;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
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
            TextEntry::make('currency.name')
                ->columnSpan(2),
            RepeatableEntry::make('invoiceItems')
                ->schema([
                    TextEntry::make('title')
                        ->label('Title')
                        ->default(fn ($record) => $record->title),

                    TextEntry::make('quantity')
                        ->label('Quantity')
                        ->default(fn ($record) => $record->quantity),

                    TextEntry::make('unit_title')
                        ->label('Unit')
                        ->default(fn ($record) => $record->unit ? $record->unit->name : 'No unit'),

                    TextEntry::make('price')
                        ->label('Price')
                        ->default(fn ($record) => $record->price),
                ])
                ->columns(4)
                ->columnSpan(2),
            ViewEntry::make('total')
                ->view('components.infolist-total')
                ->columnSpan(2),
        ]);
    }

    public function generatePdf(): StreamedResponse
    {
        return $this->pdfExportService->invoice($this->record->id);
    }
}
