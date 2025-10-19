<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Operator Sistem', 'email' => 'operator@example.com', 'role' => 'operator'],
            ['name' => 'Bendahara Sekolah', 'email' => 'bendahara@example.com', 'role' => 'bendahara'],
            ['name' => 'Kepala Sekolah', 'email' => 'kepala@example.com', 'role' => 'kepala_sekolah'],
            ['name' => 'Yayasan', 'email' => 'yayasan@example.com', 'role' => 'yayasan'],
            ['name' => 'test1', 'email' => 'test1@example.com', 'role' => 'bendahara'],
            ['name' => 'test2', 'email' => 'test2@example.com', 'role' => 'bendahara'],
            ['name' => 'test3', 'email' => 'test3@example.com', 'role' => 'bendahara'],
            ['name' => 'test4', 'email' => 'test4@example.com', 'role' => 'bendahara'],
            ['name' => 'test5', 'email' => 'test5@example.com', 'role' => 'bendahara'],
            ['name' => 'test6', 'email' => 'test6@example.com', 'role' => 'bendahara'],
            ['name' => 'test7', 'email' => 'test7@example.com', 'role' => 'bendahara'],
        ];

        foreach ($users as $u) {
            User::create([
                'name' => $u['name'],
                'email' => $u['email'],
                'role' => $u['role'],
                'password' => Hash::make('password'),
            ]);
        }
    }
}