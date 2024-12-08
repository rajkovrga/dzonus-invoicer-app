<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::factory()
            ->count(100)
            ->state(function () {
                return [
                    'registration_date' => now()->subDays(rand(0, 365)),
                ];
            })
            ->create();

        Client::factory()
            ->count(100)
            ->create();
    }
}
