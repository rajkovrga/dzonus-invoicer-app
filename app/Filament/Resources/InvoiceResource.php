<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use App\Models\Invoice;
use App\Repositories\InvoiceRepository;
use App\Tables\Columns\InvoiceNumber;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        $invoiceRepository = app(InvoiceRepository::class);
        $nextInvoiceNumber = $invoiceRepository->getNextInvoiceNumber(auth()->user());

        return $form
            ->schema([
                Forms\Components\TextInput::make('invoice_number')
                    ->required()
                    ->rules(function ($get) {
                        $invoiceId = $get('id');
                        if (!$invoiceId) {
                            return [
                                Rule::unique('invoices', 'invoice_number'),
                            ];
                        }

                        return [];
                    })
                    ->afterStateHydrated(function ($state, $get) {
                        if ($get('record') && $get('record')->exists) {
                            return $this->readOnly(true);
                        }
                    })
                    ->default($nextInvoiceNumber)
                    ->numeric(),
                Forms\Components\DateTimePicker::make('dated')
                    ->default(Carbon::now())
                    ->required(),
                Forms\Components\DateTimePicker::make('value_date')
                    ->default(Carbon::now())
                    ->required(),
                Forms\Components\Select::make('client_id')
                    ->relationship('client',
                        'name',
                        fn(Builder $query) => $query->where('company_owner_id', auth()->user()->company->id))
                    ->required(),
                Forms\Components\Select::make('currency_id')
                    ->relationship('currency', 'name')
                    ->columns(2)
                    ->required(),
                Forms\Components\Select::make('bank_account_id')
                    ->relationship('bankAccount',
                        'name',
                        fn(Builder $query) => $query->where('company_id', auth()->user()->company->id))
                    ->getOptionLabelFromRecordUsing(function ($record) {
                        return $record->iban ?? $record->number;
                    })
                    ->columns(2),
                Forms\Components\Repeater::make('invoiceItems')
                    ->relationship('invoiceItems')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Title')
                            ->required(),
                        Forms\Components\TextInput::make('price')
                            ->numeric()
                            ->required()
                            ->label('Price'),
                        Forms\Components\TextInput::make('quantity')
                            ->numeric()
                            ->required()
                            ->label('Quantity'),
                        Forms\Components\Select::make('unit_id')
                            ->relationship('unit', 'name')
                            ->required()
                            ->label('Unit'),
                        Forms\Components\Checkbox::make('is_sale')
                        ->label('Sale')
                        ->default(false)
                    ])
                    ->columnSpan(2)
                    ->label('Invoice Items')
                    ->required()
                    ->minItems(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                InvoiceNumber::make('invoice_number')
                    ->state(function (Invoice $record) {
                        return $record->invoice_number . '/' . Carbon::make($record->dated)->format('Y');
                    }),
                Tables\Columns\TextColumn::make('value_date')
                    ->dateTime('d.m.Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('trading_place')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('client.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('currency.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'view' => Pages\ViewInvoice::route('/{record}'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }
}
