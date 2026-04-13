
-- 1. MÓDULO DE SEGURIDAD Y ACCESOS
CREATE TABLE Roles (
    id_rol INT AUTO_INCREMENT PRIMARY KEY,
    nombre_rol VARCHAR(50) NOT NULL UNIQUE,
    descripcion TEXT
);

CREATE TABLE Permisos (
    id_permiso INT AUTO_INCREMENT PRIMARY KEY,
    descripcion_accion VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE Usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    id_rol INT NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    two_fa_enabled BOOLEAN DEFAULT FALSE,
    last_login TIMESTAMP NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_rol) REFERENCES Roles(id_rol)
);

CREATE TABLE Rol_Permiso (
    id_rol INT NOT NULL,
    id_permiso INT NOT NULL,
    PRIMARY KEY (id_rol, id_permiso),
    FOREIGN KEY (id_rol) REFERENCES Roles(id_rol) ON DELETE CASCADE,
    FOREIGN KEY (id_permiso) REFERENCES Permisos(id_permiso) ON DELETE CASCADE
);

CREATE TABLE Auditoria_Logs (
    id_log INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    accion VARCHAR(255) NOT NULL,
    tabla_afectada VARCHAR(50),
    fecha_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ip_origen VARCHAR(45),
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario) ON DELETE SET NULL
);

-- 2. MÓDULO ACADÉMICO
CREATE TABLE Facultades (
    id_facultad INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE Carreras (
    id_carrera INT AUTO_INCREMENT PRIMARY KEY,
    id_facultad INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    FOREIGN KEY (id_facultad) REFERENCES Facultades(id_facultad)
);

CREATE TABLE Habilidades (
    id_habilidad INT AUTO_INCREMENT PRIMARY KEY,
    nombre_skill VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE Estudiantes (
    id_estudiante INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL UNIQUE,
    id_carrera INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    matricula VARCHAR(20) NOT NULL UNIQUE,
    promedio_academico DECIMAL(4,2),
    estado_seguro_medico VARCHAR(50),
    cv_url VARCHAR(255),
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario) ON DELETE CASCADE,
    FOREIGN KEY (id_carrera) REFERENCES Carreras(id_carrera)
);

CREATE TABLE Estudiante_Habilidades (
    id_estudiante INT NOT NULL,
    id_habilidad INT NOT NULL,
    nivel_dominio ENUM('Básico', 'Intermedio', 'Avanzado'),
    PRIMARY KEY (id_estudiante, id_habilidad),
    FOREIGN KEY (id_estudiante) REFERENCES Estudiantes(id_estudiante) ON DELETE CASCADE,
    FOREIGN KEY (id_habilidad) REFERENCES Habilidades(id_habilidad) ON DELETE CASCADE
);

-- 3. MÓDULO CORPORATIVO Y LEGAL
CREATE TABLE Empresas (
    id_empresa INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL UNIQUE,
    razon_social VARCHAR(150) NOT NULL,
    nit_rut VARCHAR(50) NOT NULL UNIQUE,
    sector_industrial VARCHAR(100),
    verificada BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario) ON DELETE CASCADE
);

CREATE TABLE Sucursales (
    id_sucursal INT AUTO_INCREMENT PRIMARY KEY,
    id_empresa INT NOT NULL,
    ciudad VARCHAR(100) NOT NULL,
    direccion TEXT NOT NULL,
    telefono_contacto VARCHAR(20),
    FOREIGN KEY (id_empresa) REFERENCES Empresas(id_empresa) ON DELETE CASCADE
);

CREATE TABLE Convenios_Legales (
    id_convenio INT AUTO_INCREMENT PRIMARY KEY,
    id_empresa INT NOT NULL,
    codigo_resolucion VARCHAR(50) UNIQUE NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NOT NULL,
    url_pdf_convenio VARCHAR(255),
    estado_convenio ENUM('Activo', 'Vencido', 'Suspendido') DEFAULT 'Activo',
    FOREIGN KEY (id_empresa) REFERENCES Empresas(id_empresa),
    CONSTRAINT chk_fechas_convenio CHECK (fecha_fin > fecha_inicio)
);

-- 4. MÓDULO DE RECLUTAMIENTO
CREATE TABLE Ofertas_Pasantia (
    id_oferta INT AUTO_INCREMENT PRIMARY KEY,
    id_empresa INT NOT NULL,
    id_sucursal INT NOT NULL,
    titulo VARCHAR(150) NOT NULL,
    descripcion_puesto TEXT NOT NULL,
    requisitos TEXT,
    cupos_disponibles INT NOT NULL DEFAULT 1,
    es_remunerada BOOLEAN DEFAULT FALSE,
    monto_remuneracion DECIMAL(10,2) DEFAULT 0.00,
    estado_oferta ENUM('Borrador', 'Abierta', 'Cerrada') DEFAULT 'Abierta',
    fecha_publicacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_empresa) REFERENCES Empresas(id_empresa),
    FOREIGN KEY (id_sucursal) REFERENCES Sucursales(id_sucursal)
);

CREATE TABLE Oferta_Habilidades (
    id_oferta INT NOT NULL,
    id_habilidad INT NOT NULL,
    es_obligatorio BOOLEAN DEFAULT TRUE,
    PRIMARY KEY (id_oferta, id_habilidad),
    FOREIGN KEY (id_oferta) REFERENCES Ofertas_Pasantia(id_oferta) ON DELETE CASCADE,
    FOREIGN KEY (id_habilidad) REFERENCES Habilidades(id_habilidad) ON DELETE CASCADE
);

CREATE TABLE Postulaciones (
    id_postulacion INT AUTO_INCREMENT PRIMARY KEY,
    id_estudiante INT NOT NULL,
    id_oferta INT NOT NULL,
    fecha_postulacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado_postulacion ENUM('Recibida', 'En Revision', 'Entrevista', 'Aceptada', 'Rechazada') DEFAULT 'Recibida',
    comentarios_reclutador TEXT,
    FOREIGN KEY (id_estudiante) REFERENCES Estudiantes(id_estudiante),
    FOREIGN KEY (id_oferta) REFERENCES Ofertas_Pasantia(id_oferta)
);

-- 5. MÓDULO DE EJECUCIÓN Y TRAZABILIDAD
CREATE TABLE Pasantias_Oficiales (
    id_pasantia INT AUTO_INCREMENT PRIMARY KEY,
    id_postulacion INT NOT NULL UNIQUE,
    id_tutor_universidad INT NOT NULL,
    id_supervisor_empresa INT NOT NULL,
    fecha_inicio_real DATE NOT NULL,
    fecha_fin_estimada DATE NOT NULL,
    estado_pasantia ENUM('Iniciada', 'En Curso', 'Finalizada', 'Suspendida', 'Cancelada') DEFAULT 'Iniciada',
    FOREIGN KEY (id_postulacion) REFERENCES Postulaciones(id_postulacion),
    FOREIGN KEY (id_tutor_universidad) REFERENCES Usuarios(id_usuario),
    FOREIGN KEY (id_supervisor_empresa) REFERENCES Usuarios(id_usuario)
);

CREATE TABLE Bitacoras_Seguimiento (
    id_bitacora INT AUTO_INCREMENT PRIMARY KEY,
    id_pasantia INT NOT NULL,
    semana_numero INT NOT NULL,
    actividades_realizadas TEXT NOT NULL,
    horas_totales_semana DECIMAL(4,2) NOT NULL,
    estado_aprobacion ENUM('Pendiente', 'Aprobado_Empresa', 'Aprobado_Tutor', 'Rechazado') DEFAULT 'Pendiente',
    fecha_entrega TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_pasantia) REFERENCES Pasantias_Oficiales(id_pasantia) ON DELETE CASCADE
);

CREATE TABLE Evaluaciones (
    id_evaluacion INT AUTO_INCREMENT PRIMARY KEY,
    id_pasantia INT NOT NULL,
    tipo_evaluador ENUM('Empresa', 'Universidad') NOT NULL,
    puntaje_tecnico INT CHECK (puntaje_tecnico BETWEEN 1 AND 10),
    puntaje_blando INT CHECK (puntaje_blando BETWEEN 1 AND 10),
    comentarios_adicionales TEXT,
    fecha_evaluacion DATE NOT NULL,
    FOREIGN KEY (id_pasantia) REFERENCES Pasantias_Oficiales(id_pasantia) ON DELETE CASCADE
);

CREATE TABLE Documentos_Expediente (
    id_documento INT AUTO_INCREMENT PRIMARY KEY,
    id_pasantia INT NOT NULL,
    tipo_documento VARCHAR(100) NOT NULL, -- Ej: 'Seguro Contra Accidentes', 'Informe Final', 'Carta Aceptacion'
    url_archivo VARCHAR(255) NOT NULL,
    fecha_subida TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_pasantia) REFERENCES Pasantias_Oficiales(id_pasantia) ON DELETE CASCADE
);

-- Índices sugeridos para optimizar búsquedas frecuentes
CREATE INDEX idx_usuarios_email ON Usuarios(email);
CREATE INDEX idx_estudiantes_matricula ON Estudiantes(matricula);
CREATE INDEX idx_ofertas_estado ON Ofertas_Pasantia(estado_oferta);
CREATE INDEX idx_postulaciones_estado ON Postulaciones(estado_postulacion);