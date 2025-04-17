<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id' => Client::inRandomOrder()->first()->id,
            'name' => fake()->name,
            'description' => fake()->realText(100),
            'rate/hour' => fake()->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100),
            'total_hours' => fake()->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 1000)
        ];
    }
}
