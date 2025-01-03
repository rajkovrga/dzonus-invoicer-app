<?php

namespace App\Filament\Pages;

use App\Contracts\Repositories\InvoiceRepositoryContract;
use App\Models\Invoice;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;

class SendInvoice extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $route = '/send-invoice/{id}';
    protected static string $view = 'filament.pages.invoices.send-invoice';
    protected static bool $shouldRegisterNavigation = false;
    public ?int $id = null;
    public ?Invoice $record = null;

    public function mount(InvoiceRepositoryContract $invoiceRepository): void
    {
        $this->record = $invoiceRepository->findById(request()->get('id'));
    }

    public function getForm(string $name): ?Form
    {
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('email')
                ->label('Recipient Email')
                ->placeholder($this->record->company->email)
                ->default($this->record->company->email)
                ->disabled(),

            TextInput::make('subject')
                ->label('Subject')
                ->required(),

            MarkdownEditor::make('message')
                ->label('Message')
                ->default(function () {
                    return $this->record->client->email_draft
                        ?? auth()->user()->company->invoice_email_draft;
                })
                ->required(),
        ];
    }

    public function sendInvoice(array $data)
    {
//        $invoice = \App\Models\Invoice::findOrFail($this->invoiceId);
//
//        $pdf = Pdf::loadView('invoices.pdf', ['invoice' => $invoice]);
//
//        Mail::to($data['email'])->send(new InvoiceMail($data['subject'], $data['message'], $pdf->output()));
//
//        $this->notify('success', 'Invoice sent successfully!');
    }
}
