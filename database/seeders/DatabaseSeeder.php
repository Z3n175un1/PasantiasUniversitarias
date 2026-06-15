<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(NuevasOfertasSeeder::class);
                DB::statement(<<<EOT
INSERT INTO "roles" ("id", "nombre", "descripcion") VALUES (1, 'estudiante', 'Estudiante universitario'),
(2, 'empresa', 'Empresa registrada'),
(3, 'administrador', 'Administrador del sistema');
EOT
                );
                DB::statement(<<<EOT
INSERT INTO "ubicaciones" ("id", "ciudad", "region", "pais", "codigo_pais") VALUES (1, 'La Paz', 'La Paz', 'Bolivia', 'BO'),
(2, 'El Alto', 'La Paz', 'Bolivia', 'BO'),
(3, 'Santa Cruz', 'Santa Cruz', 'Bolivia', 'BO'),
(4, 'Cochabamba', 'Cochabamba', 'Bolivia', 'BO'),
(5, 'Sucre', 'Chuquisaca', 'Bolivia', 'BO'),
(6, 'Tarija', 'Tarija', 'Bolivia', 'BO'),
(7, 'Oruro', 'Oruro', 'Bolivia', 'BO'),
(8, 'Potosí', 'Potosí', 'Bolivia', 'BO'),
(9, 'Trinidad', 'Beni', 'Bolivia', 'BO'),
(10, 'Cobija', 'Pando', 'Bolivia', 'BO'),
(11, 'Viacha', 'La Paz', 'Bolivia', 'BO'),
(12, 'Montero', 'Santa Cruz', 'Bolivia', 'BO'),
(13, 'Warnes', 'Santa Cruz', 'Bolivia', 'BO'),
(14, 'Quillacollo', 'Cochabamba', 'Bolivia', 'BO'),
(15, 'Yacuiba', 'Tarija', 'Bolivia', 'BO');
EOT
                );
                DB::statement(<<<EOT
INSERT INTO "tipos_documento" ("id", "nombre", "descripcion") VALUES (1, 'curriculum', 'Hoja de vida'),
(2, 'certificado', 'Certificado académico'),
(3, 'carta_presentacion', 'Carta laboral'),
(4, 'titulo', 'Título universitario'),
(5, 'otro', 'Otro documento'),
(6, 'pasaporte', 'Pasaporte'),
(7, 'cedula', 'Carnet de identidad'),
(8, 'portafolio', 'Portafolio'),
(9, 'licencia', 'Licencia'),
(10, 'recomendacion', 'Carta de recomendación'),
(11, 'idiomas', 'Certificado de idiomas'),
(12, 'proyecto', 'Proyecto universitario'),
(13, 'tesis', 'Tesis'),
(14, 'seminario', 'Seminario'),
(15, 'diploma', 'Diploma');
EOT
                );
                DB::statement(<<<EOT
INSERT INTO "estados_postulacion" ("id", "nombre", "descripcion", "es_terminal") VALUES (1, 'enviada', 'Postulación enviada', 0),
(2, 'revisada', 'Postulación revisada', 0),
(3, 'entrevista', 'Entrevista programada', 0),
(4, 'aceptada', 'Aceptada', 1),
(5, 'rechazada', 'Rechazada', 1);
EOT
                );
                DB::statement(<<<EOT
INSERT INTO "estados_publicacion" ("id", "nombre", "descripcion") VALUES (1, 'borrador', 'Oferta en edición'),
(2, 'abierta', 'Oferta activa'),
(3, 'cerrada', 'Oferta cerrada'),
(4, 'pausada', 'Oferta pausada'),
(5, 'finalizada', 'Proceso finalizado');
EOT
                );
                DB::statement(<<<EOT
INSERT INTO "habilidades" ("id", "nombre", "categoria", "descripcion", "activa") VALUES (1, 'Laravel', 'Backend', 'Framework PHP', 1),
(2, 'MySQL', 'Base de Datos', 'Gestión BD', 1),
(3, 'Python', 'Programación', 'Lenguaje Python', 1),
(4, 'Java', 'Programación', 'Lenguaje Java', 1),
(5, 'JavaScript', 'Frontend', 'JS Web', 1),
(6, 'React', 'Frontend', 'React JS', 1),
(7, 'Excel', 'Ofimática', 'Excel avanzado', 1),
(8, 'Power BI', 'Analítica', 'Dashboards', 1),
(9, 'Linux', 'Sistemas', 'Administración Linux', 1),
(10, 'Docker', 'DevOps', 'Contenedores', 1),
(11, 'Git', 'Versionado', 'GitHub', 1),
(12, 'Figma', 'Diseño', 'UX/UI', 1),
(13, 'Node.js', 'Backend', 'Node backend', 1),
(14, 'C#', 'Programación', '.NET', 1),
(15, 'Redes', 'Infraestructura', 'Networking', 1);
EOT
                );
                DB::statement("
                    INSERT INTO habilidades (nombre, categoria, descripcion, activa) VALUES
                    ('Anatomía', 'Salud', 'Anatomía humana', 1),
                    ('Fisiología', 'Salud', 'Fisiología humana', 1),
                    ('Farmacología', 'Salud', 'Farmacología clínica', 1),
                    ('Diagnóstico Clínico', 'Salud', 'Diagnóstico médico', 1),
                    ('Enfermería General', 'Salud', 'Cuidados de enfermería', 1),
                    ('Bioquímica Clínica', 'Salud', 'Análisis clínicos', 1),
                    ('Radiología', 'Salud', 'Diagnóstico por imágenes', 1),
                    ('Veterinaria', 'Salud', 'Medicina veterinaria', 1),
                    ('Nutrición Clínica', 'Salud', 'Nutrición y dietética', 1),
                    ('Odontología General', 'Salud', 'Atención odontológica', 1),
                    ('Fisioterapia', 'Salud', 'Rehabilitación física', 1),
                    ('Derecho Civil', 'Legal', 'Derecho civil boliviano', 1),
                    ('Derecho Penal', 'Legal', 'Derecho penal', 1),
                    ('Derecho Laboral', 'Legal', 'Legislación laboral', 1),
                    ('Derecho Corporativo', 'Legal', 'Asesoría legal empresarial', 1),
                    ('Redacción Jurídica', 'Legal', 'Documentos legales', 1),
                    ('Litigación Oral', 'Legal', 'Juicios orales', 1),
                    ('Derecho Tributario', 'Legal', 'Legislación tributaria', 1),
                    ('Relaciones Internacionales', 'Legal', 'Política y diplomacia', 1),
                    ('Psicología Clínica', 'Psicología', 'Evaluación y terapia', 1),
                    ('Psicología Educativa', 'Psicología', 'Orientación educativa', 1),
                    ('Psicología Organizacional', 'Psicología', 'Gestión del talento humano', 1),
                    ('Terapia Cognitivo-Conductual', 'Psicología', 'TCC', 1),
                    ('Psicometría', 'Psicología', 'Pruebas psicológicas', 1),
                    ('Gestión de Proyectos', 'Negocios', 'PMO y metodologías ágiles', 1),
                    ('Administración Financiera', 'Negocios', 'Finanzas corporativas', 1),
                    ('Contabilidad General', 'Negocios', 'Registros contables', 1),
                    ('Auditoría', 'Negocios', 'Auditoría financiera', 1),
                    ('Gestión de Recursos Humanos', 'Negocios', 'RRHH', 1),
                    ('Comercio Exterior', 'Negocios', 'Importaciones y exportaciones', 1),
                    ('Logística y Supply Chain', 'Negocios', 'Cadena de suministro', 1),
                    ('Marketing Digital', 'Negocios', 'Marketing online', 1),
                    ('Atención al Cliente', 'Negocios', 'Servicio al cliente', 1),
                    ('Ventas y Negociación', 'Negocios', 'Técnicas de venta', 1),
                    ('Microeconomía', 'Economía', 'Teoría microeconómica', 1),
                    ('Macroeconomía', 'Economía', 'Teoría macroeconómica', 1),
                    ('Econometría', 'Economía', 'Modelos econométricos', 1),
                    ('Banca y Finanzas', 'Economía', 'Sistema financiero', 1),
                    ('Análisis de Riesgos', 'Economía', 'Gestión de riesgos', 1),
                    ('Dibujo Técnico', 'Ingeniería', 'Planos y CAD', 1),
                    ('AutoCAD', 'Ingeniería', 'Diseño asistido', 1),
                    ('SolidWorks', 'Ingeniería', 'Diseño mecánico 3D', 1),
                    ('Cálculo Estructural', 'Ingeniería', 'Análisis estructural', 1),
                    ('Topografía', 'Ingeniería', 'Levantamientos topográficos', 1),
                    ('Hidráulica', 'Ingeniería', 'Sistemas hidráulicos', 1),
                    ('Electrotecnia', 'Ingeniería', 'Circuitos eléctricos', 1),
                    ('Termodinámica', 'Ingeniería', 'Procesos térmicos', 1),
                    ('Mecánica de Suelos', 'Ingeniería', 'Estudio de suelos', 1),
                    ('Control de Calidad', 'Ingeniería', 'Aseguramiento de calidad', 1),
                    ('Automatización Industrial', 'Ingeniería', 'PLC y SCADA', 1),
                    ('Energías Renovables', 'Ingeniería', 'Energía solar y eólica', 1),
                    ('Diseño Arquitectónico', 'Arquitectura', 'Planos arquitectónicos', 1),
                    ('Render 3D', 'Arquitectura', 'Visualización 3D', 1),
                    ('Revit', 'Arquitectura', 'BIM', 1),
                    ('Diseño de Interiores', 'Arquitectura', 'Decoración y espacios', 1),
                    ('Urbanismo', 'Arquitectura', 'Planificación urbana', 1),
                    ('Didáctica General', 'Educación', 'Métodos de enseñanza', 1),
                    ('Planificación Curricular', 'Educación', 'Diseño curricular', 1),
                    ('Evaluación Educativa', 'Educación', 'Evaluación del aprendizaje', 1),
                    ('Educación Inclusiva', 'Educación', 'Necesidades educativas especiales', 1),
                    ('Idiomas', 'Educación', 'Enseñanza de idiomas', 1),
                    ('Investigación Social', 'Sociales', 'Metodología de investigación', 1),
                    ('Trabajo Social', 'Sociales', 'Intervención social', 1),
                    ('Sociología Aplicada', 'Sociales', 'Análisis sociológico', 1),
                    ('Antropología Cultural', 'Sociales', 'Estudios culturales', 1),
                    ('Periodismo', 'Sociales', 'Redacción periodística', 1),
                    ('Fotografía', 'Sociales', 'Fotografía profesional', 1),
                    ('Gestión Hotelera', 'Turismo', 'Administración hotelera', 1),
                    ('Guía Turística', 'Turismo', 'Atención al turista', 1),
                    ('Planificación Turística', 'Turismo', 'Desarrollo turístico', 1),
                    ('Eventos y Protocolo', 'Turismo', 'Organización de eventos', 1),
                    ('Gastronomía Básica', 'Turismo', 'Cocina y alimentos', 1),
                    ('Suelos y Cultivos', 'Agronomía', 'Manejo de cultivos', 1),
                    ('Riego y Drenaje', 'Agronomía', 'Sistemas de riego', 1),
                    ('Gestión Ambiental', 'Agronomía', 'Evaluación de impacto ambiental', 1),
                    ('Biotecnología Vegetal', 'Agronomía', 'Mejoramiento genético', 1),
                    ('Zootecnia', 'Agronomía', 'Producción pecuaria', 1),
                    ('Teoría Musical', 'Arte', 'Lenguaje musical', 1),
                    ('Instrumento Musical', 'Arte', 'Ejecución instrumental', 1),
                    ('Producción Musical', 'Arte', 'Grabación y mezcla', 1),
                    ('Artes Plásticas', 'Arte', 'Pintura y escultura', 1),
                    ('Dibujo Artístico', 'Arte', 'Ilustración', 1),
                    ('Educación Física', 'Deportes', 'Entrenamiento deportivo', 1),
                    ('Fisiología del Ejercicio', 'Deportes', 'Ciencia del deporte', 1),
                    ('Nutrición Deportiva', 'Deportes', 'Alimentación deportiva', 1),
                    ('TypeScript', 'Frontend', 'TS tipado', 1),
                    ('Vue.js', 'Frontend', 'Framework Vue', 1),
                    ('Angular', 'Frontend', 'Framework Angular', 1),
                    ('Tailwind CSS', 'Frontend', 'CSS utility-first', 1),
                    ('Sass/SCSS', 'Frontend', 'Preprocesador CSS', 1),
                    ('Next.js', 'Frontend', 'React SSR', 1),
                    ('Go', 'Backend', 'Lenguaje Go', 1),
                    ('Rust', 'Backend', 'Lenguaje Rust', 1),
                    ('GraphQL', 'Backend', 'API GraphQL', 1),
                    ('MongoDB', 'Base de Datos', 'BD NoSQL', 1),
                    ('PostgreSQL', 'Base de Datos', 'BD relacional', 1),
                    ('Redis', 'Base de Datos', 'Caché en memoria', 1),
                    ('AWS', 'DevOps', 'Amazon Web Services', 1),
                    ('Azure', 'DevOps', 'Microsoft Azure', 1),
                    ('Kubernetes', 'DevOps', 'Orquestación de contenedores', 1),
                    ('CI/CD', 'DevOps', 'Integración y despliegue continuo', 1),
                    ('Terraform', 'DevOps', 'Infraestructura como código', 1),
                    ('Ciberseguridad', 'Seguridad', 'Seguridad informática', 1),
                    ('Ethical Hacking', 'Seguridad', 'Pruebas de penetración', 1),
                    ('SQL Injection', 'Seguridad', 'OWASP', 1),
                    ('Machine Learning', 'IA/Datos', 'Modelos de ML', 1),
                    ('Deep Learning', 'IA/Datos', 'Redes neuronales', 1),
                    ('NLP', 'IA/Datos', 'Procesamiento de lenguaje natural', 1),
                    ('Computer Vision', 'IA/Datos', 'Visión por computadora', 1),
                    ('Data Science', 'IA/Datos', 'Ciencia de datos', 1)
                ");
                DB::statement(<<<EOT
INSERT INTO "tipos_entidad" ("id", "nombre", "descripcion") VALUES (1, 'usuario', 'Entidad de usuario'),
(2, 'empresa', 'Entidad de empresa'),
(3, 'estudiante', 'Entidad de estudiante'),
(4, 'oferta', 'Entidad de oferta'),
(5, 'postulacion', 'Entidad de postulación'),
(6, 'login', 'Inicio de sesión'),
(7, 'logout', 'Cierre de sesión');
EOT
                );
                DB::statement(<<<'EOT'
INSERT INTO "usuarios" ("id", "rol_id", "nombre", "correo", "contrasena_hash", "activo", "creado_en") VALUES (1, 3, 'Admin', 'admin@pasantias.bo', '$2y$10$bIB2aOYC8hblin/.giln6O342AyvU6tj0YrXpU34jlC1KuNj8S44a', 1, '2026-05-21 22:10:23'),
(2, 3, 'Orlando Mercado', 'orlando@pasantias.bo', '$2y$10$bIB2aOYC8hblin/.giln6O342AyvU6tj0YrXpU34jlC1KuNj8S44a', 1, '2026-05-21 22:10:23'),
(3, 3, 'Adrian Molina', 'adrian@pasantias.bo', '$2y$10$bIB2aOYC8hblin/.giln6O342AyvU6tj0YrXpU34jlC1KuNj8S44a', 1, '2026-05-21 22:10:23'),
(4, 3, 'Fabricio Herrera', 'fabricio@pasantias.bo', '$2y$10$bIB2aOYC8hblin/.giln6O342AyvU6tj0YrXpU34jlC1KuNj8S44a', 1, '2026-05-21 22:10:23'),
(21, 3, 'Super Admin', 'prueba@edu.bo', '$2y$10$bIB2aOYC8hblin/.giln6O342AyvU6tj0YrXpU34jlC1KuNj8S44a', 1, '2026-05-21 22:10:23'),
(5, 1, 'Juan Pérez', 'juan@gmail.com', '$2y$10$bIB2aOYC8hblin/.giln6O342AyvU6tj0YrXpU34jlC1KuNj8S44a', 1, '2026-05-21 22:10:23'),
(6, 1, 'María Choque', 'maria@gmail.com', '$2y$10$bIB2aOYC8hblin/.giln6O342AyvU6tj0YrXpU34jlC1KuNj8S44a', 1, '2026-05-21 22:10:23'),
(7, 1, 'Carlos Mamani', 'carlos@gmail.com', '$2y$10$bIB2aOYC8hblin/.giln6O342AyvU6tj0YrXpU34jlC1KuNj8S44a', 1, '2026-05-21 22:10:23'),
(8, 1, 'Lucía Fernández', 'lucia@gmail.com', '$2y$10$bIB2aOYC8hblin/.giln6O342AyvU6tj0YrXpU34jlC1KuNj8S44a', 1, '2026-05-21 22:10:23'),
(9, 1, 'Diego Quispe', 'diego@gmail.com', '$2y$10$bIB2aOYC8hblin/.giln6O342AyvU6tj0YrXpU34jlC1KuNj8S44a', 1, '2026-05-21 22:10:23'),
(10, 1, 'Ana López', 'ana@gmail.com', '$2y$10$bIB2aOYC8hblin/.giln6O342AyvU6tj0YrXpU34jlC1KuNj8S44a', 1, '2026-05-21 22:10:23'),
(11, 1, 'Kevin Rocha', 'kevin@gmail.com', '$2y$10$bIB2aOYC8hblin/.giln6O342AyvU6tj0YrXpU34jlC1KuNj8S44a', 1, '2026-05-21 22:10:23'),
(12, 1, 'Paola Vargas', 'paola@gmail.com', '$2y$10$bIB2aOYC8hblin/.giln6O342AyvU6tj0YrXpU34jlC1KuNj8S44a', 1, '2026-05-21 22:10:23'),
(13, 1, 'Miguel Flores', 'miguel@gmail.com', '$2y$10$bIB2aOYC8hblin/.giln6O342AyvU6tj0YrXpU34jlC1KuNj8S44a', 1, '2026-05-21 22:10:23'),
(14, 1, 'Andrea Rojas', 'andrea@gmail.com', '$2y$10$bIB2aOYC8hblin/.giln6O342AyvU6tj0YrXpU34jlC1KuNj8S44a', 1, '2026-05-21 22:10:23'),
(15, 1, 'José Condori', 'jose@gmail.com', '$2y$10$bIB2aOYC8hblin/.giln6O342AyvU6tj0YrXpU34jlC1KuNj8S44a', 1, '2026-05-21 22:10:23'),
(16, 2, 'Jalasoft', 'rrhh@jalasoft.com', '$2y$10$bIB2aOYC8hblin/.giln6O342AyvU6tj0YrXpU34jlC1KuNj8S44a', 1, '2026-05-21 22:10:23'),
(17, 2, 'Tigo Bolivia', 'talento@tigo.com.bo', '$2y$10$bIB2aOYC8hblin/.giln6O342AyvU6tj0YrXpU34jlC1KuNj8S44a', 1, '2026-05-21 22:10:23'),
(18, 2, 'Banco Mercantil', 'rrhh@bm.com.bo', '$2y$10$bIB2aOYC8hblin/.giln6O342AyvU6tj0YrXpU34jlC1KuNj8S44a', 1, '2026-05-21 22:10:23'),
(19, 2, 'Datec', 'rrhh@datec.com.bo', '$2y$10$bIB2aOYC8hblin/.giln6O342AyvU6tj0YrXpU34jlC1KuNj8S44a', 1, '2026-05-21 22:10:23'),
(20, 2, 'Jatun Code', 'contacto@jatuncode.bo', '$2y$10$bIB2aOYC8hblin/.giln6O342AyvU6tj0YrXpU34jlC1KuNj8S44a', 1, '2026-05-21 22:10:23');
EOT
                );
                DB::statement(<<<EOT
INSERT INTO "perfiles_empresa" ("id", "usuario_id", "nombre_empresa", "industria", "sitio_web", "verificada") VALUES (1, 16, 'Jalasoft', 'Software', 'https://jalasoft.com', 1),
(2, 17, 'Tigo Bolivia', 'Telecomunicaciones', 'https://tigo.com.bo', 1),
(3, 18, 'Banco Mercantil', 'Finanzas', 'https://bm.com.bo', 1),
(4, 19, 'Datec', 'Tecnología', 'https://datec.com.bo', 1),
(5, 20, 'Jatun Code', 'Software', 'https://jatuncode.bo', 1);
EOT
                );
                DB::statement(<<<EOT
INSERT INTO "perfiles_estudiante" ("id", "usuario_id", "universidad", "carrera", "anio_graduacion", "biografia") VALUES (1, 5, 'UMSA', 'Ingeniería de Sistemas', '2026', 'Backend developer'),
(2, 6, 'UPB', 'Ingeniería Informática', '2025', 'IA y datos'),
(3, 7, 'UMSS', 'Ingeniería de Sistemas', '2026', 'Fullstack developer'),
(4, 8, 'UCB', 'Diseño Digital', '2025', 'UX/UI designer'),
(5, 9, 'EMI', 'Redes y Telecomunicaciones', '2027', 'Especialista en redes'),
(6, 10, 'UMSA', 'Ingeniería Comercial', '2025', 'Business analyst'),
(7, 11, 'UPDS', 'Ingeniería de Sistemas', '2026', 'Frontend developer'),
(8, 12, 'UPB', 'Marketing Digital', '2025', 'Marketing y BI'),
(9, 13, 'UMSS', 'Ingeniería Informática', '2026', 'Python developer'),
(10, 14, 'UCB', 'Diseño Gráfico', '2027', 'Diseño web'),
(11, 15, 'EMI', 'Ciberseguridad', '2026', 'Seguridad informática');
EOT
                );
                DB::statement(<<<EOT
INSERT INTO "ofertas_pasantia" ("id", "perfil_empresa_id", "ubicacion_id", "estado_publicacion_id", "titulo", "descripcion", "modalidad", "carrera", "requisitos", "beneficios", "vacantes_disponibles", "duracion_semanas", "fecha_inicio", "fecha_fin") VALUES (1, 1, 3, 2, 'Backend Laravel', 'Pasantía backend', 'Presencial', 'Ingeniería de Sistemas', 'Conocimientos en Laravel', 'Certificado', 1, 24, '2026-06-01', '2026-12-01'),
(2, 2, 3, 2, 'Frontend React', 'Frontend web', 'Presencial', 'Ingeniería Informática', 'Conocimientos en React', 'Certificado', 1, 22, '2026-06-01', '2026-11-01'),
(3, 3, 4, 2, 'Analista BI', 'Power BI y Excel', 'Presencial', 'Ingeniería Comercial', 'Excel avanzado', 'Certificado', 1, 26, '2026-07-01', '2026-12-30'),
(4, 4, 3, 1, 'Soporte TI', 'Infraestructura TI', 'Presencial', 'Ingeniería de Sistemas', 'Conocimientos en redes', 'Certificado', 1, 18, '2026-06-15', '2026-10-15'),
(5, 5, 3, 2, 'QA Tester', 'Control de calidad', 'Presencial', 'Ingeniería Informática', 'Pruebas de software', 'Certificado', 1, 18, '2026-08-01', '2026-12-01'),
(6, 1, 7, 2, 'DevOps Junior', 'Docker y Linux', 'Presencial', 'Ingeniería de Sistemas', 'Linux y Docker', 'Certificado', 1, 18, '2026-07-10', '2026-11-10'),
(7, 2, 3, 2, 'Data Analyst', 'Análisis de datos', 'Presencial', 'Estadística', 'Python y SQL', 'Certificado', 1, 26, '2026-06-20', '2026-12-20'),
(8, 3, 3, 2, 'Node.js Developer', 'Backend Node', 'Presencial', 'Ingeniería de Sistemas', 'Node.js', 'Certificado', 1, 18, '2026-06-01', '2026-10-01'),
(9, 4, 3, 2, 'UX/UI Designer', 'Figma y UX', 'Remoto', 'Diseño Digital', 'Figma', 'Certificado', 1, 22, '2026-07-01', '2026-12-01'),
(10, 5, 5, 2, 'Redes', 'Administración redes', 'Presencial', 'Redes y Telecomunicaciones', 'CCNA', 'Certificado', 1, 22, '2026-08-01', '2026-12-31'),
(11, 1, 3, 2, 'Java Developer', 'Spring Boot', 'Híbrido', 'Ingeniería de Sistemas', 'Java y Spring', 'Certificado', 1, 26, '2026-06-01', '2026-12-01'),
(12, 2, 4, 2, 'Cybersecurity Intern', 'Seguridad TI', 'Presencial', 'Ciberseguridad', 'Seguridad informática', 'Certificado', 1, 26, '2026-06-01', '2026-12-01'),
(13, 3, 3, 2, 'Cloud Assistant', 'AWS y Docker', 'Remoto', 'Ingeniería de Sistemas', 'AWS y Docker', 'Certificado', 1, 26, '2026-06-01', '2026-12-01'),
(14, 4, 3, 2, 'Marketing BI', 'Power BI', 'Presencial', 'Marketing', 'Power BI', 'Certificado', 1, 26, '2026-06-01', '2026-12-01'),
(15, 5, 7, 2, 'Fullstack Developer', 'Laravel y React', 'Presencial', 'Ingeniería Informática', 'Laravel y React', 'Certificado', 1, 26, '2026-06-01', '2026-12-01'),
(16, 2, 3, 2, 'Pasante Ingeniería de Redes y Telecomunicaciones', 'Buscamos un pasante apasionado por las telecomunicaciones para unirse al equipo de infraestructura de red de Tigo Bolivia. Apoyarás en la configuración, monitoreo y mantenimiento de la red de telecomunicaciones, así como en la implementación de nuevas tecnologías de conectividad.', 'Presencial', 'Ingeniería de Sistemas, Redes, Telecomunicaciones', 'Conocimientos básicos de redes TCP/IP, protocolos de enrutamiento, experiencia con equipos Cisco (deseable), disponibilidad presencial en Santa Cruz.', 'Certificado de pasantía, experiencia laboral en una de las telecomunicaciones más grandes de Bolivia, horario flexible, compensación económica.', 2, 16, '2026-08-01', '2026-11-30'),
(17, 2, 1, 2, 'Pasante Marketing Digital y Redes Sociales', 'Apoyarás al equipo de marketing digital en la creación de contenido, gestión de redes sociales, análisis de métricas y campañas publicitarias para la marca Tigo.', 'Presencial', 'Marketing, Publicidad, Comunicación Social', 'Conocimientos en redes sociales, herramientas de métricas (Meta Business Suite, Google Analytics), creatividad, manejo de Canva o Adobe Suite.', 'Certificado, experiencia en marketing digital, ambiente corporativo dinámico, capacitaciones internas.', 1, 12, '2026-08-15', '2026-11-15'),
(18, 2, 4, 2, 'Pasante Desarrollo Android Kotlin', 'Te unirás al equipo de desarrollo mobile para crear y mantener aplicaciones Android para los servicios digitales de Tigo Bolivia.', 'Híbrido', 'Ingeniería de Sistemas, Informática', 'Conocimientos en Kotlin o Java, experiencia con Android Studio, APIs REST, Git. Deseable: experiencia con Firebase.', 'Certificado, posibilidad de contratación, trabajo híbrido, beneficios corporativos, coaching con desarrolladores seniors.', 2, 24, '2026-09-01', '2027-02-28'),
(19, 2, 7, 2, 'Pasante Analista de Datos y BI', 'Apoyarás en la recolección, procesamiento y análisis de datos de clientes para generar insights que impulsen decisiones estratégicas en Tigo.', 'Presencial', 'Estadística, Ingeniería de Sistemas, Administración', 'Manejo de Excel avanzado, SQL, Power BI o Tableau. Conocimientos básicos de Python para análisis de datos.', 'Certificado, experiencia en análisis de datos reales con audiencias millonarias, mentoring con analistas senior.', 1, 16, '2026-09-01', '2026-12-31'),
(20, 2, 9, 2, 'Pasante Experiencia al Cliente y Calidad', 'Apoyarás en la gestión de calidad del servicio al cliente, análisis de encuestas de satisfacción NPS y propuestas de mejora continua para los canales de atención.', 'Presencial', 'Administración, Ingeniería Comercial, Psicología', 'Excelentes habilidades comunicativas, empatía, manejo de Excel, capacidad de análisis de datos, orientación al cliente.', 'Certificado, experiencia en atención al cliente corporativa, horario flexible, programa de formación.', 1, 12, '2026-08-01', '2026-10-31'),
(21, 3, 1, 2, 'Pasante Banca Digital e Innovación', 'Apoyarás en la transformación digital del banco, participando en proyectos de innovación, desarrollo de canales digitales y mejora de la experiencia de usuario.', 'Presencial', 'Ingeniería de Sistemas, Informática, Administración', 'Conocimientos en metodologías ágiles, UX/UI básico, análisis de procesos, herramientas ofimáticas.', 'Certificado, experiencia en el sector financiero, capacitaciones internas, compensación económica.', 2, 24, '2026-08-01', '2027-01-31'),
(22, 3, 3, 2, 'Pasante Análisis Financiero y Banca de Inversión', 'Apoyarás al equipo de finanzas en la preparación de reportes, análisis de estados financieros, proyecciones y evaluaciones de inversiones.', 'Presencial', 'Ingeniería Comercial, Contabilidad, Economía', 'Conocimientos en análisis financiero, Excel avanzado, capacidad analítica, responsabilidad y ética profesional.', 'Certificado, experiencia en banca, posibilidad de crecimiento, beneficios corporativos.', 1, 16, '2026-09-01', '2026-12-31'),
(23, 3, 4, 2, 'Pasante Gestión de Riesgos Financieros', 'Apoyarás en la identificación, evaluación y monitoreo de riesgos financieros y operativos del banco, así como en la elaboración de informes regulatorios.', 'Presencial', 'Economía, Ingeniería Comercial, Contabilidad', 'Conocimientos en gestión de riesgos, Excel avanzado, capacidad analítica, atención al detalle.', 'Certificado, experiencia en gestión de riesgos bancarios, capacitaciones especializadas.', 1, 16, '2026-08-15', '2026-12-15'),
(24, 3, 5, 2, 'Pasante Contabilidad y Auditoría Interna', 'Apoyarás en los procesos contables, conciliaciones, preparación de informes financieros y apoyo en auditorías internas del banco.', 'Presencial', 'Contabilidad, Auditoría', 'Conocimientos en contabilidad general, NIIF, manejo de sistemas contables, Excel intermedio-avanzado.', 'Certificado, experiencia en el área contable de un banco, horario flexible, programas de capacitación.', 1, 12, '2026-09-01', '2026-11-30'),
(25, 3, 6, 2, 'Pasante Cumplimiento y Prevención de Fraudes', 'Apoyarás al equipo de cumplimiento en la revisión de documentación, monitoreo de transacciones y prevención de lavado de dinero y fraudes financieros.', 'Presencial', 'Derecho, Contabilidad, Administración', 'Conocimientos básicos en prevención de lavado de activos (deseable), responsabilidad, discreción, capacidad analítica.', 'Certificado, experiencia en cumplimiento bancario, capacitaciones especializadas, posibilidad de crecimiento.', 1, 16, '2026-09-01', '2026-12-31'),
(26, 5, 1, 2, 'Pasante Laravel Backend Developer', 'Desarrollarás y mantendrás APIs RESTful, servicios backend y bases de datos para aplicaciones web de Jatun Code, trabajando con metodologías ágiles.', 'Presencial', 'Ingeniería de Sistemas, Informática', 'Conocimientos en Laravel, PHP, MySQL, Git, APIs REST. Deseable: pruebas unitarias con PHPUnit, Docker.', 'Certificado, experiencia laboral real en proyectos de software, mentoring, posibilidad de contratación, horario flexible.', 2, 20, '2026-08-01', '2026-12-31'),
(27, 5, 3, 2, 'Pasante Vue.js Frontend Developer', 'Desarrollarás interfaces de usuario modernas y responsivas utilizando Vue.js y Tailwind CSS para los proyectos web de Jatun Code.', 'Híbrido', 'Ingeniería de Sistemas, Informática, Diseño Digital', 'Conocimientos en Vue.js, JavaScript/TypeScript, HTML/CSS, Tailwind CSS, Git. Deseable: experiencia con Nuxt.js o Pinia.', 'Certificado, trabajo en equipo ágil, posibilidad de remoto parcial, compensación económica, desarrollo profesional.', 2, 20, '2026-08-15', '2026-12-31'),
(28, 5, 4, 2, 'Pasante Flutter Mobile Developer', 'Desarrollarás aplicaciones móviles multiplataforma con Flutter y Dart para los productos digitales de Jatun Code.', 'Presencial', 'Ingeniería de Sistemas, Informática', 'Conocimientos en Flutter, Dart, APIs REST, Git. Deseable: experiencia con Firebase, publicaciones en Play Store.', 'Certificado, experiencia en desarrollo mobile real, mentoring con desarrolladores seniors, posibilidad de contratación.', 1, 20, '2026-09-01', '2027-01-31'),
(29, 5, 5, 2, 'Pasante UI/UX Design', 'Diseñarás interfaces de usuario atractivas e intuitivas para aplicaciones web y móviles, realizando investigación de usuarios, prototipado y pruebas de usabilidad.', 'Híbrido', 'Diseño Digital, Diseño Gráfico, Ingeniería de Sistemas', 'Conocimientos en Figma, diseño de interfaces, prototipado interactivo, principios de UX. Deseable: portfolio con proyectos.', 'Certificado, trabajo en equipo multidisciplinario, portfolio profesional, horario flexible, herramientas de diseño licenciadas.', 1, 16, '2026-08-01', '2026-11-30'),
(30, 5, 6, 2, 'Pasante DevOps y Cloud Infrastructure', 'Apoyarás en la implementación de infraestructura como código, automatización de despliegues y gestión de servicios en la nube.', 'Remoto', 'Ingeniería de Sistemas, Informática', 'Conocimientos en Linux, Docker, Git, CI/CD. Deseable: AWS, Kubernetes, Terraform.', 'Certificado, experiencia en cloud computing, trabajo 100% remoto, herramientas de última generación, horario flexible.', 1, 16, '2026-09-01', '2026-12-31');
EOT
                );

                DB::statement(<<<EOT
INSERT INTO "requisitos_habilidad_oferta" ("oferta_pasantia_id", "habilidad_id", "peso", "nivel_minimo", "tipo_criterio") VALUES
-- JALASOFT: Oferta 1 - Backend Laravel
(1, 1, 30, 3, 'benefit'), (1, 2, 20, 2, 'benefit'), (1, 11, 20, 2, 'benefit'), (1, 5, 15, 2, 'benefit'), (1, 10, 15, 2, 'benefit'),
-- TIGO: Oferta 2 - Frontend React
(2, 5, 30, 3, 'benefit'), (2, 6, 25, 2, 'benefit'), (2, 101, 15, 2, 'benefit'), (2, 104, 15, 2, 'benefit'), (2, 11, 15, 2, 'benefit'),
-- BANCO MERCANTIL: Oferta 3 - Analista BI
(3, 7, 30, 3, 'benefit'), (3, 8, 25, 2, 'benefit'), (3, 111, 20, 2, 'benefit'), (3, 3, 15, 2, 'benefit'), (3, 125, 10, 1, 'benefit'),
-- DATEC: Oferta 4 - Soporte TI
(4, 9, 30, 3, 'benefit'), (4, 15, 25, 2, 'benefit'), (4, 2, 20, 2, 'benefit'), (4, 48, 15, 2, 'benefit'), (4, 113, 10, 1, 'benefit'),
-- JATUN CODE: Oferta 5 - QA Tester
(5, 5, 25, 2, 'benefit'), (5, 11, 20, 2, 'benefit'), (5, 10, 20, 2, 'benefit'), (5, 116, 20, 2, 'benefit'), (5, 64, 15, 1, 'benefit'),
-- JALASOFT: Oferta 6 - DevOps Junior
(6, 10, 30, 3, 'benefit'), (6, 9, 25, 2, 'benefit'), (6, 11, 20, 2, 'benefit'), (6, 113, 15, 2, 'benefit'), (6, 116, 10, 1, 'benefit'),
-- TIGO: Oferta 7 - Data Analyst
(7, 3, 25, 2, 'benefit'), (7, 111, 25, 2, 'benefit'), (7, 7, 20, 2, 'benefit'), (7, 8, 15, 2, 'benefit'), (7, 125, 15, 2, 'benefit'),
-- BANCO MERCANTIL: Oferta 8 - Node.js Developer
(8, 13, 30, 3, 'benefit'), (8, 5, 20, 2, 'benefit'), (8, 2, 20, 2, 'benefit'), (8, 11, 15, 2, 'benefit'), (8, 110, 15, 2, 'benefit'),
-- DATEC: Oferta 9 - UX/UI Designer
(9, 12, 35, 3, 'benefit'), (9, 5, 20, 2, 'benefit'), (9, 104, 15, 2, 'benefit'), (9, 105, 15, 2, 'benefit'), (9, 106, 15, 2, 'benefit'),
-- JATUN CODE: Oferta 10 - Redes
(10, 15, 30, 3, 'benefit'), (10, 9, 20, 2, 'benefit'), (10, 118, 20, 2, 'benefit'), (10, 11, 15, 2, 'benefit'), (10, 113, 15, 2, 'benefit'),
-- JALASOFT: Oferta 11 - Java Developer
(11, 4, 30, 3, 'benefit'), (11, 40, 20, 2, 'benefit'), (11, 110, 20, 2, 'benefit'), (11, 11, 15, 2, 'benefit'), (11, 2, 15, 2, 'benefit'),
-- TIGO: Oferta 12 - Cybersecurity Intern
(12, 118, 30, 3, 'benefit'), (12, 119, 25, 2, 'benefit'), (12, 9, 20, 2, 'benefit'), (12, 15, 15, 2, 'benefit'), (12, 120, 10, 1, 'benefit'),
-- BANCO MERCANTIL: Oferta 13 - Cloud Assistant
(13, 113, 30, 3, 'benefit'), (13, 10, 25, 2, 'benefit'), (13, 9, 20, 2, 'benefit'), (13, 11, 15, 2, 'benefit'), (13, 116, 10, 1, 'benefit'),
-- DATEC: Oferta 14 - Marketing BI
(14, 8, 30, 3, 'benefit'), (14, 7, 25, 2, 'benefit'), (14, 47, 20, 2, 'benefit'), (14, 48, 15, 2, 'benefit'), (14, 125, 10, 1, 'benefit'),
-- JATUN CODE: Oferta 15 - Fullstack Developer
(15, 1, 25, 3, 'benefit'), (15, 6, 25, 2, 'benefit'), (15, 2, 20, 2, 'benefit'), (15, 5, 15, 2, 'benefit'), (15, 11, 15, 2, 'benefit'),
-- TIGO BOLIVIA: Oferta 16 - Redes
(16, 15, 35, 3, 'benefit'),
(16, 9, 20, 2, 'benefit'),
(16, 118, 20, 2, 'benefit'),
(16, 11, 15, 2, 'benefit'),
(16, 113, 10, 1, 'benefit'),
-- TIGO BOLIVIA: Oferta 17 - Marketing Digital
(17, 47, 35, 3, 'benefit'),
(17, 7, 20, 2, 'benefit'),
(17, 48, 20, 2, 'benefit'),
(17, 49, 15, 2, 'benefit'),
(17, 12, 10, 1, 'benefit'),
-- TIGO BOLIVIA: Oferta 18 - Android
(18, 4, 30, 3, 'benefit'),
(18, 11, 20, 2, 'benefit'),
(18, 5, 20, 2, 'benefit'),
(18, 13, 15, 2, 'benefit'),
(18, 110, 15, 1, 'benefit'),
-- TIGO BOLIVIA: Oferta 19 - Datos
(19, 7, 25, 3, 'benefit'),
(19, 8, 25, 2, 'benefit'),
(19, 3, 20, 2, 'benefit'),
(19, 111, 15, 2, 'benefit'),
(19, 125, 15, 1, 'benefit'),
-- TIGO BOLIVIA: Oferta 20 - Cliente
(20, 48, 30, 3, 'benefit'),
(20, 7, 25, 2, 'benefit'),
(20, 49, 20, 2, 'benefit'),
(20, 44, 15, 2, 'benefit'),
(20, 46, 10, 1, 'benefit'),
-- BANCO MERCANTIL: Oferta 21 - Banca Digital
(21, 40, 25, 2, 'benefit'),
(21, 5, 20, 2, 'benefit'),
(21, 12, 20, 2, 'benefit'),
(21, 41, 20, 2, 'benefit'),
(21, 111, 15, 1, 'benefit'),
-- BANCO MERCANTIL: Oferta 22 - Análisis Financiero
(22, 7, 25, 3, 'benefit'),
(22, 41, 25, 3, 'benefit'),
(22, 53, 20, 2, 'benefit'),
(22, 8, 15, 2, 'benefit'),
(22, 42, 15, 2, 'benefit'),
-- BANCO MERCANTIL: Oferta 23 - Riesgos
(23, 54, 30, 2, 'benefit'),
(23, 7, 25, 3, 'benefit'),
(23, 41, 20, 2, 'benefit'),
(23, 53, 15, 2, 'benefit'),
(23, 43, 10, 1, 'benefit'),
-- BANCO MERCANTIL: Oferta 24 - Contabilidad
(24, 42, 30, 3, 'benefit'),
(24, 7, 25, 3, 'benefit'),
(24, 43, 20, 2, 'benefit'),
(24, 41, 15, 2, 'benefit'),
(24, 53, 10, 1, 'benefit'),
-- BANCO MERCANTIL: Oferta 25 - Cumplimiento
(25, 30, 30, 2, 'benefit'),
(25, 31, 20, 2, 'benefit'),
(25, 7, 20, 2, 'benefit'),
(25, 33, 15, 2, 'benefit'),
(25, 43, 15, 1, 'benefit'),
-- JATUN CODE: Oferta 26 - Laravel
(26, 1, 30, 3, 'benefit'),
(26, 111, 20, 2, 'benefit'),
(26, 11, 15, 2, 'benefit'),
(26, 10, 15, 2, 'benefit'),
(26, 109, 10, 1, 'benefit'),
(26, 2, 10, 2, 'benefit'),
-- JATUN CODE: Oferta 27 - Vue.js
(27, 102, 30, 3, 'benefit'),
(27, 5, 20, 3, 'benefit'),
(27, 101, 15, 2, 'benefit'),
(27, 104, 15, 2, 'benefit'),
(27, 11, 10, 2, 'benefit'),
(27, 105, 10, 1, 'benefit'),
-- JATUN CODE: Oferta 28 - Flutter
(28, 5, 25, 2, 'benefit'),
(28, 13, 20, 2, 'benefit'),
(28, 11, 20, 2, 'benefit'),
(28, 12, 15, 2, 'benefit'),
(28, 110, 10, 1, 'benefit'),
(28, 111, 10, 1, 'benefit'),
-- JATUN CODE: Oferta 29 - UI/UX
(29, 12, 35, 3, 'benefit'),
(29, 5, 20, 2, 'benefit'),
(29, 104, 15, 2, 'benefit'),
(29, 105, 15, 2, 'benefit'),
(29, 106, 15, 1, 'benefit'),
-- JATUN CODE: Oferta 30 - DevOps
(30, 10, 25, 3, 'benefit'),
(30, 9, 20, 3, 'benefit'),
(30, 11, 15, 2, 'benefit'),
(30, 113, 15, 2, 'benefit'),
(30, 116, 15, 2, 'benefit'),
(30, 115, 10, 1, 'benefit');
EOT
                );


        }
}
