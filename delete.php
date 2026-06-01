<?php

try {

    // Conexión PDO PostgreSQL
    $host = "localhost";
    $port = "5432";
    $dbname = "sexualidad";
    $user = "tumama";
    $password = "";

    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";

    $pdo = new PDO($dsn, $user, $password);

    // Configuración recomendada
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Lista de usuarios
    $usuarios = [
        [
            'id' => 2,
            'rol_id' => 3,
            'nombre' => 'Jalasoft Admin',
            'correo' => 'admin@jalasoft.com',
            'contrasena' => '123456789',
            'activo' => 1,
            'creado_en' => '2026-05-11 09:23:00'
        ],
        [
            'id' => 3,
            'rol_id' => 3,
            'nombre' => 'Tigo Admin',
            'correo' => 'admin@tigo.com.bo',
            'contrasena' => '123456789',
            'activo' => 1,
            'creado_en' => '2026-05-11 09:23:00'
        ],
        [
            'id' => 4,
            'rol_id' => 3,
            'nombre' => 'Datec Admin',
            'correo' => 'admin@datec.com.bo',
            'contrasena' => '123456789',
            'activo' => 1,
            'creado_en' => '2026-05-11 09:23:00'
        ],
        [
            'id' => 5,
            'rol_id' => 3,
            'nombre' => 'Jatun Code Admin',
            'correo' => 'admin@jatuncode.bo',
            'contrasena' => '123456789',
            'activo' => 1,
            'creado_en' => '2026-05-11 09:23:00'
        ]
    ];

    // SQL preparado
    $sql = "
        INSERT INTO public.usuarios
        (
            id,
            rol_id,
            nombre,
            correo,
            contrasena_hash,
            activo,
            creado_en
        )
        VALUES
        (
            :id,
            :rol_id,
            :nombre,
            :correo,
            :contrasena_hash,
            :activo,
            :creado_en
        )
    ";

    // Preparar consulta
    $stmt = $pdo->prepare($sql);

    // Insertar usuarios
    foreach ($usuarios as $usuario) {

        // Hash seguro
        $contrasena_hash = password_hash(
            $usuario['contrasena'],
            PASSWORD_BCRYPT
        );

        $stmt->execute([
            ':id' => $usuario['id'],
            ':rol_id' => $usuario['rol_id'],
            ':nombre' => $usuario['nombre'],
            ':correo' => $usuario['correo'],
            ':contrasena_hash' => $contrasena_hash,
            ':activo' => $usuario['activo'],
            ':creado_en' => $usuario['creado_en']
        ]);

        echo "Usuario {$usuario['nombre']} insertado correctamente.<br>";
    }

} catch (PDOException $e) {

    echo "Error de conexión o inserción: " . $e->getMessage();

}
?>