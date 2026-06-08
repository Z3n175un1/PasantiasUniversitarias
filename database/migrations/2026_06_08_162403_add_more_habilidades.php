<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            INSERT INTO habilidades (nombre, categoria, descripcion, activa) VALUES
            -- Salud / Medicina
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

            -- Derecho / Ciencias Políticas
            ('Derecho Civil', 'Legal', 'Derecho civil boliviano', 1),
            ('Derecho Penal', 'Legal', 'Derecho penal', 1),
            ('Derecho Laboral', 'Legal', 'Legislación laboral', 1),
            ('Derecho Corporativo', 'Legal', 'Asesoría legal empresarial', 1),
            ('Redacción Jurídica', 'Legal', 'Documentos legales', 1),
            ('Litigación Oral', 'Legal', 'Juicios orales', 1),
            ('Derecho Tributario', 'Legal', 'Legislación tributaria', 1),
            ('Relaciones Internacionales', 'Legal', 'Política y diplomacia', 1),

            -- Psicología
            ('Psicología Clínica', 'Psicología', 'Evaluación y terapia', 1),
            ('Psicología Educativa', 'Psicología', 'Orientación educativa', 1),
            ('Psicología Organizacional', 'Psicología', 'Gestión del talento humano', 1),
            ('Terapia Cognitivo-Conductual', 'Psicología', 'TCC', 1),
            ('Psicometría', 'Psicología', 'Pruebas psicológicas', 1),

            -- Administración / Negocios
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

            -- Economía / Finanzas
            ('Microeconomía', 'Economía', 'Teoría microeconómica', 1),
            ('Macroeconomía', 'Economía', 'Teoría macroeconómica', 1),
            ('Econometría', 'Economía', 'Modelos econométricos', 1),
            ('Banca y Finanzas', 'Economía', 'Sistema financiero', 1),
            ('Análisis de Riesgos', 'Economía', 'Gestión de riesgos', 1),

            -- Ingenierías (no tech)
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

            -- Arquitectura / Diseño
            ('Diseño Arquitectónico', 'Arquitectura', 'Planos arquitectónicos', 1),
            ('Render 3D', 'Arquitectura', 'Visualización 3D', 1),
            ('Revit', 'Arquitectura', 'BIM', 1),
            ('Diseño de Interiores', 'Arquitectura', 'Decoración y espacios', 1),
            ('Urbanismo', 'Arquitectura', 'Planificación urbana', 1),

            -- Educación / Pedagogía
            ('Didáctica General', 'Educación', 'Métodos de enseñanza', 1),
            ('Planificación Curricular', 'Educación', 'Diseño curricular', 1),
            ('Evaluación Educativa', 'Educación', 'Evaluación del aprendizaje', 1),
            ('Educación Inclusiva', 'Educación', 'Necesidades educativas especiales', 1),
            ('Idiomas', 'Educación', 'Enseñanza de idiomas', 1),

            -- Ciencias Sociales / Humanidades
            ('Investigación Social', 'Sociales', 'Metodología de investigación', 1),
            ('Trabajo Social', 'Sociales', 'Intervención social', 1),
            ('Sociología Aplicada', 'Sociales', 'Análisis sociológico', 1),
            ('Antropología Cultural', 'Sociales', 'Estudios culturales', 1),
            ('Periodismo', 'Sociales', 'Redacción periodística', 1),
            ('Fotografía', 'Sociales', 'Fotografía profesional', 1),

            -- Turismo / Hotelería
            ('Gestión Hotelera', 'Turismo', 'Administración hotelera', 1),
            ('Guía Turística', 'Turismo', 'Atención al turista', 1),
            ('Planificación Turística', 'Turismo', 'Desarrollo turístico', 1),
            ('Eventos y Protocolo', 'Turismo', 'Organización de eventos', 1),
            ('Gastronomía Básica', 'Turismo', 'Cocina y alimentos', 1),

            -- Agronomía / Ambiental
            ('Suelos y Cultivos', 'Agronomía', 'Manejo de cultivos', 1),
            ('Riego y Drenaje', 'Agronomía', 'Sistemas de riego', 1),
            ('Gestión Ambiental', 'Agronomía', 'Evaluación de impacto ambiental', 1),
            ('Biotecnología Vegetal', 'Agronomía', 'Mejoramiento genético', 1),
            ('Zootecnia', 'Agronomía', 'Producción pecuaria', 1),

            -- Arte / Música
            ('Teoría Musical', 'Arte', 'Lenguaje musical', 1),
            ('Instrumento Musical', 'Arte', 'Ejecución instrumental', 1),
            ('Producción Musical', 'Arte', 'Grabación y mezcla', 1),
            ('Artes Plásticas', 'Arte', 'Pintura y escultura', 1),
            ('Dibujo Artístico', 'Arte', 'Ilustración', 1),

            -- Deportes
            ('Educación Física', 'Deportes', 'Entrenamiento deportivo', 1),
            ('Fisiología del Ejercicio', 'Deportes', 'Ciencia del deporte', 1),
            ('Nutrición Deportiva', 'Deportes', 'Alimentación deportiva', 1),

            -- Más habilidades tech (ampliación)
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
    }

    public function down(): void
    {
        DB::table('habilidades')->whereIn('categoria', [
            'Salud', 'Legal', 'Psicología', 'Negocios', 'Economía',
            'Ingeniería', 'Arquitectura', 'Educación', 'Sociales',
            'Turismo', 'Agronomía', 'Arte', 'Deportes',
            'Frontend', 'Backend', 'Base de Datos', 'DevOps',
            'Seguridad', 'IA/Datos',
        ])->where('id', '>', 15)->delete();
    }
};
