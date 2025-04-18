<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'project_id' => Project::inRandomOrder()->first()->id,
            // 'total' => fake()->randomFloat($nbMaxDeicmals = 2, $min = 0, $max = 100),
            // 'isPaid' => fake()->boolean()
        ];
    }
}
