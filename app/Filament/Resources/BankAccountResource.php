<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BankAccountResource\Pages;
use App\Filament\Resources\BankAccountResource\RelationManagers;
use App\Models\BankAccount;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BankAccountResource extends Resource
{
    protected static ?string $model = BankAccount::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type')
                    ->label('Account Type')
                    ->options([
                        'number' => 'Account Number',
                        'swift_iban' => 'SWIFT + IBAN',
                    ])
                    ->required()
                    ->reactive(),

                Forms\Components\TextInput::make('number')
                    ->label('Account Number')
                    ->maxLength(255)
                    ->required()
                    ->rules(['regex:/^\d+$/'])
                    ->visible(fn ($get) => $get('type') === 'number'),

                Forms\Components\TextInput::make('swift')
                    ->label('SWIFT Code')
                    ->maxLength(255)
                    ->required()
                    ->rules(['regex:/^[A-Z0-9]{8,11}$/'])
                    ->visible(fn ($get) => $get('type') === 'swift_iban'),

                Forms\Components\TextInput::make('iban')
                    ->label('IBAN')
                    ->maxLength(255)
                    ->required()
                    ->rules(['regex:/^[A-Z0-9]{15,34}$/'])
                    ->visible(fn ($get) => $get('type') === 'swift_iban'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('swift')
                    ->searchable(),
                Tables\Columns\TextColumn::make('iban')
                    ->searchable(),
                Tables\Columns\TextColumn::make('number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListBankAccounts::route('/'),
            'create' => Pages\CreateBankAccount::route('/create'),
        ];
    }
}
