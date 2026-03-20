<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        if (DB::table('users')->count() > 0) return;

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@thezignhotel.com',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
