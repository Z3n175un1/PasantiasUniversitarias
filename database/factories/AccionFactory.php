<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AccionFactory extends Factory
{
    protected $model = \App\Models\Accion::class;
        public function definition(): array
    {
        return [
            'id_usuario' => \App\Models\Usuario::factory(),
            'tipo_accion' => 'Login',
            'descripcion' => 'Usuario inició sesión',
            'fecha_accion' => $this->faker->dateTime(),
            'direccion_ip' => $this->faker->ipv4(),
        ];
    }
}
