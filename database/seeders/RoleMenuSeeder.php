<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RoleMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role_menu')->insert([
            'role_id' => 1,
            'menu_id' => 3,
            'created_at' => now(),
        ]);

        DB::table('role_menu')->insert([
            'role_id' => 1,
            'menu_id' => 4,
            'created_at' => now(),
        ]);

        DB::table('role_menu')->insert([
            'role_id' => 1,
            'menu_id' => 5,
            'created_at' => now(),
        ]);

        DB::table('role_menu')->insert([
            'role_id' => 1,
            'menu_id' => 6,
            'created_at' => now(),
        ]);

        DB::table('role_menu')->insert([
            'role_id' => 1,
            'menu_id' => 7,
            'created_at' => now(),
        ]);

        DB::table('role_menu')->insert([
            'role_id' => 3,
            'menu_id' => 3,
            'created_at' => now(),
        ]);

        DB::table('role_menu')->insert([
            'role_id' => 3,
            'menu_id' => 4,
            'created_at' => now(),
        ]);

        DB::table('role_menu')->insert([
            'role_id' => 3,
            'menu_id' => 5,
            'created_at' => now(),
        ]);

    }
}
