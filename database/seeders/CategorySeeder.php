<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('category')->insert([
            'name' => "Cakes",
            'img' => 'cake.png',
            'created_at' => now(),
        ]);

        DB::table('category')->insert([
            'name' => "Candies",
            'img' => 'candy.png',
            'created_at' => now(),
        ]);

        DB::table('category')->insert([
            'name' => "Drinks",
            'img' => 'drink.png',
            'created_at' => now(),
        ]);

        DB::table('category')->insert([
            'name' => "Desserts",
            'img' => 'dessert.png',
            'created_at' => now(),
        ]);
    }
}
