<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RubroFactory extends Factory
{
    protected $model = \App\Models\Rubro::class;
        public function definition(): array
    {
        return [
            'nombre_rubro' => $this->faker->jobTitle(),
        ];
    }
}
