<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'name' => "cake 01",
            "category_id"=> 1,
            'price' => '20',
            'img' =>"cake 01.png",
            'created_at' => now(),
        ]);

        DB::table('products')->insert([
            'name' => "cake 02",
            "category_id"=> 1,
            'price' => '40',
            'img' =>"cake 02.png",
            'created_at' => now(),
        ]);

        DB::table('products')->insert([
            'name' => "candy 01",
            "category_id"=> 2,
            'price' => '30',
            'img' =>"candy 01.png",
            'created_at' => now(),
        ]);

        DB::table('products')->insert([
            'name' => "candy 02",
            "category_id"=> 2,
            'price' => '30',
            'img' =>"candy 02.png",
            'created_at' => now(),
        ]);

        DB::table('products')->insert([
            'name' => "drink 01",
            "category_id"=> 3,
            'price' => '50',
            'img' =>"drink 01.png",
            'created_at' => now(),
        ]);

        DB::table('products')->insert([
            'name' => "drink 02",
            "category_id"=> 3,
            'price' => '50',
            'img' =>"drink 02.png",
            'created_at' => now(),
        ]);

        DB::table('products')->insert([
            'name' => "dessert 01",
            "category_id"=> 4,
            'price' => '150',
            'img' =>"dessert 01.png",
            'created_at' => now(),
        ]);

        DB::table('products')->insert([
            'name' => "dessert 02",
            "category_id"=> 4,
            'price' => '250',
            'img' =>"dessert 02.png",
            'created_at' => now(),
        ]);
    }
}
