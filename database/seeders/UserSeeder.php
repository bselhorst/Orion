<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@admin',
            'password' => Hash::make('admin'),
        ])->assignRole('Admin');

        \App\Models\User::create([
            'name' => 'User',
            'email' => 'user@user',
            'password' => Hash::make('user'),
        ])->assignRole('User');
    }
}
