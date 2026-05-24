<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UsuarioFactory extends Factory
{
    protected $model = \App\Models\Usuario::class;
        public function definition(): array
    {
        return [
            'id_rol' => \App\Models\Rol::factory(),
            'email' => $this->faker->unique()->safeEmail(),
            'contrasena_hash' => bcrypt('password'),
            'activo' => $this->faker->boolean(90),
            'intentos_fallidos' => 0,
            'eula_aceptada' => true,
            'fecha_creacion' => $this->faker->date(),
        ];
    }
}
