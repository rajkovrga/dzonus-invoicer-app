<?php

namespace App\Filament\Pages;

use App\Models\Company;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Infolists;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Infolist;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Infolists\Components\IconEntry;

class CompanyManage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.company-manage.info';
    protected static ?string $navigationGroup = 'Settings';

    public ?Company $record = null;

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
                        IconEntry::make('is_active')
                            ->getStateUsing(function () {
                                return (bool) $this->record->is_active;
                            })
                            ->label('Active')
                        ->boolean(),
                        Infolists\Components\TextEntry::make('address'),
                        Infolists\Components\TextEntry::make('city'),
                        Infolists\Components\TextEntry::make('vat_id'),
                        Infolists\Components\TextEntry::make('registration_number'),
                        Infolists\Components\TextEntry::make('tax_id'),
                    ])
                    ->headerActions([
                        Action::make('edit')
                            ->form([
                                FileUpload::make('logo_url')
                                    ->label('Logo Company')
                                    ->default('https://dummyimage.com/300x300/000000/ffffff&text=logo'),
                                TextInput::make('name')
                                    ->label('Company Name')
                                    ->default($this->record?->name),
                                Toggle::make('is_active')
                                    ->default($this->record?->is_active)
                                    ->label('Active'),
                                TextInput::make('address')
                                    ->label('Address')
                                    ->default($this->record?->address),
                                TextInput::make('city')
                                    ->label('City')
                                    ->default($this->record?->city),
                                TextInput::make('vat_id')
                                    ->label('VAT ID')
                                    ->default($this->record?->vat_id),
                                TextInput::make('registration_number')
                                    ->label('Registration Number')
                                    ->default($this->record?->registration_number),
                                TextInput::make('tax_id')
                                    ->label('Tax ID')
                                    ->default($this->record?->tax_id),
                            ])
                            ->action(function (array $data) {
                                $this->record->update($data);
                            }),
                    ]),

                Section::make('Contact info')
                    ->description('Company contact details.')
                    ->schema([
                        Infolists\Components\TextEntry::make('owner name'),
                        Infolists\Components\TextEntry::make('company email'),
                        Infolists\Components\TextEntry::make('phone'),
                    ])
                    ->headerActions([
                        Action::make('edit')
                            ->form([
                                TextInput::make('phone')
                                    ->default($this->record?->phone),
                            ])
                            ->action(function (array $data) {
                                $this->record->update($data);
                            }),
                    ]),
                Section::make('Registration info')
                    ->description('Company register details.')
                    ->schema([
                        Infolists\Components\TextEntry::make('registration_date'),
                        Infolists\Components\TextEntry::make('registration_agent'),
                    ])
                    ->headerActions([
                        Action::make('edit')
                            ->form([
                                TextInput::make('registration_agent')
                                    ->default($this->record?->registration_agent),
                            ])
                            ->action(function (array $data) {
                                $this->record->update($data);
                            }),
                    ]),
                Section::make('Drafts')
                    ->description('Drafts about bussiness stuffs')
                    ->schema([
                        Infolists\Components\ImageEntry::make('stamp_url')
                            ->label('Stamp Company')
                            ->circular()
                            ->default($this->record?->stamp_url ?? 'https://dummyimage.com/300x300/000000/ffffff&text=stamp'),
                        Infolists\Components\TextEntry::make('global_email_draft')
                            ->html()
                            ->default($this->record?->global_email_draft)
                    ])
                    ->headerActions([
                        Action::make('edit')
                            ->form([
                                FileUpload::make('stamp_url')
                                    ->default($this->record?->stamp_url ?? 'https://dummyimage.com/300x300/000000/ffffff&text=stamp')
                                    ->image(),
                                RichEditor::make('global_email_draft')
                                ->default($this->record?->global_email_draft)
                            ])
                            ->action(function (array $data) {
                                $this->record->update($data);
                            }),
                    ]),
            ])
            ->state([
                'name' => $this->record?->name ?? '',
                'address' => $this->record?->address ?? '',
                'city' => $this->record?->city ?? '',
                'vat_id' => $this->record?->vat_id ?? '',
                'logo_url' => $this->record?->logo_url ?? '',
                'phone' => $this->record?->phone ?? 'None',
                'registration_number' => $this->record?->registration_number ?? '',
                'company email' => $this->record?->owner->email ?? '',
                'owner name' => $this->record?->owner->first_name . ' ' . $this->record?->owner->last_name ?? '',
                'registration_date' => $this->record?->registration_date ?? '',
                'tax_id' => $this->record?->tax_id ?? 'None',
                'registration_agent' => $this->record?->registration_agent ?? 'None',
                'stamp_url' => $this->record?->stamp_url ?? '',
                'active' => $this->record?->is_active ?? '',
                'Email global draft' => $this->record?->global_email_draft ?? 'None',
            ]);
    }
}
