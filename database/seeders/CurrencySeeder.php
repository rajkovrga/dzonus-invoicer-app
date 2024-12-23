<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Currency::query()->create([
            'name' => 'Euro',
            'arabic' => 'يورو',
            'iso' => 'EUR',
            'is_activated' => true,
            'symbol' => '€',
        ]);

        Currency::query()->create([
            'name' => 'Dinar',
            'arabic' => 'دينار',
            'iso' => 'RSD',
            'is_activated' => true,
            'symbol' => 'дин.',
        ]);
    }
}
