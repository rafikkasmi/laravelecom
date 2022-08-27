<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         DB::table('categories')->insert([
        [
            'name' => "Category 1",
            'image' => '/storage/image.jpg',
        ],
        [
            'name' => "Category 2",
            'image' => '/storage/image.jpg',
        ]
        ]);
    }
}
