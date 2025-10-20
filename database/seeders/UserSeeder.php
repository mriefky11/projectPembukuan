<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['id' => Str::uuid(), 'name' => 'Operator Sistem', 'email' => 'operator@example.com', 'role' => 'operator'],
            ['id' => Str::uuid(), 'name' => 'Bendahara Sekolah', 'email' => 'bendahara@example.com', 'role' => 'bendahara'],
            ['id' => Str::uuid(), 'name' => 'Kepala Sekolah', 'email' => 'kepala@example.com', 'role' => 'kepala_sekolah'],
            ['id' => Str::uuid(), 'name' => 'Yayasan', 'email' => 'yayasan@example.com', 'role' => 'yayasan'],
            ['id' => Str::uuid(), 'name' => 'test1', 'email' => 'test1@example.com', 'role' => 'bendahara'],
            ['id' => Str::uuid(), 'name' => 'test2', 'email' => 'test2@example.com', 'role' => 'bendahara'],
            ['id' => Str::uuid(), 'name' => 'test3', 'email' => 'test3@example.com', 'role' => 'bendahara'],
            ['id' => Str::uuid(), 'name' => 'test4', 'email' => 'test4@example.com', 'role' => 'bendahara'],
            ['id' => Str::uuid(), 'name' => 'test5', 'email' => 'test5@example.com', 'role' => 'bendahara'],
            ['id' => Str::uuid(), 'name' => 'test6', 'email' => 'test6@example.com', 'role' => 'bendahara'],
            ['id' => Str::uuid(), 'name' => 'test7', 'email' => 'test7@example.com', 'role' => 'bendahara'],
        ];

        foreach ($users as $u) {
            User::create([
                'id' => $u['id'],
                'name' => $u['name'],
                'email' => $u['email'],
                'role' => $u['role'],
                'password' => Hash::make('password'),
            ]);
        }
    }
}