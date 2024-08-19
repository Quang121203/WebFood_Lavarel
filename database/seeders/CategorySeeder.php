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
            'name' => "cakes",
            'img' => 'cake.png',
        ]);

        DB::table('category')->insert([
            'name' => "Candies",
            'img' => 'candy.png',
        ]);

        DB::table('category')->insert([
            'name' => "Drinks",
            'img' => 'drink.png',
        ]);

        DB::table('category')->insert([
            'name' => "Desserts",
            'img' => 'dessert.png',
        ]);
    }
}
