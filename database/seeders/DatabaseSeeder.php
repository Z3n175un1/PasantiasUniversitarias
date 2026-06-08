<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
        public function run(): void
        {
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
INSERT INTO "ofertas_pasantia" ("id", "perfil_empresa_id", "ubicacion_id", "estado_publicacion_id", "titulo", "descripcion", "fecha_inicio", "fecha_fin") VALUES (1, 1, 1, 2, 'Backend Laravel', 'Pasantía backend', '2026-06-01', '2026-12-01'),
(2, 2, 3, 2, 'Frontend React', 'Frontend web', '2026-06-01', '2026-11-01'),
(3, 3, 4, 2, 'Analista BI', 'Power BI y Excel', '2026-07-01', '2026-12-30'),
(4, 4, 2, 1, 'Soporte TI', 'Infraestructura TI', '2026-06-15', '2026-10-15'),
(5, 5, 5, 2, 'QA Tester', 'Control de calidad', '2026-08-01', '2026-12-01'),
(6, 1, 6, 2, 'DevOps Junior', 'Docker y Linux', '2026-07-10', '2026-11-10'),
(7, 2, 7, 2, 'Data Analyst', 'Análisis de datos', '2026-06-20', '2026-12-20'),
(8, 3, 8, 2, 'Node.js Developer', 'Backend Node', '2026-06-01', '2026-10-01'),
(9, 4, 9, 2, 'UX/UI Designer', 'Figma y UX', '2026-07-01', '2026-12-01'),
(10, 5, 10, 2, 'Redes', 'Administración redes', '2026-08-01', '2026-12-31'),
(11, 1, 11, 2, 'Java Developer', 'Spring Boot', '2026-06-01', '2026-12-01'),
(12, 2, 12, 2, 'Cybersecurity Intern', 'Seguridad TI', '2026-06-01', '2026-12-01'),
(13, 3, 13, 2, 'Cloud Assistant', 'AWS y Docker', '2026-06-01', '2026-12-01'),
(14, 4, 14, 2, 'Marketing BI', 'Power BI', '2026-06-01', '2026-12-01'),
(15, 5, 15, 2, 'Fullstack Developer', 'Laravel y React', '2026-06-01', '2026-12-01');
EOT
                );


        }
}
