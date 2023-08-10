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
            //member
            [
                'name' => 'member',
                'email' => 'member@gmail.com',
                'cash' => 5000000,
                'password' => bcrypt('member'),
                'user_role' => 1,
            ],
            //ctv
            [
                'name' => 'ctv',
                'email' => 'ctv@gmail.com',
                'cash' => 5000000,
                'password' => bcrypt('ctv'),
                'user_role' => 2,
            ],
            //admin
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'cash' => 5000000,
                'password' => bcrypt('admin'),
                'user_role' => 3,
            ]
        ]);

        
    }
}
