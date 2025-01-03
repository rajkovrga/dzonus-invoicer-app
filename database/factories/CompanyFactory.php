<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company,
            'address' => fake()->streetAddress,
            'phone' => fake()->phoneNumber,
            'vat_id' => fake()->ean8(),
            'registration_number' => fake()->ean8(),
            'registration_date' => fake()->date(),
            'tax_id' => fake()->ean8(),
            'city' => fake()->city,
            'zip_code' => fake()->postcode,
            'email' => fake()->safeEmail,
            'activity_code' => fake()->numberBetween(1000,9999),
            'activity_description' => fake()->text(45),
        ];
    }
}
