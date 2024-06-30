<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
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
            'city' => fake()->city,
            'country' => fake()->country,
            'phone' => fake()->phoneNumber,
            'email' => fake()->email,
            'vat_id' => fake()->ean8(),
            'registration_number' => fake()->ean8(),
            'registration_date' => fake()->date(),
            'tax_id' => fake()->ean8(),
        ];
    }
}
