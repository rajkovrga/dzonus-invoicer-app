<?php

namespace App\Filament\Pages;

use App\Contracts\Repositories\InvoiceRepositoryContract;
use App\Models\Invoice;
use App\Services\PdfExportService;
use Carbon\Carbon;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Validation\ValidationException;

class SendInvoice extends Page implements HasForms
{
    use InteractsWithForms;
    public ?array $data = [];
    protected static ?string $route = '/send-invoice/{id}';
    protected static string $view = 'filament.pages.invoices.send-invoice';
    protected ?string $heading;
    protected static bool $shouldRegisterNavigation = false;
    public ?int $id = null;
    public ?Invoice $record = null;
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('email')
                    ->label('Recipient Email')
                    ->placeholder($this->record->company->email)
                    ->disabled(),

                TextInput::make('subject')
                    ->label('Subject')
                    ->required(),

                MarkdownEditor::make('message')
                    ->label('Message')
                    ->required(),
            ])->statePath('data');
    }

    public function mount(InvoiceRepositoryContract $invoiceRepository): void
    {
        $this->record = $invoiceRepository->findById(request()->get('id'));

        $this->heading = 'Send Invoice ' . $this->record->invoice_number . '/' . Carbon::parse($this->record->value_date)->format('Y');

        $this->form->fill([
            'email' => $this->record->company->email,
            'subject' => auth()->user()->company->invoice_email_subject ?? '',
            'message' => $this->record->client->email_draft
                ?? auth()->user()->company->invoice_email_draft,
        ]);
    }

    /**
     * @throws ValidationException
     */
    public function sendInvoice(): void
    {
        $data = $this->form->getState();

        $exportService = app(PdfExportService::class);

        $data['invoice'] = $exportService->getInvoicePdf($this->record);
        $data['invoice_filename'] = $exportService->getInvoiceFilename($this->record);

        $this->record->client->notify(new \App\Notifications\SendInvoice($data));

        $this->form->fill([]);

        Notification::make()
            ->success()
            ->title('Invoice sent successfully!')
            ->send();
    }
}
