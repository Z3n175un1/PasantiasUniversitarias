<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EstudianteFactory extends Factory
{
    protected $model = \App\Models\Estudiante::class;
        public function definition(): array
    {
        return [
            'id_usuario' => \App\Models\Usuario::factory(),
            'id_carrera' => \App\Models\Carrera::factory(),
            'ci' => (string)$this->faker->unique()->randomNumber(8, true),
            'email_institucional' => $this->faker->unique()->companyEmail(),
            'fecha_nacimiento' => $this->faker->date(),
        ];
    }
}
