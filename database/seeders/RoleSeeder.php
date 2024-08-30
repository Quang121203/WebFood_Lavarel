<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role')->insert([
            'id'=>1,
            'name' => "admin",
            'created_at' => now(),
        ]);

        DB::table('role')->insert([
            'id'=>2,
            'name' => "guest",
            'created_at' => now(),
        ]);

        DB::table('role')->insert([
            'id'=>3,
            'name' => "manager",
            'created_at' => now(),
        ]);
    }
}
