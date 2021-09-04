<?php

use Illuminate\Database\Seeder;
use App\Product;

class CreateProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = [
            [
                'user_id' => 1,
                'product_name' => 'Product 1',
                'slug' => 'product_1',
                'price' => 5000,
                'stock' => 2
            ],
            [
                'user_id' => 1,
                'product_name' => 'Product 2',
                'slug' => 'product_2',
                'price' => 10000,
                'stock' => 8
            ],
            [
                'user_id' => 1,
                'product_name' => 'Product 3',
                'slug' => 'product_3',
                'price' => 15000,
                'stock' => 5
            ],
            [
                'user_id' => 1,
                'product_name' => 'Product 4',
                'slug' => 'product_4',
                'price' => 20000,
                'stock' => 2
            ],
            [
                'user_id' => 1,
                'product_name' => 'Product 5',
                'slug' => 'product_5',
                'price' => 25000,
                'stock' => 11
            ]
        ];

        foreach ($product as $key => $value) {
            Product::create($value);
        }
    }
}
