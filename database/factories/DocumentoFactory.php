<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentoFactory extends Factory
{
    protected $model = \App\Models\Documento::class;
        public function definition(): array
    {
        return [
            'id_estudiante' => \App\Models\Estudiante::factory(),
            'tipo_documento' => 'CV',
            'archivo_nombre' => $this->faker->word() . '.pdf',
            'archivo_hash' => md5($this->faker->word()),
            'extension' => 'pdf',
            'fecha_subida' => $this->faker->date(),
            'encriptado' => false,
        ];
    }
}
