<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws \Throwable
     */
    public function run(): void
    {
        $client = Client::create([
            'name' => 'Rajko Vrga PR Informacione usluge Vrga DEV Beograd (Zemun)',
            'address' => 'Episkopa Nikolaja 11/25',
            'city' => 'Beograd',
            'country' => 'Srbija',
            'phone' => '+381 63 123 456',
            'email' => 'rajko@vrga.dev',
            'vat_id' => '113460262',
            'registration_number' => '66841251',
            'registration_date' => Carbon::create('2022', '12', '29')
                ->toString(),
        ]);

        User::create([
            'name' => 'rajkovrga',
            'email' => 'rajko@vrga.dev',
            'first_name' => 'Rajko',
            'last_name' => 'Vrga',
            'password' => '',
            'company_id' => $client->id,
            'email_verified_at' => now(),
        ]);

        User::factory()
            ->count(1000)
            ->create();
    }
}
