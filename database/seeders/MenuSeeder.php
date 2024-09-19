<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menu')->insert([
            'id' => 1,
            'name' => "Management",
            'icon'=>"fa fa-cube",
            'level' => "0",
            'link' => null,
            'id_parent' => null,
            'isActive' => true,
            'created_at' => now(),
        ]);

        DB::table('menu')->insert([
            'id' => 2,
            'name' => "System",
            'icon'=>"fa fa-cog",
            'level' => "0",
            'link' => null,
            'id_parent' => null,
            'isActive' => true,
            'created_at' => now(),
        ]);

        DB::table('menu')->insert([
            'id' => 3,
            'name' => "Category",
            'icon'=>'fa-solid fa-layer-group',
            'level' => "1",
            'link' => '/category',
            'id_parent' => '1',
            'isActive' => true,
            'created_at' => now(),
        ]);

        DB::table('menu')->insert([
            'id' => 4,
            'name' => "Product",
            'icon'=>'fa fa-cutlery',
            'level' => "1",
            'link' => '/product',
            'id_parent' => '1',
            'isActive' => true,
            'created_at' => now(),
        ]);

        DB::table('menu')->insert([
            'id' => 5,
            'name' => "Order",
            'icon'=>'fa-solid fa-clipboard-list',
            'level' => "1",
            'link' => '/order',
            'id_parent' => '1',
            'isActive' => true,
            'created_at' => now(),
        ]);

        DB::table('menu')->insert([
            'id' => 6,
            'name' => "User",
            'icon'=>'fa fa-user',
            'level' => "1",
            'link' => '/user',
            'id_parent' => '2',
            'isActive' => true,
            'created_at' => now(),
        ]);

        DB::table('menu')->insert([
            'id' => 7,
            'name' => "Role",
            'icon'=>'fa fa-users',
            'level' => "1",
            'link' => '/role',
            'id_parent' => '2',
            'isActive' => true,
            'created_at' => now(),
        ]);
    }
}
