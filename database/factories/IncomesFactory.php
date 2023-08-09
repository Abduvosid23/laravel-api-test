<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Incomes;
use Illuminate\Database\Eloquent\Factories\Factory;


class IncomesFactory extends Factory
{
    protected $model = Incomes::class;

    public function definition()
    {
        return [
            'income_date' => Carbon::now(),
            'amount' => $this->faker->randomFloat(2, 100, 1000),
            'source_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
