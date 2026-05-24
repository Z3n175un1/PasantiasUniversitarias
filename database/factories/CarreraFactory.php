<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CarreraFactory extends Factory
{
    protected $model = \App\Models\Carrera::class;
        public function definition(): array
    {
        return [
            'nombre_carrera' => $this->faker->sentence(3),
            'area' => $this->faker->word(),
            'tipo_carrera' => $this->faker->randomElement(['Técnico', 'Licenciatura']),
        ];
    }
}
