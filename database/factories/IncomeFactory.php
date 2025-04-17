<?php

namespace Database\Factories;

use App\Models\Freelancer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\income>
 */
class IncomeFactory extends Factory
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
            'income' => fake()->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100),
            'month' => fake()->dateTimeThisYear()->format('Y-m-d')
        ];
    }
}
