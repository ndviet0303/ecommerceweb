<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('role')->insert([[
            'name' => 'member',
        ], [
            'name' => 'CTV',
        ], [
            'name' => 'Admin',
        ]]);

        DB::table('product_type')->insert([[
            'name' => 'Tool Game X',
        ]]);

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'zietcute@gmail.com',
            'cash' => 5000000,
            'password' => bcrypt('zietkk1234'),
            'user_role' => 1,
        ]);
    }
}
