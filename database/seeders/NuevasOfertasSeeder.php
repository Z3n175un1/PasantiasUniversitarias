<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NuevasOfertasSeeder extends Seeder
{
    public function run(): void
    {
        // Desactivar el modo de prepared statement emulado para Supabase/PgBouncer
        // Usamos DB::statement con SQL directo

        // Actualizar ofertas existentes (1-15) con los nuevos campos
        DB::statement("UPDATE \"ofertas_pasantia\" SET \"modalidad\" = 'Presencial', \"beneficios\" = 'Certificado, experiencia laboral, horario flexible', \"vacantes_disponibles\" = 1");
        DB::statement("UPDATE \"ofertas_pasantia\" SET \"carrera\" = 'Ingeniería de Sistemas', \"requisitos\" = 'Conocimientos en Laravel, PHP, MySQL, Git', \"duracion_semanas\" = 26 WHERE \"id\" = 1");
        DB::statement("UPDATE \"ofertas_pasantia\" SET \"carrera\" = 'Ingeniería Informática', \"requisitos\" = 'Conocimientos en React, JavaScript, HTML, CSS', \"duracion_semanas\" = 22 WHERE \"id\" = 2");
        DB::statement("UPDATE \"ofertas_pasantia\" SET \"carrera\" = 'Ingeniería Comercial', \"requisitos\" = 'Excel avanzado, Power BI, análisis de datos', \"duracion_semanas\" = 26 WHERE \"id\" = 3");
        DB::statement("UPDATE \"ofertas_pasantia\" SET \"carrera\" = 'Ingeniería de Sistemas', \"requisitos\" = 'Soporte técnico, redes, hardware', \"duracion_semanas\" = 18 WHERE \"id\" = 4");
        DB::statement("UPDATE \"ofertas_pasantia\" SET \"carrera\" = 'Ingeniería Informática', \"requisitos\" = 'Pruebas de software, metodologías ágiles', \"duracion_semanas\" = 18 WHERE \"id\" = 5");
        DB::statement("UPDATE \"ofertas_pasantia\" SET \"carrera\" = 'Ingeniería de Sistemas', \"requisitos\" = 'Linux, Docker, CI/CD, Git', \"duracion_semanas\" = 18 WHERE \"id\" = 6");
        DB::statement("UPDATE \"ofertas_pasantia\" SET \"carrera\" = 'Estadística', \"requisitos\" = 'Python, SQL, Power BI, estadística', \"duracion_semanas\" = 26 WHERE \"id\" = 7");
        DB::statement("UPDATE \"ofertas_pasantia\" SET \"carrera\" = 'Ingeniería de Sistemas', \"requisitos\" = 'Node.js, Express, MongoDB, APIs REST', \"duracion_semanas\" = 18 WHERE \"id\" = 8");
        DB::statement("UPDATE \"ofertas_pasantia\" SET \"modalidad\" = 'Remoto', \"carrera\" = 'Diseño Digital', \"requisitos\" = 'Figma, diseño UX/UI, prototipado', \"duracion_semanas\" = 22 WHERE \"id\" = 9");
        DB::statement("UPDATE \"ofertas_pasantia\" SET \"carrera\" = 'Redes y Telecomunicaciones', \"requisitos\" = 'Redes TCP/IP, CCNA, equipos Cisco', \"duracion_semanas\" = 22 WHERE \"id\" = 10");
        DB::statement("UPDATE \"ofertas_pasantia\" SET \"modalidad\" = 'Híbrido', \"carrera\" = 'Ingeniería de Sistemas', \"requisitos\" = 'Java, Spring Boot, JPA, APIs REST', \"duracion_semanas\" = 26 WHERE \"id\" = 11");
        DB::statement("UPDATE \"ofertas_pasantia\" SET \"carrera\" = 'Ciberseguridad', \"requisitos\" = 'Seguridad informática, ethical hacking', \"duracion_semanas\" = 26 WHERE \"id\" = 12");
        DB::statement("UPDATE \"ofertas_pasantia\" SET \"modalidad\" = 'Remoto', \"carrera\" = 'Ingeniería de Sistemas', \"requisitos\" = 'AWS, Docker, Linux, Terraform', \"duracion_semanas\" = 26 WHERE \"id\" = 13");
        DB::statement("UPDATE \"ofertas_pasantia\" SET \"carrera\" = 'Marketing', \"requisitos\" = 'Power BI, Excel, marketing digital', \"duracion_semanas\" = 26 WHERE \"id\" = 14");
        DB::statement("UPDATE \"ofertas_pasantia\" SET \"carrera\" = 'Ingeniería Informática', \"requisitos\" = 'Laravel, React, PHP, JavaScript, Git', \"duracion_semanas\" = 26 WHERE \"id\" = 15");

        $ofertas_sql = [];
        $ofertas_sql[] = <<<EOT
INSERT INTO "ofertas_pasantia" ("id", "perfil_empresa_id", "ubicacion_id", "estado_publicacion_id", "titulo", "descripcion", "modalidad", "carrera", "requisitos", "beneficios", "vacantes_disponibles", "duracion_semanas", "fecha_inicio", "fecha_fin") VALUES
(16, 2, 3, 2, 'Pasante Ingeniería de Redes y Telecomunicaciones', 'Buscamos un pasante apasionado por las telecomunicaciones para unirse al equipo de infraestructura de red de Tigo Bolivia.', 'Presencial', 'Ingeniería de Sistemas, Redes, Telecomunicaciones', 'Conocimientos básicos de redes TCP/IP, protocolos de enrutamiento, Cisco.', 'Certificado, experiencia laboral, horario flexible, compensación económica.', 2, 16, '2026-08-01'::date, '2026-11-30'::date),
(17, 2, 1, 2, 'Pasante Marketing Digital y Redes Sociales', 'Apoyarás al equipo de marketing digital en la creación de contenido, gestión de redes sociales y campañas publicitarias.', 'Presencial', 'Marketing, Publicidad, Comunicación Social', 'Conocimientos en redes sociales, herramientas de métricas, creatividad.', 'Certificado, experiencia en marketing digital, capacitaciones internas.', 1, 12, '2026-08-15'::date, '2026-11-15'::date),
(18, 2, 4, 2, 'Pasante Desarrollo Android Kotlin', 'Te unirás al equipo de desarrollo mobile para crear y mantener aplicaciones Android.', 'Híbrido', 'Ingeniería de Sistemas, Informática', 'Kotlin o Java, Android Studio, APIs REST, Git.', 'Certificado, posibilidad de contratación, trabajo híbrido.', 2, 24, '2026-09-01'::date, '2027-02-28'::date),
(19, 2, 2, 2, 'Pasante Analista de Datos y BI', 'Apoyarás en la recolección, procesamiento y análisis de datos de clientes.', 'Presencial', 'Estadística, Ingeniería de Sistemas, Administración', 'Excel avanzado, SQL, Power BI, Python.', 'Certificado, experiencia en análisis de datos reales.', 1, 16, '2026-09-01'::date, '2026-12-31'::date),
(20, 2, 9, 2, 'Pasante Experiencia al Cliente y Calidad', 'Apoyarás en la gestión de calidad del servicio al cliente y análisis NPS.', 'Presencial', 'Administración, Ingeniería Comercial, Psicología', 'Habilidades comunicativas, empatía, Excel.', 'Certificado, experiencia en atención al cliente corporativa.', 1, 12, '2026-08-01'::date, '2026-10-31'::date),
(21, 3, 1, 2, 'Pasante Banca Digital e Innovación', 'Apoyarás en la transformación digital del banco y canales digitales.', 'Presencial', 'Ingeniería de Sistemas, Informática, Administración', 'Metodologías ágiles, UX/UI básico, análisis de procesos.', 'Certificado, experiencia en sector financiero, compensación económica.', 2, 24, '2026-08-01'::date, '2027-01-31'::date),
(22, 3, 3, 2, 'Pasante Análisis Financiero y Banca de Inversión', 'Apoyarás en reportes, análisis de estados financieros y proyecciones.', 'Presencial', 'Ingeniería Comercial, Contabilidad, Economía', 'Análisis financiero, Excel avanzado, ética profesional.', 'Certificado, experiencia en banca, beneficios corporativos.', 1, 16, '2026-09-01'::date, '2026-12-31'::date),
(23, 3, 4, 2, 'Pasante Gestión de Riesgos Financieros', 'Apoyarás en identificación, evaluación y monitoreo de riesgos bancarios.', 'Presencial', 'Economía, Ingeniería Comercial, Contabilidad', 'Gestión de riesgos, Excel avanzado, capacidad analítica.', 'Certificado, experiencia en riesgos bancarios.', 1, 16, '2026-08-15'::date, '2026-12-15'::date),
(24, 3, 5, 2, 'Pasante Contabilidad y Auditoría Interna', 'Apoyarás en procesos contables, conciliaciones y auditorías internas.', 'Presencial', 'Contabilidad, Auditoría', 'Contabilidad general, NIIF, Excel avanzado.', 'Certificado, experiencia contable bancaria, capacitaciones.', 1, 12, '2026-09-01'::date, '2026-11-30'::date),
(25, 3, 6, 2, 'Pasante Cumplimiento y Prevención de Fraudes', 'Apoyarás en prevención de lavado de dinero y cumplimiento normativo.', 'Presencial', 'Derecho, Contabilidad, Administración', 'Prevención de lavado de activos, discreción, capacidad analítica.', 'Certificado, experiencia en cumplimiento bancario.', 1, 16, '2026-09-01'::date, '2026-12-31'::date),
(26, 5, 1, 2, 'Pasante Laravel Backend Developer', 'Desarrollarás APIs RESTful y servicios backend para aplicaciones web.', 'Presencial', 'Ingeniería de Sistemas, Informática', 'Laravel, PHP, MySQL, Git, APIs REST.', 'Certificado, mentoring, posibilidad de contratación.', 2, 20, '2026-08-01'::date, '2026-12-31'::date),
(27, 5, 3, 2, 'Pasante Vue.js Frontend Developer', 'Desarrollarás interfaces modernas con Vue.js y Tailwind CSS.', 'Híbrido', 'Ingeniería de Sistemas, Informática, Diseño Digital', 'Vue.js, JavaScript/TypeScript, HTML/CSS, Tailwind, Git.', 'Certificado, trabajo ágil, compensación económica.', 2, 20, '2026-08-15'::date, '2026-12-31'::date),
(28, 5, 4, 2, 'Pasante Flutter Mobile Developer', 'Desarrollarás apps multiplataforma con Flutter y Dart.', 'Presencial', 'Ingeniería de Sistemas, Informática', 'Flutter, Dart, APIs REST, Git.', 'Certificado, mentoring, posibilidad de contratación.', 1, 20, '2026-09-01'::date, '2027-01-31'::date),
(29, 5, 5, 2, 'Pasante UI/UX Design', 'Diseñarás interfaces atractivas con investigación de usuarios y prototipado.', 'Híbrido', 'Diseño Digital, Diseño Gráfico, Ingeniería de Sistemas', 'Figma, diseño de interfaces, prototipado, UX.', 'Certificado, portfolio profesional, herramientas licenciadas.', 1, 16, '2026-08-01'::date, '2026-11-30'::date),
(30, 5, 6, 2, 'Pasante DevOps y Cloud Infrastructure', 'Apoyarás en infraestructura como código y automatización de despliegues.', 'Remoto', 'Ingeniería de Sistemas, Informática', 'Linux, Docker, Git, CI/CD.', 'Certificado, experiencia en cloud, trabajo remoto.', 1, 16, '2026-09-01'::date, '2026-12-31'::date)
ON CONFLICT (id) DO NOTHING;
EOT;
        $ofertas_sql[] = <<<EOT
INSERT INTO "ofertas_pasantia" ("id", "perfil_empresa_id", "ubicacion_id", "estado_publicacion_id", "titulo", "descripcion", "modalidad", "carrera", "requisitos", "beneficios", "vacantes_disponibles", "duracion_semanas", "fecha_inicio", "fecha_fin") VALUES
(31, 2, 1, 2, 'Pasante Administración de Empresas', 'Apoyarás en la gestión administrativa y planificación estratégica.', 'Presencial', 'Administración de Empresas, Ingeniería Comercial', 'Administración, Excel, capacidad de análisis.', 'Certificado, formación continua, horario flexible.', 2, 16, '2026-08-01'::date, '2026-11-30'::date),
(32, 2, 3, 2, 'Pasante Ingeniería Civil (Infraestructura de Torres)', 'Apoyarás en supervisión y planificación de infraestructura de telecomunicaciones.', 'Presencial', 'Ingeniería Civil', 'AutoCAD, cálculo estructural, topografía.', 'Certificado, proyectos de infraestructura real.', 1, 20, '2026-09-01'::date, '2027-01-31'::date),
(33, 2, 1, 2, 'Pasante Derecho Corporativo y Regulatorio', 'Apoyarás al equipo legal en contratos y normativa de telecomunicaciones.', 'Presencial', 'Derecho', 'Derecho corporativo, redacción jurídica.', 'Certificado, mentoría con abogados seniors.', 1, 20, '2026-08-01'::date, '2026-12-31'::date),
(34, 2, 4, 2, 'Pasante Contabilidad Corporativa', 'Apoyarás en procesos contables y estados financieros.', 'Presencial', 'Contabilidad, Auditoría', 'Contabilidad general, NIIF, Excel avanzado.', 'Certificado, capacitaciones internas.', 2, 16, '2026-08-15'::date, '2026-12-15'::date),
(35, 2, 1, 2, 'Pasante Psicología Organizacional', 'Apoyarás en selección, evaluación de desempeño y clima laboral.', 'Presencial', 'Psicología', 'Psicología organizacional, pruebas psicométricas.', 'Certificado, experiencia en RRHH corporativo.', 1, 16, '2026-09-01'::date, '2026-12-31'::date),
(36, 2, 3, 2, 'Pasante Ingeniería Industrial (Operaciones)', 'Apoyarás en optimización de procesos y mejora continua.', 'Presencial', 'Ingeniería Industrial', 'Lean Manufacturing, Six Sigma, Excel.', 'Certificado, mentoría, posibilidad de contratación.', 1, 20, '2026-08-01'::date, '2026-12-31'::date),
(37, 2, 1, 2, 'Pasante Comunicación Corporativa', 'Apoyarás en comunicación interna, RRPP y redacción de comunicados.', 'Presencial', 'Comunicación Social, Periodismo', 'Redacción, redes sociales corporativas, creatividad.', 'Certificado, networking, capacitaciones.', 1, 16, '2026-08-01'::date, '2026-11-30'::date),
(38, 2, 4, 2, 'Pasante Arquitectura (Diseño de Espacios)', 'Apoyarás en diseño de proyectos arquitectónicos para tiendas y oficinas.', 'Presencial', 'Arquitectura', 'Revit, AutoCAD, diseño arquitectónico, render 3D.', 'Certificado, proyectos arquitectónicos reales.', 1, 20, '2026-09-01'::date, '2027-01-31'::date),
(39, 2, 3, 2, 'Pasante Logística y Cadena de Suministro', 'Apoyarás en gestión de inventarios y distribución.', 'Presencial', 'Logística, Ingeniería Industrial, Administración', 'Cadena de suministro, inventarios, Excel, SAP.', 'Certificado, mentoría, posibilidad de contratación.', 2, 16, '2026-08-15'::date, '2026-12-15'::date),
(40, 2, 1, 2, 'Pasante Gestión del Talento Humano', 'Apoyarás en reclutamiento, selección y desarrollo organizacional.', 'Presencial', 'Psicología, Administración, Ingeniería Comercial', 'RRHH, reclutamiento, Excel.', 'Certificado, experiencia integral en RRHH.', 2, 16, '2026-09-01'::date, '2026-12-31'::date),
(41, 2, 2, 2, 'Pasante Ingeniería Eléctrica (Energía)', 'Apoyarás en diseño y mantenimiento de sistemas de energía.', 'Presencial', 'Ingeniería Eléctrica, Electrotecnia', 'Circuitos eléctricos, sistemas de energía, AutoCAD.', 'Certificado, trabajo de campo supervisado.', 1, 20, '2026-08-01'::date, '2026-12-31'::date),
(42, 2, 6, 2, 'Pasante Turismo y Eventos Corporativos', 'Apoyarás en organización de eventos y logística corporativa.', 'Presencial', 'Turismo, Administración Hotelera', 'Organización, atención al cliente, inglés.', 'Certificado, networking con ejecutivos.', 1, 12, '2026-08-01'::date, '2026-10-31'::date),
(43, 2, 7, 2, 'Pasante Trabajo Social y Responsabilidad Social', 'Apoyarás en programas de RSE y proyectos comunitarios.', 'Presencial', 'Trabajo Social, Sociología', 'Intervención social, investigación social.', 'Certificado, impacto social real.', 1, 16, '2026-08-01'::date, '2026-11-30'::date),
(44, 2, 3, 2, 'Pasante Ingeniería Ambiental', 'Apoyarás en gestión ambiental y sostenibilidad.', 'Presencial', 'Ingeniería Ambiental, Gestión Ambiental', 'Gestión ambiental, normativa boliviana.', 'Certificado, proyectos de sostenibilidad.', 1, 16, '2026-09-01'::date, '2026-12-31'::date),
(45, 2, 1, 2, 'Pasante Diseño Gráfico y Multimedia', 'Apoyarás en creación de piezas gráficas y branding.', 'Híbrido', 'Diseño Gráfico, Diseño Digital', 'Adobe Suite, creatividad, portfolio.', 'Certificado, portfolio profesional.', 1, 16, '2026-08-01'::date, '2026-11-30'::date),
(46, 2, 4, 2, 'Pasante Agronomía (Proyectos Sostenibles)', 'Apoyarás en proyectos de sostenibilidad agrícola.', 'Presencial', 'Agronomía, Ingeniería Agronómica', 'Suelos, cultivos, riego, gestión ambiental.', 'Certificado, trabajo de campo.', 1, 16, '2026-09-01'::date, '2026-12-31'::date),
(47, 2, 12, 2, 'Pasante Educación y Capacitación Digital', 'Apoyarás en programas de capacitación digital y formación.', 'Presencial', 'Educación, Ciencias de la Educación', 'Didáctica, planificación curricular.', 'Certificado, impacto en comunidades.', 1, 16, '2026-08-01'::date, '2026-11-30'::date),
(48, 2, 3, 2, 'Pasante Deportes y Bienestar Corporativo', 'Apoyarás en programas de bienestar y actividades deportivas.', 'Presencial', 'Educación Física, Deportes', 'Entrenamiento deportivo, organización de eventos.', 'Certificado, instalaciones deportivas.', 1, 12, '2026-09-01'::date, '2026-11-30'::date),
(49, 2, 1, 2, 'Pasante Producción Musical y Contenido Audiovisual', 'Apoyarás en producción de contenido musical y podcasts.', 'Presencial', 'Música, Producción Musical', 'Producción musical, edición de audio.', 'Certificado, estudio de grabación.', 1, 16, '2026-08-01'::date, '2026-11-30'::date),
(50, 2, 10, 2, 'Pasante Comercio Exterior y Negocios Internacionales', 'Apoyarás en importaciones y trámites aduaneros.', 'Presencial', 'Comercio Exterior, Negocios Internacionales', 'Comercio exterior, trámites aduaneros, inglés.', 'Certificado, networking global.', 1, 16, '2026-09-01'::date, '2026-12-31'::date)
ON CONFLICT (id) DO NOTHING;
EOT;
        $ofertas_sql[] = <<<EOT
INSERT INTO "ofertas_pasantia" ("id", "perfil_empresa_id", "ubicacion_id", "estado_publicacion_id", "titulo", "descripcion", "modalidad", "carrera", "requisitos", "beneficios", "vacantes_disponibles", "duracion_semanas", "fecha_inicio", "fecha_fin") VALUES
(51, 3, 1, 2, 'Pasante Auditoría Interna', 'Apoyarás en auditorías financieras y evaluación de controles internos.', 'Presencial', 'Auditoría, Contabilidad', 'Auditoría, NIIF, control interno, Excel.', 'Certificado, certificaciones internas.', 2, 20, '2026-08-01'::date, '2026-12-31'::date),
(52, 3, 3, 2, 'Pasante Marketing Bancario', 'Apoyarás en campañas de marketing y análisis de mercado.', 'Presencial', 'Marketing, Publicidad', 'Marketing digital, análisis de mercado.', 'Certificado, networking.', 1, 16, '2026-08-15'::date, '2026-12-15'::date),
(53, 3, 4, 2, 'Pasante Ingeniería Industrial (Procesos)', 'Apoyarás en optimización de procesos bancarios.', 'Presencial', 'Ingeniería Industrial', 'Lean, Six Sigma, Excel, SQL.', 'Certificado, mentoría.', 1, 20, '2026-09-01'::date, '2027-01-31'::date),
(54, 3, 1, 2, 'Pasante Derecho Tributario', 'Apoyarás en gestión tributaria y planificación fiscal.', 'Presencial', 'Derecho, Contabilidad', 'Derecho tributario, impuestos bolivianos.', 'Certificado, capacitaciones especializadas.', 1, 16, '2026-08-01'::date, '2026-11-30'::date),
(55, 3, 3, 2, 'Pasante Gestión de Recursos Humanos', 'Apoyarás en reclutamiento, selección y clima laboral.', 'Presencial', 'Psicología, Administración', 'RRHH, Excel, comunicación efectiva.', 'Certificado, beneficios corporativos.', 2, 16, '2026-09-01'::date, '2026-12-31'::date),
(56, 3, 1, 2, 'Pasante Comercio Exterior y Cambios', 'Apoyarás en operaciones de comercio exterior y cartas de crédito.', 'Presencial', 'Comercio Exterior, Economía', 'Comercio exterior, finanzas internacionales, inglés.', 'Certificado, banca internacional.', 1, 16, '2026-08-01'::date, '2026-11-30'::date),
(57, 3, 4, 2, 'Pasante Estadística y Modelos Financieros', 'Apoyarás en modelos estadísticos y reportes predictivos.', 'Presencial', 'Estadística, Economía, Ingeniería de Sistemas', 'Estadística, Python o R, Excel.', 'Certificado, modelado financiero.', 1, 20, '2026-09-01'::date, '2027-01-31'::date),
(58, 3, 13, 2, 'Pasante Administración de Empresas', 'Apoyarás en gestión administrativa de sucursales.', 'Presencial', 'Administración de Empresas', 'Administración, atención al cliente, Excel.', 'Certificado, crecimiento regional.', 2, 16, '2026-08-01'::date, '2026-11-30'::date),
(59, 3, 1, 2, 'Pasante Psicología Laboral', 'Apoyarás en evaluación psicométrica y bienestar laboral.', 'Presencial', 'Psicología', 'Psicometría, evaluación psicológica.', 'Certificado, capacitaciones internas.', 1, 16, '2026-08-15'::date, '2026-12-15'::date),
(60, 3, 3, 2, 'Pasante Economía y Estudios Económicos', 'Apoyarás en informes macroeconómicos y proyecciones.', 'Presencial', 'Economía', 'Macroeconomía, econometría, Excel.', 'Certificado, mentoría.', 1, 20, '2026-09-01'::date, '2027-01-31'::date),
(61, 3, 4, 2, 'Pasante Ingeniería de Sistemas (Core Bancario)', 'Apoyarás en mantenimiento del core bancario.', 'Presencial', 'Ingeniería de Sistemas, Informática', 'Java, SQL, sistemas transaccionales.', 'Certificado, sistemas bancarios críticos.', 2, 24, '2026-08-01'::date, '2027-01-31'::date),
(62, 3, 6, 2, 'Pasante Arquitectura (Sucursales)', 'Apoyarás en diseño de remodelaciones de sucursales.', 'Presencial', 'Arquitectura, Diseño de Interiores', 'Revit, AutoCAD, diseño de interiores.', 'Certificado, proyectos corporativos.', 1, 16, '2026-09-01'::date, '2026-12-31'::date),
(63, 3, 1, 2, 'Pasante Comunicación y Relaciones Públicas', 'Apoyarás en comunicación externa y relaciones con medios.', 'Presencial', 'Comunicación Social, Periodismo', 'Redacción, RRPP, manejo de medios.', 'Certificado, networking.', 1, 16, '2026-08-01'::date, '2026-11-30'::date),
(64, 3, 14, 2, 'Pasante Educación Financiera', 'Apoyarás en programas de educación financiera.', 'Presencial', 'Educación, Economía, Administración', 'Educación, finanzas básicas, didáctica.', 'Certificado, proyectos de impacto social.', 1, 16, '2026-08-15'::date, '2026-12-15'::date),
(65, 3, 3, 2, 'Pasante Ingeniería Ambiental (Sostenibilidad)', 'Apoyarás en gestión ambiental y reducción de huella de carbono.', 'Presencial', 'Ingeniería Ambiental', 'Gestión ambiental, sostenibilidad.', 'Certificado, proyectos verdes.', 1, 16, '2026-09-01'::date, '2026-12-31'::date),
(66, 3, 1, 2, 'Pasante Diseño Gráfico Bancario', 'Apoyarás en materiales gráficos y branding institucional.', 'Híbrido', 'Diseño Gráfico, Diseño Digital', 'Adobe Suite, creatividad, portfolio.', 'Certificado, herramientas licenciadas.', 1, 16, '2026-08-01'::date, '2026-11-30'::date),
(67, 3, 4, 2, 'Pasante Trabajo Social Comunitario', 'Apoyarás en programas de responsabilidad social.', 'Presencial', 'Trabajo Social, Sociología', 'Intervención social, trabajo comunitario.', 'Certificado, RSE bancaria.', 1, 16, '2026-09-01'::date, '2026-12-31'::date),
(68, 3, 5, 2, 'Pasante Logística Bancaria', 'Apoyarás en gestión de transporte de valores y suministros.', 'Presencial', 'Logística, Administración', 'Logística, cadena de suministro.', 'Certificado, capacitaciones.', 1, 16, '2026-08-01'::date, '2026-11-30'::date),
(69, 3, 1, 2, 'Pasante Deportes y Eventos Corporativos', 'Apoyarás en eventos deportivos corporativos.', 'Presencial', 'Educación Física, Deportes', 'Organización, liderazgo.', 'Certificado, instalaciones deportivas.', 1, 12, '2026-09-01'::date, '2026-11-30'::date),
(70, 3, 3, 2, 'Pasante Inteligencia de Negocios', 'Apoyarás en análisis de datos comerciales y reporting.', 'Presencial', 'Estadística, Ingeniería de Sistemas, Marketing', 'SQL, Power BI, Python.', 'Certificado, BI del sector financiero.', 2, 20, '2026-08-01'::date, '2026-12-31'::date)
ON CONFLICT (id) DO NOTHING;
EOT;
        $ofertas_sql[] = <<<EOT
INSERT INTO "ofertas_pasantia" ("id", "perfil_empresa_id", "ubicacion_id", "estado_publicacion_id", "titulo", "descripcion", "modalidad", "carrera", "requisitos", "beneficios", "vacantes_disponibles", "duracion_semanas", "fecha_inicio", "fecha_fin") VALUES
(71, 5, 1, 2, 'Pasante Data Science y Machine Learning', 'Trabajarás en proyectos de IA y modelos predictivos.', 'Híbrido', 'Ingeniería de Sistemas, Estadística, IA/Datos', 'Python, Machine Learning, SQL.', 'Certificado, GPU clusters, mentoring.', 2, 20, '2026-08-01'::date, '2026-12-31'::date),
(72, 5, 3, 2, 'Pasante Ciberseguridad Ofensiva', 'Apoyarás en pruebas de penetración y análisis de vulnerabilidades.', 'Presencial', 'Ciberseguridad, Ingeniería de Sistemas', 'Ethical hacking, Linux, redes.', 'Certificado, laboratorio de seguridad.', 1, 20, '2026-09-01'::date, '2027-01-31'::date),
(73, 5, 4, 2, 'Pasante Testing Automatizado QA', 'Diseñarás pruebas automatizadas y pipelines de testing.', 'Presencial', 'Ingeniería de Sistemas, Informática', 'Selenium, Cypress, Git, CI/CD.', 'Certificado, herramientas de última gen.', 2, 16, '2026-08-01'::date, '2026-11-30'::date),
(74, 5, 1, 2, 'Pasante Technical Writer y Documentación', 'Crearás documentación técnica y manuales de API.', 'Remoto', 'Comunicación, Inglés, Ingeniería de Sistemas', 'Redacción técnica, inglés, Git.', 'Certificado, trabajo remoto.', 1, 16, '2026-08-15'::date, '2026-12-15'::date),
(75, 5, 3, 2, 'Pasante Product Management', 'Apoyarás en gestión de productos digitales.', 'Híbrido', 'Ingeniería de Sistemas, Administración, Marketing', 'Metodologías ágiles, análisis de requisitos.', 'Certificado, mentoring con PM seniors.', 1, 20, '2026-09-01'::date, '2027-01-31'::date),
(76, 5, 4, 2, 'Pasante Diseño Gráfico y Branding Digital', 'Crearás piezas gráficas y branding digital.', 'Híbrido', 'Diseño Gráfico, Diseño Digital', 'Adobe Suite, Figma, portfolio.', 'Certificado, herramientas licenciadas.', 1, 16, '2026-08-01'::date, '2026-11-30'::date),
(77, 5, 1, 2, 'Pasante Community Manager y Redes Sociales', 'Gestionarás redes sociales y comunidad tech.', 'Remoto', 'Marketing, Comunicación', 'Redes sociales, contenido, métricas.', 'Certificado, comunidad tech.', 1, 16, '2026-08-01'::date, '2026-11-30'::date),
(78, 5, 15, 2, 'Pasante Ingeniería de Datos', 'Construirás pipelines de datos y ETLs.', 'Presencial', 'Ingeniería de Sistemas, Estadística', 'SQL, Python, ETL, big data.', 'Certificado, infraestructura moderna.', 1, 20, '2026-09-01'::date, '2027-01-31'::date),
(79, 5, 3, 2, 'Pasante Soporte Técnico Nivel 2', 'Apoyarás en resolución de incidencias técnicas.', 'Presencial', 'Ingeniería de Sistemas, Redes', 'Linux, redes, bases de datos.', 'Certificado, capacitaciones.', 2, 16, '2026-08-01'::date, '2026-11-30'::date),
(80, 5, 4, 2, 'Pasante Administración de Sistemas Cloud', 'Administrarás servidores cloud y automatización.', 'Remoto', 'Ingeniería de Sistemas, Informática', 'Linux, AWS/GCP, Docker.', 'Certificado, certificaciones pagadas.', 1, 20, '2026-09-01'::date, '2027-01-31'::date),
(81, 5, 1, 2, 'Pasante Desarrollo de Videojuegos', 'Participarás en desarrollo de videojuegos educativos.', 'Presencial', 'Ingeniería de Sistemas, Diseño Digital', 'Unity, C#, modelado 3D.', 'Certificado, laboratorio VR.', 1, 20, '2026-08-01'::date, '2026-12-31'::date),
(82, 5, 6, 2, 'Pasante Blockchain y Web3', 'Apoyarás en desarrollo de aplicaciones descentralizadas.', 'Remoto', 'Ingeniería de Sistemas, Informática', 'Blockchain, Solidity, JavaScript.', 'Certificado, trabajo remoto.', 1, 16, '2026-09-01'::date, '2026-12-31'::date),
(83, 5, 3, 2, 'Pasante Automatización con IA', 'Desarrollarás bots y asistentes virtuales.', 'Híbrido', 'Ingeniería de Sistemas, IA/Datos', 'Python, NLP, APIs.', 'Certificado, IA aplicada.', 1, 16, '2026-08-15'::date, '2026-12-15'::date),
(84, 5, 4, 2, 'Pasante Desarrollo iOS Swift', 'Desarrollarás apps iOS nativas con Swift.', 'Presencial', 'Ingeniería de Sistemas, Informática', 'Swift, SwiftUI, Xcode, APIs REST.', 'Certificado, mentoring.', 1, 20, '2026-09-01'::date, '2027-01-31'::date),
(85, 5, 1, 2, 'Pasante Raspberry Pi e IoT', 'Desarrollarás proyectos de IoT con Raspberry Pi.', 'Presencial', 'Ingeniería de Sistemas, Electrotecnia', 'Python, Linux, Raspberry Pi, sensores.', 'Certificado, laboratorio IoT.', 1, 16, '2026-08-01'::date, '2026-11-30'::date),
(86, 5, 11, 2, 'Pasante Psicología UX y Experiencia de Usuario', 'Apoyarás en investigación de usuarios y usabilidad.', 'Híbrido', 'Psicología, Diseño Digital', 'Investigación UX, Figma, análisis de datos.', 'Certificado, UX research real.', 1, 16, '2026-09-01'::date, '2026-12-31'::date),
(87, 5, 3, 2, 'Pasante Administración de Proyectos Ágiles', 'Apoyarás en gestión de proyectos con Scrum/Kanban.', 'Híbrido', 'Administración, Ingeniería de Sistemas', 'Scrum, Jira, gestión de equipos.', 'Certificado, certificación Scrum.', 1, 16, '2026-08-01'::date, '2026-11-30'::date),
(88, 5, 4, 2, 'Pasante Big Data y Analítica Avanzada', 'Trabajarás con big data para insights de negocio.', 'Presencial', 'Ingeniería de Sistemas, Estadística, IA/Datos', 'Hadoop, Spark, Python, SQL.', 'Certificado, clusters de procesamiento.', 1, 20, '2026-09-01'::date, '2027-01-31'::date),
(89, 5, 1, 2, 'Pasante Realidad Virtual y Aumentada', 'Desarrollarás experiencias inmersivas VR/AR.', 'Presencial', 'Ingeniería de Sistemas, Diseño Digital', 'Unity, C#, modelado 3D, RV/RA.', 'Certificado, laboratorio VR.', 1, 20, '2026-08-01'::date, '2026-12-31'::date),
(90, 5, 6, 2, 'Pasante Ética y Regulación Digital', 'Apoyarás en aspectos éticos y regulatorios de IA.', 'Remoto', 'Derecho, Filosofía, Ingeniería de Sistemas', 'Ética tecnológica, regulación digital.', 'Certificado, investigación aplicada.', 1, 16, '2026-09-01'::date, '2026-12-31'::date)
ON CONFLICT (id) DO NOTHING;
EOT;

        foreach ($ofertas_sql as $sql) {
            try {
                DB::statement($sql);
            } catch (\Exception $e) {
                $this->command->warn('Error en ofertas batch: ' . $e->getMessage());
            }
        }

        $requisitos_sql = [];
        $requisitos_sql[] = <<<EOT
INSERT INTO "requisitos_habilidad_oferta" ("oferta_pasantia_id", "habilidad_id", "peso", "nivel_minimo", "tipo_criterio") VALUES
(16, 15, 0.35, 3, 'benefit'), (16, 9, 0.20, 2, 'benefit'), (16, 118, 0.20, 2, 'benefit'), (16, 11, 0.15, 2, 'benefit'), (16, 113, 0.10, 1, 'benefit'),
(17, 47, 0.35, 3, 'benefit'), (17, 7, 0.20, 2, 'benefit'), (17, 48, 0.20, 2, 'benefit'), (17, 49, 0.15, 2, 'benefit'), (17, 12, 0.10, 1, 'benefit'),
(18, 4, 0.30, 3, 'benefit'), (18, 11, 0.20, 2, 'benefit'), (18, 5, 0.20, 2, 'benefit'), (18, 13, 0.15, 2, 'benefit'), (18, 110, 0.15, 1, 'benefit'),
(19, 7, 0.25, 3, 'benefit'), (19, 8, 0.25, 2, 'benefit'), (19, 3, 0.20, 2, 'benefit'), (19, 111, 0.15, 2, 'benefit'), (19, 125, 0.15, 1, 'benefit'),
(20, 48, 0.30, 3, 'benefit'), (20, 7, 0.25, 2, 'benefit'), (20, 49, 0.20, 2, 'benefit'), (20, 44, 0.15, 2, 'benefit'), (20, 46, 0.10, 1, 'benefit'),
(21, 40, 0.25, 2, 'benefit'), (21, 5, 0.20, 2, 'benefit'), (21, 12, 0.20, 2, 'benefit'), (21, 41, 0.20, 2, 'benefit'), (21, 111, 0.15, 1, 'benefit'),
(22, 7, 0.25, 3, 'benefit'), (22, 41, 0.25, 3, 'benefit'), (22, 53, 0.20, 2, 'benefit'), (22, 8, 0.15, 2, 'benefit'), (22, 42, 0.15, 2, 'benefit'),
(23, 54, 0.30, 2, 'benefit'), (23, 7, 0.25, 3, 'benefit'), (23, 41, 0.20, 2, 'benefit'), (23, 53, 0.15, 2, 'benefit'), (23, 43, 0.10, 1, 'benefit'),
(24, 42, 0.30, 3, 'benefit'), (24, 7, 0.25, 3, 'benefit'), (24, 43, 0.20, 2, 'benefit'), (24, 41, 0.15, 2, 'benefit'), (24, 53, 0.10, 1, 'benefit'),
(25, 30, 0.30, 2, 'benefit'), (25, 31, 0.20, 2, 'benefit'), (25, 7, 0.20, 2, 'benefit'), (25, 33, 0.15, 2, 'benefit'), (25, 43, 0.15, 1, 'benefit'),
(26, 1, 0.30, 3, 'benefit'), (26, 111, 0.20, 2, 'benefit'), (26, 11, 0.15, 2, 'benefit'), (26, 10, 0.15, 2, 'benefit'), (26, 109, 0.10, 1, 'benefit'), (26, 2, 0.10, 2, 'benefit'),
(27, 102, 0.30, 3, 'benefit'), (27, 5, 0.20, 3, 'benefit'), (27, 101, 0.15, 2, 'benefit'), (27, 104, 0.15, 2, 'benefit'), (27, 11, 0.10, 2, 'benefit'), (27, 105, 0.10, 1, 'benefit'),
(28, 5, 0.25, 2, 'benefit'), (28, 13, 0.20, 2, 'benefit'), (28, 11, 0.20, 2, 'benefit'), (28, 12, 0.15, 2, 'benefit'), (28, 110, 0.10, 1, 'benefit'), (28, 111, 0.10, 1, 'benefit'),
(29, 12, 0.35, 3, 'benefit'), (29, 5, 0.20, 2, 'benefit'), (29, 104, 0.15, 2, 'benefit'), (29, 105, 0.15, 2, 'benefit'), (29, 106, 0.15, 1, 'benefit'),
(30, 10, 0.25, 3, 'benefit'), (30, 9, 0.20, 3, 'benefit'), (30, 11, 0.15, 2, 'benefit'), (30, 113, 0.15, 2, 'benefit'), (30, 116, 0.15, 2, 'benefit'), (30, 115, 0.10, 1, 'benefit')
ON CONFLICT DO NOTHING;
EOT;
        $requisitos_sql[] = <<<EOT
INSERT INTO "requisitos_habilidad_oferta" ("oferta_pasantia_id", "habilidad_id", "peso", "nivel_minimo", "tipo_criterio") VALUES
(31, 44, 0.30, 2, 'benefit'), (31, 7, 0.25, 2, 'benefit'), (31, 40, 0.20, 2, 'benefit'), (31, 48, 0.15, 2, 'benefit'), (31, 123, 0.10, 1, 'benefit'),
(32, 55, 0.30, 2, 'benefit'), (32, 56, 0.25, 2, 'benefit'), (32, 58, 0.20, 2, 'benefit'), (32, 59, 0.15, 2, 'benefit'), (32, 64, 0.10, 1, 'benefit'),
(33, 30, 0.30, 3, 'benefit'), (33, 31, 0.20, 2, 'benefit'), (33, 29, 0.20, 2, 'benefit'), (33, 33, 0.15, 2, 'benefit'), (33, 27, 0.15, 1, 'benefit'),
(34, 42, 0.30, 3, 'benefit'), (34, 7, 0.25, 3, 'benefit'), (34, 43, 0.20, 2, 'benefit'), (34, 41, 0.15, 2, 'benefit'), (34, 117, 0.10, 1, 'benefit'),
(35, 37, 0.30, 3, 'benefit'), (35, 39, 0.25, 2, 'benefit'), (35, 35, 0.20, 2, 'benefit'), (35, 7, 0.15, 2, 'benefit'), (35, 44, 0.10, 1, 'benefit'),
(36, 64, 0.30, 2, 'benefit'), (36, 65, 0.25, 2, 'benefit'), (36, 7, 0.20, 2, 'benefit'), (36, 46, 0.15, 2, 'benefit'), (36, 40, 0.10, 1, 'benefit'),
(37, 81, 0.30, 3, 'benefit'), (37, 82, 0.20, 2, 'benefit'), (37, 47, 0.20, 2, 'benefit'), (37, 48, 0.15, 2, 'benefit'), (37, 76, 0.15, 2, 'benefit'),
(38, 67, 0.30, 2, 'benefit'), (38, 69, 0.25, 2, 'benefit'), (38, 68, 0.20, 2, 'benefit'), (38, 70, 0.15, 2, 'benefit'), (38, 71, 0.10, 1, 'benefit'),
(39, 46, 0.35, 3, 'benefit'), (39, 7, 0.20, 2, 'benefit'), (39, 45, 0.20, 2, 'benefit'), (39, 40, 0.15, 2, 'benefit'), (39, 64, 0.10, 1, 'benefit'),
(40, 44, 0.30, 3, 'benefit'), (40, 37, 0.25, 2, 'benefit'), (40, 48, 0.15, 2, 'benefit'), (40, 7, 0.15, 2, 'benefit'), (40, 49, 0.15, 2, 'benefit'),
(41, 61, 0.30, 3, 'benefit'), (41, 62, 0.25, 2, 'benefit'), (41, 56, 0.20, 2, 'benefit'), (41, 66, 0.15, 2, 'benefit'), (41, 10, 0.10, 1, 'benefit'),
(42, 83, 0.30, 2, 'benefit'), (42, 84, 0.25, 2, 'benefit'), (42, 86, 0.20, 2, 'benefit'), (42, 48, 0.15, 2, 'benefit'), (42, 76, 0.10, 1, 'benefit'),
(43, 78, 0.30, 3, 'benefit'), (43, 77, 0.25, 2, 'benefit'), (43, 79, 0.20, 2, 'benefit'), (43, 80, 0.15, 2, 'benefit'), (43, 90, 0.10, 1, 'benefit'),
(44, 90, 0.30, 3, 'benefit'), (44, 88, 0.25, 2, 'benefit'), (44, 89, 0.20, 2, 'benefit'), (44, 91, 0.15, 2, 'benefit'), (44, 64, 0.10, 1, 'benefit'),
(45, 96, 0.30, 3, 'benefit'), (45, 12, 0.25, 2, 'benefit'), (45, 82, 0.20, 2, 'benefit'), (45, 97, 0.15, 2, 'benefit'), (45, 95, 0.10, 1, 'benefit'),
(46, 88, 0.30, 2, 'benefit'), (46, 89, 0.25, 2, 'benefit'), (46, 90, 0.20, 2, 'benefit'), (46, 91, 0.15, 2, 'benefit'), (46, 92, 0.10, 1, 'benefit'),
(47, 72, 0.30, 3, 'benefit'), (47, 73, 0.25, 2, 'benefit'), (47, 74, 0.20, 2, 'benefit'), (47, 75, 0.15, 2, 'benefit'), (47, 76, 0.10, 1, 'benefit'),
(48, 98, 0.30, 3, 'benefit'), (48, 99, 0.25, 2, 'benefit'), (48, 100, 0.20, 2, 'benefit'), (48, 86, 0.15, 2, 'benefit'), (48, 49, 0.10, 1, 'benefit'),
(49, 93, 0.30, 2, 'benefit'), (49, 94, 0.25, 2, 'benefit'), (49, 95, 0.25, 2, 'benefit'), (49, 96, 0.10, 1, 'benefit'), (49, 97, 0.10, 1, 'benefit'),
(50, 45, 0.35, 3, 'benefit'), (50, 46, 0.25, 2, 'benefit'), (50, 34, 0.20, 2, 'benefit'), (50, 7, 0.10, 2, 'benefit'), (50, 76, 0.10, 1, 'benefit')
ON CONFLICT DO NOTHING;
EOT;
        $requisitos_sql[] = <<<EOT
INSERT INTO "requisitos_habilidad_oferta" ("oferta_pasantia_id", "habilidad_id", "peso", "nivel_minimo", "tipo_criterio") VALUES
(51, 43, 0.30, 3, 'benefit'), (51, 42, 0.25, 3, 'benefit'), (51, 7, 0.20, 2, 'benefit'), (51, 41, 0.15, 2, 'benefit'), (51, 117, 0.10, 1, 'benefit'),
(52, 47, 0.35, 3, 'benefit'), (52, 48, 0.20, 2, 'benefit'), (52, 49, 0.20, 2, 'benefit'), (52, 7, 0.15, 2, 'benefit'), (52, 122, 0.10, 1, 'benefit'),
(53, 64, 0.30, 2, 'benefit'), (53, 7, 0.25, 2, 'benefit'), (53, 40, 0.20, 2, 'benefit'), (53, 46, 0.15, 2, 'benefit'), (53, 65, 0.10, 1, 'benefit'),
(54, 33, 0.35, 3, 'benefit'), (54, 7, 0.20, 2, 'benefit'), (54, 30, 0.20, 2, 'benefit'), (54, 31, 0.15, 2, 'benefit'), (54, 42, 0.10, 1, 'benefit'),
(55, 44, 0.30, 3, 'benefit'), (55, 37, 0.20, 2, 'benefit'), (55, 7, 0.20, 2, 'benefit'), (55, 48, 0.15, 2, 'benefit'), (55, 49, 0.15, 2, 'benefit'),
(56, 45, 0.30, 2, 'benefit'), (56, 53, 0.25, 2, 'benefit'), (56, 46, 0.20, 2, 'benefit'), (56, 7, 0.15, 2, 'benefit'), (56, 76, 0.10, 1, 'benefit'),
(57, 52, 0.30, 2, 'benefit'), (57, 3, 0.25, 2, 'benefit'), (57, 7, 0.20, 2, 'benefit'), (57, 51, 0.15, 2, 'benefit'), (57, 50, 0.10, 1, 'benefit'),
(58, 44, 0.30, 2, 'benefit'), (58, 48, 0.25, 3, 'benefit'), (58, 7, 0.20, 2, 'benefit'), (58, 40, 0.15, 2, 'benefit'), (58, 49, 0.10, 1, 'benefit'),
(59, 39, 0.30, 3, 'benefit'), (59, 35, 0.25, 2, 'benefit'), (59, 37, 0.20, 2, 'benefit'), (59, 7, 0.15, 2, 'benefit'), (59, 38, 0.10, 1, 'benefit'),
(60, 51, 0.30, 3, 'benefit'), (60, 50, 0.25, 2, 'benefit'), (60, 52, 0.20, 2, 'benefit'), (60, 7, 0.15, 2, 'benefit'), (60, 53, 0.10, 1, 'benefit'),
(61, 4, 0.25, 3, 'benefit'), (61, 111, 0.25, 2, 'benefit'), (61, 40, 0.20, 2, 'benefit'), (61, 11, 0.15, 2, 'benefit'), (61, 110, 0.15, 1, 'benefit'),
(62, 67, 0.30, 2, 'benefit'), (62, 69, 0.25, 2, 'benefit'), (62, 70, 0.20, 2, 'benefit'), (62, 68, 0.15, 2, 'benefit'), (62, 56, 0.10, 1, 'benefit'),
(63, 81, 0.30, 3, 'benefit'), (63, 34, 0.25, 2, 'benefit'), (63, 76, 0.20, 2, 'benefit'), (63, 48, 0.15, 2, 'benefit'), (63, 47, 0.10, 1, 'benefit'),
(64, 72, 0.30, 2, 'benefit'), (64, 73, 0.25, 2, 'benefit'), (64, 74, 0.20, 2, 'benefit'), (64, 75, 0.15, 2, 'benefit'), (64, 53, 0.10, 1, 'benefit'),
(65, 90, 0.35, 3, 'benefit'), (65, 88, 0.20, 2, 'benefit'), (65, 64, 0.20, 2, 'benefit'), (65, 66, 0.15, 2, 'benefit'), (65, 89, 0.10, 1, 'benefit'),
(66, 96, 0.30, 3, 'benefit'), (66, 12, 0.25, 2, 'benefit'), (66, 97, 0.20, 2, 'benefit'), (66, 82, 0.15, 2, 'benefit'), (66, 95, 0.10, 1, 'benefit'),
(67, 78, 0.35, 3, 'benefit'), (67, 77, 0.25, 2, 'benefit'), (67, 79, 0.20, 2, 'benefit'), (67, 80, 0.10, 1, 'benefit'), (67, 90, 0.10, 1, 'benefit'),
(68, 46, 0.35, 3, 'benefit'), (68, 45, 0.25, 2, 'benefit'), (68, 7, 0.20, 2, 'benefit'), (68, 40, 0.10, 2, 'benefit'), (68, 64, 0.10, 1, 'benefit'),
(69, 98, 0.30, 2, 'benefit'), (69, 86, 0.25, 2, 'benefit'), (69, 99, 0.20, 2, 'benefit'), (69, 49, 0.15, 2, 'benefit'), (69, 100, 0.10, 1, 'benefit'),
(70, 8, 0.30, 3, 'benefit'), (70, 7, 0.20, 2, 'benefit'), (70, 111, 0.20, 2, 'benefit'), (70, 3, 0.15, 2, 'benefit'), (70, 125, 0.15, 1, 'benefit')
ON CONFLICT DO NOTHING;
EOT;
        $requisitos_sql[] = <<<EOT
INSERT INTO "requisitos_habilidad_oferta" ("oferta_pasantia_id", "habilidad_id", "peso", "nivel_minimo", "tipo_criterio") VALUES
(71, 121, 0.30, 3, 'benefit'), (71, 3, 0.20, 2, 'benefit'), (71, 125, 0.20, 2, 'benefit'), (71, 122, 0.15, 2, 'benefit'), (71, 123, 0.15, 1, 'benefit'),
(72, 118, 0.35, 3, 'benefit'), (72, 119, 0.25, 2, 'benefit'), (72, 9, 0.15, 2, 'benefit'), (72, 15, 0.15, 2, 'benefit'), (72, 120, 0.10, 1, 'benefit'),
(73, 5, 0.20, 2, 'benefit'), (73, 11, 0.20, 2, 'benefit'), (73, 10, 0.20, 2, 'benefit'), (73, 116, 0.20, 2, 'benefit'), (73, 13, 0.10, 1, 'benefit'), (73, 64, 0.10, 1, 'benefit'),
(74, 76, 0.30, 3, 'benefit'), (74, 5, 0.20, 2, 'benefit'), (74, 11, 0.20, 2, 'benefit'), (74, 31, 0.15, 2, 'benefit'), (74, 101, 0.15, 1, 'benefit'),
(75, 40, 0.35, 3, 'benefit'), (75, 5, 0.15, 2, 'benefit'), (75, 12, 0.15, 2, 'benefit'), (75, 101, 0.15, 2, 'benefit'), (75, 125, 0.10, 1, 'benefit'), (75, 49, 0.10, 1, 'benefit'),
(76, 96, 0.30, 3, 'benefit'), (76, 12, 0.25, 2, 'benefit'), (76, 97, 0.20, 2, 'benefit'), (76, 82, 0.15, 2, 'benefit'), (76, 95, 0.10, 1, 'benefit'),
(77, 47, 0.35, 3, 'benefit'), (77, 48, 0.20, 2, 'benefit'), (77, 49, 0.20, 2, 'benefit'), (77, 82, 0.15, 2, 'benefit'), (77, 76, 0.10, 1, 'benefit'),
(78, 3, 0.25, 2, 'benefit'), (78, 111, 0.25, 2, 'benefit'), (78, 110, 0.20, 2, 'benefit'), (78, 113, 0.15, 2, 'benefit'), (78, 10, 0.15, 1, 'benefit'),
(79, 9, 0.30, 3, 'benefit'), (79, 15, 0.20, 2, 'benefit'), (79, 48, 0.20, 2, 'benefit'), (79, 2, 0.15, 2, 'benefit'), (79, 11, 0.15, 1, 'benefit'),
(80, 9, 0.25, 3, 'benefit'), (80, 113, 0.25, 2, 'benefit'), (80, 10, 0.20, 2, 'benefit'), (80, 11, 0.15, 2, 'benefit'), (80, 116, 0.15, 1, 'benefit'),
(81, 14, 0.30, 2, 'benefit'), (81, 12, 0.20, 2, 'benefit'), (81, 3, 0.20, 2, 'benefit'), (81, 68, 0.15, 2, 'benefit'), (81, 97, 0.15, 1, 'benefit'),
(82, 5, 0.25, 2, 'benefit'), (82, 13, 0.20, 2, 'benefit'), (82, 109, 0.20, 2, 'benefit'), (82, 11, 0.15, 2, 'benefit'), (82, 110, 0.10, 1, 'benefit'), (82, 10, 0.10, 1, 'benefit'),
(83, 3, 0.30, 2, 'benefit'), (83, 123, 0.25, 2, 'benefit'), (83, 121, 0.20, 2, 'benefit'), (83, 13, 0.15, 2, 'benefit'), (83, 11, 0.10, 1, 'benefit'),
(84, 5, 0.25, 2, 'benefit'), (84, 11, 0.20, 2, 'benefit'), (84, 13, 0.20, 2, 'benefit'), (84, 12, 0.15, 2, 'benefit'), (84, 106, 0.10, 1, 'benefit'), (84, 109, 0.10, 1, 'benefit'),
(85, 3, 0.30, 2, 'benefit'), (85, 9, 0.20, 2, 'benefit'), (85, 61, 0.20, 2, 'benefit'), (85, 65, 0.15, 2, 'benefit'), (85, 10, 0.15, 1, 'benefit'),
(86, 35, 0.25, 2, 'benefit'), (86, 12, 0.25, 2, 'benefit'), (86, 77, 0.20, 2, 'benefit'), (86, 79, 0.15, 2, 'benefit'), (86, 5, 0.15, 1, 'benefit'),
(87, 40, 0.35, 3, 'benefit'), (87, 5, 0.15, 2, 'benefit'), (87, 11, 0.15, 2, 'benefit'), (87, 48, 0.15, 2, 'benefit'), (87, 49, 0.10, 1, 'benefit'), (87, 64, 0.10, 1, 'benefit'),
(88, 3, 0.25, 2, 'benefit'), (88, 111, 0.20, 2, 'benefit'), (88, 125, 0.20, 2, 'benefit'), (88, 121, 0.15, 2, 'benefit'), (88, 113, 0.10, 1, 'benefit'), (88, 10, 0.10, 1, 'benefit'),
(89, 14, 0.25, 2, 'benefit'), (89, 68, 0.25, 2, 'benefit'), (89, 12, 0.20, 2, 'benefit'), (89, 97, 0.15, 2, 'benefit'), (89, 11, 0.15, 1, 'benefit'),
(90, 30, 0.25, 2, 'benefit'), (90, 33, 0.20, 2, 'benefit'), (90, 31, 0.20, 2, 'benefit'), (90, 118, 0.20, 2, 'benefit'), (90, 121, 0.15, 1, 'benefit')
ON CONFLICT DO NOTHING;
EOT;

        foreach ($requisitos_sql as $sql) {
            try {
                DB::statement($sql);
            } catch (\Exception $e) {
                $this->command->warn('Error en requisitos batch: ' . $e->getMessage());
            }
        }

        $this->command->info('Nuevas ofertas (IDs 16-90) y requisitos insertados correctamente.');
    }
}
