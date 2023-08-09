<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Orders;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrdersFactory extends Factory
{
    protected $model = Orders::class;

    public function definition()
    {
        return [
            'order_date' => Carbon::now(),
            'total_amount' => $this->faker->randomFloat(2, 50, 1000),
            'customer_id' => $this->faker->numberBetween(1, 50),
            'product_id' => $this->faker->numberBetween(1, 20),
        ];
    }
}
