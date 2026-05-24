<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostulacionFactory extends Factory
{
    protected $model = \App\Models\Postulacion::class;
        public function definition(): array
    {
        return [
            'id_estudiante' => \App\Models\Estudiante::factory(),
            'id_pasantia' => \App\Models\Pasantia::factory(),
            'fecha_postulacion' => $this->faker->date(),
            'estado' => $this->faker->randomElement(['Pendiente', 'Aceptada', 'Rechazada']),
        ];
    }
}
