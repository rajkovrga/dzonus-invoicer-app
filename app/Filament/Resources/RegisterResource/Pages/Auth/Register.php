<?php

namespace App\Filament\Resources\RegisterResource\Pages\Auth;

use App\Filament\Resources\RegisterResource;
use App\Models\Client;
use App\Models\Company;
use App\Models\User;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Pages\Auth\Register as BaseRegister;
use Filament\Forms;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

class Register extends BaseRegister
{
    protected ?string $maxWidth = '2xl';
    public function form(Form $form): Form
    {
        return $form->schema([
            Wizard::make([
                Wizard\Step::make('Company information')
                    ->schema([
                                Forms\Components\TextInput::make('company_name')
                                    ->label('Name')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('address')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('vat_id')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('registration_number')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('tax_id')
                                    ->maxLength(255),
                                Forms\Components\DateTimePicker::make('registration_date')
                                    ->required(),
                                Forms\Components\TextInput::make('registration_agent')
                                    ->maxLength(255),
                    ]),
                Wizard\Step::make('User information')
                    ->schema([
                        Forms\Components\TextInput::make('first_name')
                            ->required(),
                        Forms\Components\TextInput::make('last_name')
                            ->required(),
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                    ]),
            ])->submitAction(new HtmlString(Blade::render(<<<BLADE
                    <x-filament::button
                        type="submit"
                        size="sm"
                        wire:submit="register"
                    >
                        Register
                    </x-filament::button>
                    BLADE
            ))),
        ]);
    }

    protected function getFormActions(): array
    {
        return [];
    }

    protected function handleRegistration(array $data): User
    {
        $data = $this->form->getState();

        $client = Company::query()
            ->create([
                'name' => $data['company_name'],
                'address' => $data['address'],
                'vat_id' => $data['vat_id'],
                'registration_number' => $data['registration_number'],
                'tax_id' => $data['tax_id'] ?? null,
                'registration_date' => $data['registration_date'],
                'registration_agent' => $data['registration_agent'] ?? null,
            ]);

        $user = User::create([
           'name' => $data['name'],
           'first_name' => $data['first_name'],
           'last_name' => $data['last_name'],
           'email' => $data['email'],
           'password' => $data['password'],
            'company_id' => $client->id
        ]);

        $client->owner_id = $user->id;
        $client->save();

        return $user;
    }

    protected function mutateFormDataBeforeRegister(array $data): array
    {
        $data['company_id'] = session('active_tenant_id');
        return parent::mutateFormDataBeforeRegister($data);
    }

}
