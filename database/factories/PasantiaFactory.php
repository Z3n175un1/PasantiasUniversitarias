<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PasantiaFactory extends Factory
{
    protected $model = \App\Models\Pasantia::class;
        public function definition(): array
    {
        $published = $this->faker->date();
        return [
            'id_empresa' => \App\Models\Empresa::factory(),
            'id_ubicacion' => \App\Models\Ubicacion::factory(),
            'titulo' => $this->faker->jobTitle(),
            'descripcion' => $this->faker->paragraph(),
            'area' => $this->faker->word(),
            'fecha_publicacion' => $published,
            'fecha_cierre' => date('Y-m-d', strtotime($published. ' + 30 days')),
            'activa' => $this->faker->boolean(80),
        ];
    }
}
