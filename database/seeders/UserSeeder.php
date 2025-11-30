<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Men Sokkeang',
                'email' => 'men.sokkeang@example.com',
                'password' => Hash::make('password123'),
                'role' => 'business',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bou Gakleang',
                'email' => 'bou.gakleang@example.com',
                'password' => Hash::make('password123'),
                'role' => 'customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ly Yenyen',
                'email' => 'ly.yenyen@example.com',
                'password' => Hash::make('password123'),
                'role' => 'customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kun Sreynak',
                'email' => 'kun.sreynak@example.com',
                'password' => Hash::make('password123'),
                'role' => 'customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Din Sokkhan',
                'email' => 'din.sokkhan@example.com',
                'password' => Hash::make('password123'),
                'role' => 'customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
