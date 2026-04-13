<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear un usuario de prueba simple
        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'phone_number' => '12345678',
            'university_id' => '123',
            'country' => 'Bolivia',
            'password' => Hash::make('password'),
        ]);
    }
}
