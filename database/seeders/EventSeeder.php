<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         DB::table('events')->insert([
        [
            'name' => "Event 1",
            'description' => "awesome event",
            'it_id'=> 1,
            'image' => '/storage/image.jpg',
        ],
        [
            'name' => "Event 2",
            'description' => "awesome event",
            'it_id'=> 1,
            'image' => '/storage/image.jpg',
        ]
        ]);
    }
}
