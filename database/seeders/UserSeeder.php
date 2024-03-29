<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'fname' => "Rafik",
            'name' => "Kasmi",
            'email' => 'rafikhdey@gmail.com',
            'password' => Hash::make('12345678'),
            'role_id'=>3,
            'created_at' => now(),
            'address'=>'timimoune'
        ]);
    }
}
