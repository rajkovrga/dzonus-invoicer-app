<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Company;
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
        $company = Company::create([
            'name' => 'Rajko Vrga PR Informacione usluge Vrga DEV Beograd (Zemun)',
            'address' => 'Episkopa Nikolaja 11/25',
            'phone' => '+381 63 123 456',
            'vat_id' => '113460262',
            'registration_number' => '66841251',
            'city' => 'Belgrade',
            'registration_date' => Carbon::create('2022', '12', '29')
                ->toString(),
        ]);

        $user = User::create([
            'name' => 'rajkovrga',
            'email' => 'rajko@vrga.dev',
            'first_name' => 'Rajko',
            'last_name' => 'Vrga',
            'password' => '12345',
            'company_id' => $company->id,
            'email_verified_at' => now(),
        ]);
        $company->owner_id = $user->id;
        $company->save();

        User::factory()
            ->count(1000)
            ->create();
    }
}
