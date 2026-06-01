<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $tipos = [
            ['id' => 1,  'nombre' => 'Usuario',       'descripcion' => 'Operaciones con usuarios del sistema'],
            ['id' => 2,  'nombre' => 'Empresa',        'descripcion' => 'Operaciones con perfiles de empresa'],
            ['id' => 3,  'nombre' => 'Estudiante',     'descripcion' => 'Operaciones con perfiles de estudiante'],
            ['id' => 4,  'nombre' => 'Oferta',         'descripcion' => 'Operaciones con ofertas de pasantía'],
            ['id' => 5,  'nombre' => 'Postulación',    'descripcion' => 'Operaciones con postulaciones'],
            ['id' => 6,  'nombre' => 'Inicio Sesión',  'descripcion' => 'Inicio de sesión en el sistema'],
            ['id' => 7,  'nombre' => 'Cierre Sesión',  'descripcion' => 'Cierre de sesión en el sistema'],
        ];

        foreach ($tipos as $tipo) {
            DB::table('tipos_entidad')->updateOrInsert(
                ['id' => $tipo['id']],
                $tipo
            );
        }
    }

    public function down(): void
    {
        DB::table('tipos_entidad')->whereIn('id', range(1, 7))->delete();
    }
};
