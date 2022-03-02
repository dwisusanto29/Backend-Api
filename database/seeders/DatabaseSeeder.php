<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        if(DB::table('products')->count() == 0)
        {
            DB::table('products')->insert(
                [
                    [
                        'name' => 'Product 1',
                        'detail' => 'Product 1 detail',
                        'price' => '100.00',
                        'quantity' => 10,
                        'image' => 'product1.jpg',
                        'created_by' => 1,
                    ],
                    [
                        'name' => 'Product 2',
                        'detail' => 'Product 2 detail',
                        'price' => '200.00',
                        'image' => 'product2.jpg',
                        'created_by' => 1,
                        'quantity' => 10,
                    ],
                    [
                        'name' => 'Product 3',
                        'detail' => 'Product 3 detail',
                        'price' => '300.00',
                        'quantity' => 10,
                        'image' => 'product3.jpg',
                        'created_by' => 1,
                    ],
                    [
                        'name' => 'Product 4',
                        'detail' => 'Product 4 detail',
                        'price' => '400.00',
                        'quantity' => 10,
                        'image' => 'product4.jpg',
                        'created_by' => 1,

                    ],
                    [
                        'name' => 'Product 5',
                        'detail' => 'Product 5 detail',
                        'price' => '500.00',
                        'quantity' => 10,
                        'image' => 'product5.jpg',
                        'created_by' => 1,
                    ],
                    [
                        'name' => 'Product 6',
                        'detail' => 'Product 6 detail',
                        'price' => '600.00',
                        'quantity' => 10,
                        'image' => 'product6.jpg',
                        'created_by' => 1,
                    ],
                    [
                        'name' => 'Product 7',
                        'detail' => 'Product 7 detail',
                        'price' => '700.00',
                        'quantity' => 10,
                        'image' => 'product7.jpg',
                        'created_by' => 1,
                    ],
                    [
                        'name' => 'Product 8',
                        'detail' => 'Product 8 detail',
                        'price' => '800.00',
                        'quantity' => 10,
                        'image' => 'product8.jpg',
                        'created_by' => 1,
                    ],
                    [
                        'name' => 'Product 9',
                        'detail' => 'Product 9 detail',
                        'price' => '900.00',
                        'quantity' => 10,
                        'image' => 'product9.jpg',
                        'created_by' => 1,
                    ],
                    [
                        'name' => 'Product 10',
                        'detail' => 'Product 10 detail',
                        'price' => '1000.00',
                        'quantity' => 10,
                        'image' => 'product10.jpg',
                        'created_by' => 1,
                    ],
                    [
                        'name' => 'Product 11',
                        'detail' => 'Product 11 detail',
                        'price' => '1100.00',
                        'quantity' => 10,
                        'image' => 'product11.jpg',
                        'created_by' => 1,
                    ],
                ]);
        } else {
            echo "Table is not empty ";
        }
    }
}
