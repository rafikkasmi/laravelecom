<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('products')->insert([
            [
            'name' => "Product 1",
            'image' => '/storage/image.jpg',
            'description' => 'test',
            'price'=>200,
            'stock' => 100,
            'it_id'=> 1,
            'category_id'=>1,
            ],
            [
            'name' => "Product 2",
            'image' => '/storage/image.jpg',
            'description' => 'test',
            'price'=>200,
            'stock' => 100,
            'it_id'=> 1,
            'category_id'=>1,
            ],
            [
            'name' => "Product 3",
            'image' => '/storage/image.jpg',
            'description' => 'test',
            'price'=>200,
            'stock' => 100,
            'it_id'=> 1,
            'category_id'=>1,
            ],
            [
            'name' => "Product 4",
            'image' => '/storage/image.jpg',
            'description' => 'test',
            'price'=>200,
            'stock' => 100,
            'it_id'=> 1,
            'category_id'=>1,
            ],
            [
            'name' => "Product 5",
            'image' => '/storage/image.jpg',
            'description' => 'test',
            'price'=>200,
            'stock' => 100,
            'it_id'=> 1,
            'category_id'=>1,
            ],
            [
            'name' => "Product 6",
            'image' => '/storage/image.jpg',
            'description' => 'test',
            'price'=>200,
            'stock' => 100,
            'it_id'=> 1,
            'category_id'=>1,
            ],
        ]);
    }
}
