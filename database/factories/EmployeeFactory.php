<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'position' => fake()->jobTitle(),
            'birthday' => fake()->date(),
            'address' => fake()->streetName(),
            'address2' => fake()->streetAddress(),
            'city' => fake()->city(),
            'country' => fake()->country(),
            'cp' => fake()->postcode()
        ];
    }
}
