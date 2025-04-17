<?php

namespace Database\Factories;

use App\Models\Freelancer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\client>
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
            'freelancer_id' => Freelancer::inRandomOrder()->first()->id,
            'name' => fake()->name,
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber(),
            'company' => fake()->company(),
            'address' => fake()->address(),
        ];
    }
}
