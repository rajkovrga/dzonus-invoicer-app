<?php

namespace App\Filament\Pages;

use App\Models\Client;
use Filament\Infolists;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Infolist;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class CompanyManage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.company-manage.info';
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

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Company Info')
                    ->description('Basic company information.')
                    ->schema([
                        Infolists\Components\ImageEntry::make('logo_url')
                            ->label('Logo Company')
                            ->circular()
                            ->default('https://dummyimage.com/300x300/000000/ffffff&text=logo'),
                        Infolists\Components\TextEntry::make('name')
                            ->label('Company Name'),
                        Infolists\Components\IconEntry::make('active')
                            ->boolean(),

                        Infolists\Components\TextEntry::make('address'),
                        Infolists\Components\TextEntry::make('vat_id'),
                        Infolists\Components\TextEntry::make('registration_number'),
                        Infolists\Components\TextEntry::make('tax_id'),
                    ]),

                Section::make('Contact info')
                    ->description('Company contact details.')
                    ->schema([
                        Infolists\Components\TextEntry::make('phone'),
                        Infolists\Components\TextEntry::make('company email'),
                    ]),
                Section::make('Registration info')
                    ->description('Company register details.')
                    ->schema([
                        Infolists\Components\TextEntry::make('owner name'),
                        Infolists\Components\TextEntry::make('registration_date'),
                        Infolists\Components\TextEntry::make('registratin_agent'),
                        ]),
                Section::make('Drafts')
                    ->description('Drafts about bussiness stuffs')
                    ->schema([
                        Infolists\Components\ImageEntry::make('stamp_url')
                            ->label('Stamp Company')
                            ->circular()
                            ->default('https://dummyimage.com/300x300/000000/ffffff&text=stamp'),
                        Infolists\Components\TextEntry::make('Email global draft')
                    ]),


            ])
            ->state([
                'name' => $this->record?->name ?? '',
                'address' => $this->record?->address ?? '',
                'vat_id' => $this->record?->vat_id ?? '',
                'logo_url' => $this->record?->logo_url ?? '',
                'phone' => $this->record?->phone ?? 'None',
                'registration_number' => $this->record?->registration_number ?? '',
                'company email' => $this->record?->owner->email ?? '',
                'owner name' => $this->record?->owner->first_name . ' ' . $this->record?->owner->last_name ?? '',
                'registration_date' => $this->record?->registration_date ?? '',
                'tax_id' => $this->record?->tax_id ?? 'None',
                'registratin_agent' => $this->record?->registration_agent ?? 'None',
                'stamp_url' => $this->record?->stamp_url ?? '',
                'active' => $this->record?->is_active ?? '',
                'Email global draft' => $this->record?->global_email_draft ?? 'None',
            ]);
    }

}
