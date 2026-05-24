<?php

$factoriesData = [
    'Rol' => <<<'EOT'
    public function definition(): array
    {
        return [
            'nombre_rol' => $this->faker->word(),
        ];
    }
EOT,
    'Carrera' => <<<'EOT'
    public function definition(): array
    {
        return [
            'nombre_carrera' => $this->faker->sentence(3),
            'area' => $this->faker->word(),
            'tipo_carrera' => $this->faker->randomElement(['Técnico', 'Licenciatura']),
        ];
    }
EOT,
    'Ubicacion' => <<<'EOT'
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
EOT,
    'Rubro' => <<<'EOT'
    public function definition(): array
    {
        return [
            'nombre_rubro' => $this->faker->jobTitle(),
        ];
    }
EOT,
    'Habilidad' => <<<'EOT'
    public function definition(): array
    {
        return [
            'nombre_habilidad' => $this->faker->word(),
            'tipo_habilidad' => $this->faker->word(),
        ];
    }
EOT,
    'Reporte' => <<<'EOT'
    public function definition(): array
    {
        return [
            'fecha_reporte' => $this->faker->date(),
            'total_estudiantes' => $this->faker->randomNumber(2),
            'total_empresas' => $this->faker->randomNumber(2),
            'nuevas_postulaciones' => $this->faker->randomNumber(2),
        ];
    }
EOT,
    'Usuario' => <<<'EOT'
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
EOT,
    'Estudiante' => <<<'EOT'
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
EOT,
    'Empresa' => <<<'EOT'
    public function definition(): array
    {
        return [
            'id_usuario' => \App\Models\Usuario::factory(),
            'nombre_empresa' => $this->faker->company(),
            'id_rubro' => \App\Models\Rubro::factory(),
            'id_ubicacion' => \App\Models\Ubicacion::factory(),
            'descripcion' => $this->faker->paragraph(),
        ];
    }
EOT,
    'Pasantia' => <<<'EOT'
    public function definition(): array
    {
        $published = $this->faker->date();
        return [
            'id_empresa' => \App\Models\Empresa::factory(),
            'id_ubicacion' => \App\Models\Ubicacion::factory(),
            'titulo' => $this->faker->jobTitle(),
            'descripcion' => $this->faker->paragraph(),
            'area' => $this->faker->word(),
            'fecha_publicacion' => $published,
            'fecha_cierre' => date('Y-m-d', strtotime($published. ' + 30 days')),
            'activa' => $this->faker->boolean(80),
        ];
    }
EOT,
    'Postulacion' => <<<'EOT'
    public function definition(): array
    {
        return [
            'id_estudiante' => \App\Models\Estudiante::factory(),
            'id_pasantia' => \App\Models\Pasantia::factory(),
            'fecha_postulacion' => $this->faker->date(),
            'estado' => $this->faker->randomElement(['Pendiente', 'Aceptada', 'Rechazada']),
        ];
    }
EOT,
    'Documento' => <<<'EOT'
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
EOT,
    'Ticket' => <<<'EOT'
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
EOT,
    'Accion' => <<<'EOT'
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
EOT,
];

foreach ($factoriesData as $model => $definition) {
    $path = __DIR__ . '/database/factories/' . $model . 'Factory.php';
    if (file_exists($path)) {
        $content = file_get_contents($path);
        // Replace empty definition array returning nothing
        $content = preg_replace('/public function definition\(\): array\s*{\s*return \[[^\]]*\];\s*}/', $definition, $content);
        file_put_contents($path, $content);
    }
}
echo "SUCCESS";
