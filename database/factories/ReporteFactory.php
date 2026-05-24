<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReporteFactory extends Factory
{
    protected $model = \App\Models\Reporte::class;
        public function definition(): array
    {
        return [
            'fecha_reporte' => $this->faker->date(),
            'total_estudiantes' => $this->faker->randomNumber(2),
            'total_empresas' => $this->faker->randomNumber(2),
            'nuevas_postulaciones' => $this->faker->randomNumber(2),
        ];
    }
}
