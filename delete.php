<?php

try {

    // Conexión PDO PostgreSQL
    $host = "localhost";
    $port = "5432";
    $dbname = "pasantias";
    $user = "postgres";
    $password = "Jadrian8";

    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";

    $pdo = new PDO($dsn, $user, $password);

    // Configuración recomendada
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Datos del usuario
    $id = 1;
    $rol_id = 3;
    $nombre = "prueba";
    $correo = "prueba@edu.bo";
    $activo = 1;
    $creado_en = "2026-05-11 09:23:00";

    // Contraseña segura
    $contrasena = "123456789";
    $contrasena_hash = password_hash($contrasena, PASSWORD_BCRYPT);

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

    // Ejecutar
    $stmt->execute([
        ':id' => $id,
        ':rol_id' => $rol_id,
        ':nombre' => $nombre,
        ':correo' => $correo,
        ':contrasena_hash' => $contrasena_hash,
        ':activo' => $activo,
        ':creado_en' => $creado_en
    ]);

    echo "Usuario insertado correctamente.";
    echo "BORRADO INMEDIATE DE USUARIOS DE LA BASE DE DATOS";

} catch (PDOException $e) {

    echo "Error de conexión o inserción: " . $e->getMessage();

}