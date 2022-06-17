<?php

namespace Database\Factories\Income;

use App\Models\Income\RecurringIncome;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Income\RecurringIncome>
 */
class RecurringIncomeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'recurring_type'      => $this->faker->randomElement(array_keys(RecurringIncome::TYPES)),
            'recurring_starts_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'recurring_ends_at'   => $this->faker->optional()->dateTimeBetween('tomorrow', '+1 year'),
        ];
    }
}
