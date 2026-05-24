<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Rol::factory(10)->create();
        \App\Models\Carrera::factory(10)->create();
        \App\Models\Ubicacion::factory(10)->create();
        \App\Models\Rubro::factory(10)->create();
        \App\Models\Habilidad::factory(10)->create();
        \App\Models\Reporte::factory(10)->create();
        \App\Models\Usuario::factory(10)->create();
        \App\Models\Estudiante::factory(10)->create();
        \App\Models\Empresa::factory(10)->create();
        \App\Models\Pasantia::factory(10)->create();
        \App\Models\Postulacion::factory(10)->create();
        \App\Models\Documento::factory(10)->create();
        \App\Models\Ticket::factory(10)->create();
        \App\Models\Accion::factory(10)->create();
    }
}
