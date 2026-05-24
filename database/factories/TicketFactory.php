<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    protected $model = \App\Models\Ticket::class;
        public function definition(): array
    {
        return [
            'id_usuario' => \App\Models\Usuario::factory(),
            'titulo' => $this->faker->sentence(),
            'descripcion' => $this->faker->paragraph(),
            'tipo_ticket' => 'Soporte',
            'prioridad' => $this->faker->numberBetween(1, 5),
            'revisado' => false,
            'fecha_creacion' => $this->faker->date(),
        ];
    }
}
