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
        User::factory()->create([
            'name' => 'AdridMini',
            'email' => 'selenagomez@pornhub.com',
            'phone_number' => '12345678',
            'university_id' => '123',
            'country' => 'Bolivia',
            'password' => Hash::make('adridmin123'),
        ]);
        User::factory()->create([
            'name' => 'FabriMini',
            'email' => 'miakhalifa@pornhub.com',
            'phone_number' => '12345678',
            'university_id' => '123',
            'country' => 'Bolivia',
            'password' => Hash::make('fabri123'),
        ]);
        User::factory()->create([
            'name' => 'AdridMini',
            'email' => 'selenagomez@pornhub.com',
            'phone_number' => '12345678',
            'university_id' => '123',
            'country' => 'Bolivia',
            'password' => Hash::make('adridmin123'),
        ]);
        User::factory()->create([
            'name' => 'FabriMini',
            'email' => 'miakhalifa@pornhub.com',
            'phone_number' => '12345678',
            'university_id' => '123',
            'country' => 'Bolivia',
            'password' => Hash::make('fabri123'),
        ]);
        User::factory()->create([
            'name' => 'OrlandoMini',
            'email' => 'orlandomin123@pornhub.com',
            'phone_number' => '12345678',
            'university_id' => '123',
            'country' => 'Bolivia',
            'password' => Hash::make('orlando123'),
        ]);
        User::factory()->create([
            'name' => 'Sanchino',
            'email' => 'sanchino@pornhub.com',
            'phone_number' => '12345678',
            'university_id' => '123',
            'country' => 'Bolivia',
            'password' => Hash::make('sanchino123'),
        ]);
    }
}
