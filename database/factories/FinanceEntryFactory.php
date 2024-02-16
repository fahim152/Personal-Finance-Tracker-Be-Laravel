<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FinanceEntry>
 */
class FinanceEntryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'date' => $this->faker->dateTimeBetween('2023-11-01', '2024-02-16')->format('Y-m-d'),
            'amount' => $this->faker->numberBetween(1000, 10000),
            'category' => $this->faker->randomElement(['income', 'expense']),
            'description' => $this->faker->sentence(),
        ];
    }
}
