<?php

namespace Database\Seeders;

use App\Models\Sales;
use App\Models\Orders;
use App\Models\Incomes;
use App\Models\Warehouses;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Sales::factory(50)->create();
        Orders::factory(50)->create();
        Incomes::factory(50)->create();
        Warehouses::factory(50)->create();
    }
}
