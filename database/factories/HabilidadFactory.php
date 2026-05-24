<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HabilidadFactory extends Factory
{
    protected $model = \App\Models\Habilidad::class;
        public function definition(): array
    {
        return [
            'nombre_habilidad' => $this->faker->word(),
            'tipo_habilidad' => $this->faker->word(),
        ];
    }
}
