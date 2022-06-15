<?php

namespace Database\Factories;

use App\Models\Expense\Expense;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Expense::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'       => $this->faker->sentence(10),
            'cost'        => $this->faker->randomNumber(2),
            'description' => $this->faker->sentence(15),
            'date'        => $this->faker->dateTimeBetween('-1 years', 'now'),
        ];
    }
}
