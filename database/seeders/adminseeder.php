<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class adminseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Adridmin',
            'email' => [EMAIL_ADDRESS],
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'password' => Hash::make('adridmin123'),
            'role' => 'admin'
        ]);
        DB::table('users')->insert([
            'name' => 'Fabridmin',
            'email' => [EMAIL_ADDRESS],
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'password' => Hash::make('fabri123'),
            'role' => 'admin'
        ]);
    }
}
