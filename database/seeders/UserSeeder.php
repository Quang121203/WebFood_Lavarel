<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => "admin",
            'role_id'=>'1',
            'email' => "admin@gmail.com",
            'phone' => "...",
            'address' => "...",
            'password' =>  bcrypt("123456"),
            'created_at' => now(),
        ]);
    }
}
