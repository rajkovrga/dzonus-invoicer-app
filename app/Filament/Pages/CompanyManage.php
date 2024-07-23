<?php

namespace App\Filament\Pages;

use App\Models\Client;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class CompanyManage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.company-manage';
    protected static ?string $navigationGroup = 'Settings';

    public ?Client $record = null;

    public function getTitle(): string|Htmlable
    {
        return 'Company ' . auth()->user()->company->name;
    }

    public function mount(): void
    {
        $this->record = auth()->user()->company;

        $this->fillForm();
    }

    public function fillForm(): void
    {
        $data = $this->record->attributesToArray();

        $data = $this->mutateFormDataBeforeFill($data);

        $this->form->fill($data);
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        return $data;
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $this->handleRecordUpdate($this->record, $data);
    }

    public function form(Form $form): Form
    {
        return $form
            ->live()
            ->schema([
                TextEntry::make('name'),
            ])
            ->model($this->record);
    }

}
