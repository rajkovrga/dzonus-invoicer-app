<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Client::all();

        foreach ($companies as $company) {
            for ($i = 0; $i < rand(5, 10); $i++) {
                $company->clients()->attach(Client::all()->random()->id,
                );
            }
        }
    }
}
