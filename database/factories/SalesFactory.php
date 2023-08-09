<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Sales;
use Illuminate\Database\Eloquent\Factories\Factory;


class SalesFactory extends Factory
{
    protected $model = Sales::class;

    public function definition()
    {
        return [
            'sale_date' => Carbon::now(),
            'amount' => $this->faker->randomFloat(2, 10, 200),
            'product_id' => $this->faker->numberBetween(1, 10),
            'customer_id' => $this->faker->numberBetween(1, 50),
        ];
    }
}
