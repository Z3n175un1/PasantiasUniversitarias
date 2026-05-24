<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmpresaFactory extends Factory
{
    protected $model = \App\Models\Empresa::class;
        public function definition(): array
    {
        return [
            'id_usuario' => \App\Models\Usuario::factory(),
            'nombre_empresa' => $this->faker->company(),
            'id_rubro' => \App\Models\Rubro::factory(),
            'id_ubicacion' => \App\Models\Ubicacion::factory(),
            'descripcion' => $this->faker->paragraph(),
        ];
    }
}
