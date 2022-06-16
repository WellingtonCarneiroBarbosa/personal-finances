<?php

namespace Database\Factories\Income;

use App\Models\Income\Income;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Income>
 */
class IncomeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Income::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'       => $this->faker->word,
            'amount'      => $this->faker->randomFloat(2, 0, 10000),
            'date'        => $this->faker->dateTimeBetween('-1 year', 'now'),
            'description' => $this->faker->optional()->text,
        ];
    }
}
