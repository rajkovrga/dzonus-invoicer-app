<?php

namespace App\Filament\Pages;

use Closure;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Outerweb\FilamentSettings\Filament\Pages\Settings as BaseSettings;

class Settings extends BaseSettings
{
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationGroup = 'Settings';
    public static function getNavigationLabel(): string
    {
        return 'Settings';
    }
    public function schema(): array|Closure
    {
        return [
            Tabs::make('Settings')
                ->schema([
                ]),
        ];
    }
}
