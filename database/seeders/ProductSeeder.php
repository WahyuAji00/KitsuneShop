<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'image' => 'storage/products/ProductOhtoAi.png',
                'name' => 'Product A',
                'description' => 'Description for Product A',
                'price' => 319000.00,
                'stock' => 50,
                'category' => 'Category 1',
            ],
        ]);
    }
}
