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
            'id'=>1,
            'name' => "Cakes",
            'img' => 'cake.png',
            'created_at' => now(),
        ]);

        DB::table('category')->insert([
            'id'=>2,
            'name' => "Candies",
            'img' => 'candy.png',
            'created_at' => now(),
        ]);

        DB::table('category')->insert([
            'id'=>3,
            'name' => "Drinks",
            'img' => 'drink.png',
            'created_at' => now(),
        ]);

        DB::table('category')->insert([
            'id'=>4,
            'name' => "Desserts",
            'img' => 'dessert.png',
            'created_at' => now(),
        ]);
    }
}
