<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
   public function run(): void
   {
       DB::table('usuarios')->insert([
           [
               'nombre' => 'Administrador',
               'email' => 'admin@sistema.com',
               'password' => Hash::make('123456'),
               'rol_id' => 1
           ],
           [
               'nombre' => 'Empresa Demo',
               'email' => 'empresa@sistema.com',
               'password' => Hash::make('123456'),
               'rol_id' => 2
           ],
           [
               'nombre' => 'Estudiante Demo',
               'email' => 'estudiante@sistema.com',
               'password' => Hash::make('123456'),
               'rol_id' => 3
           ]
       ]);
   }
}

