<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Warehouses;
use Illuminate\Database\Eloquent\Factories\Factory;

class WarehousesFactory extends Factory
{
    protected $model = Warehouses::class;

    public function definition()
    {
        return [
            'warehouse_date' => Carbon::now()->toDateString(),
            'product_id' => $this->faker->numberBetween(1, 20),
            'quantity' => $this->faker->numberBetween(10, 100),
        ];
    }
}
