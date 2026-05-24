/*Nueva Base de datos actualizada y re-editada en fecha mayo 2026*/

/*

              ╱▏┈┈┈┈┈┈   ▕╲▕╲┈┈┈
             ▏▏┈┈┈┈┈┈    ▏▔▔╲┈┈
            ▏ ╲┈┈┈┈┈┈┈┈┈┈╱┈┈▔┈▔╲┈
            ╲┃ ▔▔▔▔▔▔╯╯  ╰┳━━▀
            ┈┃╯╯╯╯╯╯╯╯╯╯╯╯    ╱┃┈┈┈
            ┈┃┏━━┳┳━━━━━━━┫┣━━┳┃┈┈┈
            ┈┃┃  ┃┃┈┈┈┈┈┈┈┃┃  ┃┃┈┈┈
            ┈┗┛  ┗┛┈┈┈┈┈┈┈┗┛  ┗┛┈┈┈
                < Z3N175UN1 >
                   GITHUB

*/
-- =================================================================================
-- CREACION DE BASE DE DATOS
-- =================================================================================

CREATE SCHEMA IF NOT EXISTS global;
SET search_path TO global;

-- =================================================================================
-- CREACIÓN DE TABLAS INDEPENDIENTES (Sin Foreign Keys)
-- =================================================================================

CREATE TABLE Rol (
    id_rol SERIAL PRIMARY KEY,
    nombre_rol VARCHAR(30) NOT NULL
);

CREATE TABLE Carrera (
    id_carrera SERIAL PRIMARY KEY,
    nombre_carrera VARCHAR(100) NOT NULL,
    area VARCHAR(50),
    tipo_carrera VARCHAR(30)
);

CREATE TABLE Ubicacion (
    id_ubicacion SERIAL PRIMARY KEY,
    ciudad VARCHAR(50),
    localidad VARCHAR(50),
    direccion VARCHAR(150),
    es_sede BOOLEAN DEFAULT FALSE,
    nombre_sede VARCHAR(50)
);

CREATE TABLE Rubro (
    id_rubro SERIAL PRIMARY KEY,
    nombre_rubro VARCHAR(50) NOT NULL
);

CREATE TABLE Habilidad (
    id_habilidad SERIAL PRIMARY KEY,
    nombre_habilidad VARCHAR(50) NOT NULL,
    tipo_habilidad VARCHAR(30)
);

CREATE TABLE Reporte (
    id_reporte SERIAL PRIMARY KEY,
    fecha_reporte DATE NOT NULL,
    total_estudiantes INTEGER DEFAULT 0,
    total_empresas INTEGER DEFAULT 0,
    nuevas_postulaciones INTEGER DEFAULT 0
);

-- =================================================================================
-- CREACIÓN DE TABLAS CON DEPENDENCIAS (Con Foreign Keys)
-- =================================================================================

CREATE TABLE Usuario (
    id_usuario SERIAL PRIMARY KEY,
    id_rol INTEGER NOT NULL REFERENCES Rol(id_rol) ON DELETE RESTRICT,
    email VARCHAR(100) UNIQUE NOT NULL,
    contrasena_hash VARCHAR(255) NOT NULL,
    activo BOOLEAN DEFAULT TRUE,
    intentos_fallidos INTEGER DEFAULT 0,
    eula_aceptada BOOLEAN DEFAULT FALSE,
    fecha_creacion DATE DEFAULT CURRENT_DATE
);

CREATE TABLE Estudiante (
    id_estudiante SERIAL PRIMARY KEY,
    id_usuario INTEGER NOT NULL REFERENCES Usuario(id_usuario) ON DELETE CASCADE,
    id_carrera INTEGER NOT NULL REFERENCES Carrera(id_carrera) ON DELETE RESTRICT,
    ci VARCHAR(12) UNIQUE NOT NULL,
    email_institucional VARCHAR(100) UNIQUE,
    fecha_nacimiento DATE
);

CREATE TABLE Empresa (
    id_empresa SERIAL PRIMARY KEY,
    id_usuario INTEGER NOT NULL REFERENCES Usuario(id_usuario) ON DELETE CASCADE,
    nombre_empresa VARCHAR(100) NOT NULL,
    id_rubro INTEGER NOT NULL REFERENCES Rubro(id_rubro) ON DELETE RESTRICT,
    id_ubicacion INTEGER NOT NULL REFERENCES Ubicacion(id_ubicacion) ON DELETE RESTRICT,
    descripcion TEXT
);

CREATE TABLE Pasantia (
    id_pasantia SERIAL PRIMARY KEY,
    id_empresa INTEGER NOT NULL REFERENCES Empresa(id_empresa) ON DELETE CASCADE,
    id_ubicacion INTEGER NOT NULL REFERENCES Ubicacion(id_ubicacion) ON DELETE RESTRICT,
    titulo VARCHAR(100) NOT NULL,
    descripcion TEXT,
    area VARCHAR(50),
    fecha_publicacion DATE DEFAULT CURRENT_DATE,
    fecha_cierre DATE,
    activa BOOLEAN DEFAULT TRUE
);

-- Tablas intermedias (Muchos a Muchos)
CREATE TABLE Pasantia_Habilidad (
    id_pasantia INTEGER NOT NULL REFERENCES Pasantia(id_pasantia) ON DELETE CASCADE,
    id_habilidad INTEGER NOT NULL REFERENCES Habilidad(id_habilidad) ON DELETE CASCADE,
    PRIMARY KEY (id_pasantia, id_habilidad)
);

CREATE TABLE Estudiante_Habilidad (
    id_estudiante INTEGER NOT NULL REFERENCES Estudiante(id_estudiante) ON DELETE CASCADE,
    id_habilidad INTEGER NOT NULL REFERENCES Habilidad(id_habilidad) ON DELETE CASCADE,
    PRIMARY KEY (id_estudiante, id_habilidad)
);

CREATE TABLE Postulacion (
    id_postulacion SERIAL PRIMARY KEY,
    id_estudiante INTEGER NOT NULL REFERENCES Estudiante(id_estudiante) ON DELETE CASCADE,
    id_pasantia INTEGER NOT NULL REFERENCES Pasantia(id_pasantia) ON DELETE CASCADE,
    fecha_postulacion DATE DEFAULT CURRENT_DATE,
    estado VARCHAR(20) DEFAULT 'Pendiente'
);

CREATE TABLE Documento (
    id_documento SERIAL PRIMARY KEY,
    id_estudiante INTEGER NOT NULL REFERENCES Estudiante(id_estudiante) ON DELETE CASCADE,
    tipo_documento VARCHAR(30),
    archivo_nombre VARCHAR(255) NOT NULL,
    archivo_hash VARCHAR(255) NOT NULL,
    extension VARCHAR(10),
    fecha_subida DATE DEFAULT CURRENT_DATE,
    encriptado BOOLEAN DEFAULT FALSE
);

CREATE TABLE Ticket (
    id_ticket SERIAL PRIMARY KEY,
    id_usuario INTEGER NOT NULL REFERENCES Usuario(id_usuario) ON DELETE CASCADE,
    titulo VARCHAR(100) NOT NULL,
    descripcion TEXT,
    tipo_ticket VARCHAR(30),
    prioridad INTEGER CHECK (prioridad BETWEEN 1 AND 5),
    revisado BOOLEAN DEFAULT FALSE,
    fecha_creacion DATE DEFAULT CURRENT_DATE
);

CREATE TABLE Accion (
    id_accion SERIAL PRIMARY KEY,
    id_usuario INTEGER REFERENCES Usuario(id_usuario) ON DELETE SET NULL,
    tipo_accion VARCHAR(50),
    descripcion TEXT,
    fecha_accion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    direccion_ip VARCHAR(45)
);

-- =================================================================================
-- CREACIÓN DE ÍNDICES (INDEXES)
-- =================================================================================
-- Los índices mejoran drásticamente la velocidad de búsqueda en las consultas más comunes.

-- Índices para claves foráneas (Mejora los JOINs)
CREATE INDEX idx_usuario_rol ON Usuario(id_rol);
CREATE INDEX idx_estudiante_usuario ON Estudiante(id_usuario);
CREATE INDEX idx_empresa_usuario ON Empresa(id_usuario);
CREATE INDEX idx_pasantia_empresa ON Pasantia(id_empresa);
CREATE INDEX idx_postulacion_estudiante ON Postulacion(id_estudiante);
CREATE INDEX idx_postulacion_pasantia ON Postulacion(id_pasantia);
CREATE INDEX idx_accion_usuario ON Accion(id_usuario);

-- Índices para campos de búsqueda frecuente
CREATE INDEX idx_usuario_email ON Usuario(email);
CREATE INDEX idx_pasantia_activa ON Pasantia(activa);
CREATE INDEX idx_postulacion_estado ON Postulacion(estado);

-- =================================================================================
-- CREACIÓN DE FUNCIONES Y TRIGGERS (DISPARADORES)
-- =================================================================================

-- TRIGGER 1: Validación lógica en la tabla Pasantia
-- Asegura que la fecha de cierre de una pasantía no sea anterior a su publicación
CREATE OR REPLACE FUNCTION validar_fechas_pasantia()
RETURNS TRIGGER AS $$
BEGIN
    IF NEW.fecha_cierre < NEW.fecha_publicacion THEN
        RAISE EXCEPTION 'La fecha de cierre no puede ser anterior a la fecha de publicación';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trg_validar_fechas_pasantia
BEFORE INSERT OR UPDATE ON Pasantia
FOR EACH ROW
EXECUTE FUNCTION validar_fechas_pasantia();

-- TRIGGER 2: Auditoría/Seguridad en la tabla Usuario
-- Si un usuario supera los 3 intentos fallidos, desactiva automáticamente su cuenta
CREATE OR REPLACE FUNCTION bloquear_usuario_intentos()
RETURNS TRIGGER AS $$
BEGIN
    IF NEW.intentos_fallidos >= 3 THEN
        NEW.activo := FALSE;
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trg_bloquear_usuario_intentos
BEFORE UPDATE ON Usuario
FOR EACH ROW
WHEN (NEW.intentos_fallidos IS DISTINCT FROM OLD.intentos_fallidos)
EXECUTE FUNCTION bloquear_usuario_intentos();