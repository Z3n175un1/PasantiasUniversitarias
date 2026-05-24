<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UbicacionFactory extends Factory
{
    protected $model = \App\Models\Ubicacion::class;
        public function definition(): array
    {
        return [
            'ciudad' => $this->faker->city(),
            'localidad' => $this->faker->streetName(),
            'direccion' => $this->faker->address(),
            'es_sede' => $this->faker->boolean(),
            'nombre_sede' => $this->faker->company(),
        ];
    }
}
