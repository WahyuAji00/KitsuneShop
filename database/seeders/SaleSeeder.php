<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sales = [
            [
                'user_id' => 1,
                'product_id' => 1,
                'address' => '123 Main St, Cityville',
                'quantity' => 10,
                'total_price' => 150.00,
                'sale_date' => Carbon::now(),
            ]
        ];

        DB::table('sales')->insert($sales);
    }
}
