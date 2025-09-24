<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Bendahara',
                'email' => 'bendahara@example.com',
                'password' => Hash::make('password123'),
                'role' => 'bendahara',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kepala Sekolah',
                'email' => 'kepala@example.com',
                'password' => Hash::make('password123'),
                'role' => 'kepala_sekolah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Yayasan',
                'email' => 'yayasan@example.com',
                'password' => Hash::make('password123'),
                'role' => 'yayasan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Operator',
                'email' => 'operator@example.com',
                'password' => Hash::make('password123'),
                'role' => 'operator',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
