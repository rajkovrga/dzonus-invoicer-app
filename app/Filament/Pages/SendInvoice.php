<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;

class SendInvoice extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $view = 'filament.pages.invoices.send-invoice';
    protected static bool $shouldRegisterNavigation = false;
    public ?int $invoiceId = null;

    public function mount(): void
    {
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('email')
                ->label('Recipient Email')
                ->placeholder('example@domain.com')
                ->email()
                ->required(),
            TextInput::make('subject')
                ->label('Subject')
                ->default('Invoice from Vrga DEV')
                ->required(),
            MarkdownEditor::make('message')
                ->label('Message')
                ->default('Please find the attached invoice.')
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
