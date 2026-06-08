<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Privacidad | UWorkFlow</title>
    @vite('resources/css/app.css')
    <link rel="icon" href="{{ asset('uworkflow-logo.ico') }}">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
        }

        .sidebar-link:hover {
            padding-left: 8px;
        }

        .sidebar-link {
            transition: all 0.3s ease;
        }

        .logo-container:hover .logo-icon {
            transform: rotate(12deg) scale(1.1);
            background-color: #2b6df2;
        }

        .logo-icon {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .legal-box {
            background: #fff5f5;
            border: 1px solid #fed7d7;
            border-left: 4px solid #e53e3e;
            border-radius: 12px;
            padding: 24px;
            margin: 20px 0;
        }

        .legal-box h3 {
            color: #c53030;
            font-size: 0.95rem;
            font-weight: 700;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .article-ref {
            display: inline-block;
            background: #fff;
            border: 1px solid #fed7d7;
            border-radius: 6px;
            padding: 1px 7px;
            font-size: 0.78rem;
            font-weight: 600;
            color: #c53030;
            font-family: monospace;
        }

        .info-box {
            background: #e8f0fe;
            border: 1px solid #bee3f8;
            border-left: 4px solid #2b6df2;
            border-radius: 12px;
            padding: 16px 20px;
            margin: 16px 0;
            font-size: 0.9rem;
            color: #1a365d;
        }

        .role-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin: 16px 0;
        }

        @media (max-width: 640px) {
            .role-grid { grid-template-columns: 1fr; }
        }

        .role-card {
            border-radius: 12px;
            padding: 20px;
            border: 1px solid;
        }

        .role-card.student {
            background: #f0f7ff;
            border-color: #bee3f8;
        }

        .role-card.company {
            background: #f0fff4;
            border-color: #9ae6b4;
        }

        .role-card h3 {
            font-size: 0.82rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .role-card.student h3 { color: #2b6cb0; }
        .role-card.company h3 { color: #276749; }

        .role-card ul {
            list-style: none;
            padding: 0;
            font-size: 0.875rem;
            color: #2d3748;
        }

        .role-card ul li {
            padding: 4px 0;
            display: flex;
            gap: 8px;
            align-items: flex-start;
        }

        .role-card ul li::before {
            content: '→';
            flex-shrink: 0;
            opacity: 0.5;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin: 16px 0;
            font-size: 0.875rem;
        }

        .data-table th {
            background: #0d1b2a;
            color: white;
            padding: 10px 14px;
            text-align: left;
            font-weight: 600;
            font-size: 0.8rem;
        }

        .data-table th:first-child { border-radius: 8px 0 0 0; }
        .data-table th:last-child  { border-radius: 0 8px 0 0; }

        .data-table td {
            padding: 10px 14px;
            border-bottom: 1px solid #e2e8f0;
            color: #2d3748;
            vertical-align: top;
        }

        .data-table tr:nth-child(even) td { background: #f9fbff; }
        .data-table tr:last-child td { border-bottom: none; }

        .policy-list { list-style: none; padding: 0; margin: 10px 0; }

        .policy-list li {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 8px 0;
            font-size: 0.925rem;
            color: #2d3748;
            border-bottom: 1px solid #e2e8f0;
        }

        .policy-list li:last-child { border-bottom: none; }

        .policy-list .bullet {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: #2b6df2;
            flex-shrink: 0;
            margin-top: 8px;
        }

        .bullet-red { background: #e53e3e !important; }

        .tag {
            display: inline-block;
            padding: 2px 9px;
            border-radius: 100px;
            font-size: 0.73rem;
            font-weight: 600;
        }

        .tag-blue  { background: #e8f0fe; color: #2b6df2; }
        .tag-green { background: #f0fff4; color: #276749; }
    </style>
</head>

<body class="bg-[#fcfcfc] text-[#1a1a1a] w-full h-screen">

    @include('components.navbar')

    <!-- MAIN CONTAINER -->
    <main class="max-w-7xl mx-auto px-[8%] py-16 flex flex-col lg:flex-row gap-12">

        <!-- SIDEBAR -->
        <aside class="lg:w-1/4">
            <div class="sticky top-28 bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
                <h4 class="font-bold text-sm uppercase tracking-wider text-[#2b6df2] mb-6">Contenido</h4>
                <ul class="space-y-3">
                    <li><a href="#recoleccion"       class="sidebar-link block text-[#666] hover:text-[#2b6df2] font-medium">1. Recolección de Datos</a></li>
                    <li><a href="#uso"               class="sidebar-link block text-[#666] hover:text-[#2b6df2] font-medium">2. Uso de la Información</a></li>
                    <li><a href="#responsabilidades" class="sidebar-link block text-[#666] hover:text-[#2b6df2] font-medium">3. Responsabilidades por Rol</a></li>
                    <li><a href="#proteccion"        class="sidebar-link block text-[#666] hover:text-[#2b6df2] font-medium">4. Protección de Datos</a></li>
                    <li><a href="#derechos"          class="sidebar-link block text-[#666] hover:text-[#2b6df2] font-medium">5. Derechos del Usuario</a></li>
                    <li><a href="#cookies"           class="sidebar-link block text-[#666] hover:text-[#2b6df2] font-medium">6. Cookies y Rastreo</a></li>
                    <li><a href="#terceros"          class="sidebar-link block text-[#666] hover:text-[#2b6df2] font-medium">7. Compartición con Terceros</a></li>
                    <li><a href="#retencion"         class="sidebar-link block text-[#666] hover:text-[#2b6df2] font-medium">8. Retención de Datos</a></li>
                    <li><a href="#menores"           class="sidebar-link block text-[#666] hover:text-[#2b6df2] font-medium">9. Menores de Edad</a></li>
                    <li><a href="#sanciones"         class="sidebar-link block text-[#666] hover:text-[#2b6df2] font-medium">10. Infracciones y Sanciones</a></li>
                    <li><a href="#contacto"          class="sidebar-link block text-[#666] hover:text-[#2b6df2] font-medium">11. Contacto</a></li>
                </ul>
                <div class="mt-6 p-3 bg-red-50 border border-red-200 rounded-xl text-xs text-red-700 flex gap-2">
                    <i data-lucide="alert-triangle" class="w-4 h-4 flex-shrink-0 mt-0.5"></i>
                    El mal uso de la plataforma puede acarrear consecuencias penales según la legislación boliviana vigente.
                </div>
            </div>
        </aside>

        <!-- CONTENT ARTICLE -->
        <article class="lg:w-3/4 space-y-8">

            <!-- Header -->
            <div class="bg-white p-8 md:p-12 rounded-3xl border border-gray-100 shadow-sm">
                <h1 class="text-4xl md:text-5xl font-bold mb-4 text-[#0d1b2a]">
                    Política de <span class="text-[#2b6df2]">Privacidad</span>
                </h1>
                <p class="text-[#888] font-medium mb-6 flex items-center gap-2">
                    <span class="w-2 h-2 bg-[#2b6df2] rounded-full"></span>
                    Última actualización: 19 de junio de 2026
                </p>
                <p class="text-[#444] leading-relaxed">
                    La presente Política de Privacidad regula el tratamiento de datos personales e institucionales recopilados por <strong>UWorkFlow</strong>, plataforma digital destinada a la gestión, publicación y postulación de pasantías académicas y profesionales en Bolivia. Esta política es vinculante para todos los usuarios — <span class="tag tag-blue">Estudiantes</span> y <span class="tag tag-green">Empresas</span> — desde el momento de su registro. Al utilizar UWorkFlow, el usuario declara haber leído y aceptado íntegramente los términos aquí establecidos.
                </p>
            </div>

            <!-- 1. Recolección -->
            <div id="recoleccion" class="scroll-mt-32 bg-white p-8 md:p-12 rounded-3xl border border-gray-100 shadow-sm">
                <h2 class="text-2xl font-bold mb-4 text-[#1a1a1a]">1. Recolección de Datos</h2>
                <p class="text-[#444] mb-6">UWorkFlow recopila distintos tipos de información según el rol del usuario dentro de la plataforma:</p>

                <div class="role-grid">
                    <div class="role-card student">
                        <h3><i data-lucide="graduation-cap" style="width:15px;height:15px;"></i> Estudiante</h3>
                        <ul>
                            <li>Nombre completo y CI/DNI</li>
                            <li>Correo electrónico institucional</li>
                            <li>Universidad y carrera</li>
                            <li>Historial académico (CV)</li>
                            <li>Habilidades y certificaciones</li>
                            <li>Fotografía de perfil (opcional)</li>
                            <li>Historial de postulaciones</li>
                        </ul>
                    </div>
                    <div class="role-card company">
                        <h3><i data-lucide="building-2" style="width:15px;height:15px;"></i> Empresa</h3>
                        <ul>
                            <li>Razón social y NIT</li>
                            <li>Correo corporativo y teléfono</li>
                            <li>Rubro y descripción institucional</li>
                            <li>Nombre del representante legal</li>
                            <li>Ofertas de pasantía publicadas</li>
                            <li>Historial de selecciones</li>
                            <li>Documentos de verificación</li>
                        </ul>
                    </div>
                </div>

                <div class="info-box">
                    <strong>Datos técnicos automáticos:</strong> Adicionalmente recopilamos dirección IP, tipo de dispositivo y navegador, páginas visitadas, tiempos de sesión y geolocalización aproximada con fines de seguridad y análisis de uso.
                </div>
            </div>

            <!-- 2. Uso -->
            <div id="uso" class="scroll-mt-32 bg-white p-8 md:p-12 rounded-3xl border border-gray-100 shadow-sm">
                <h2 class="text-2xl font-bold mb-4 text-[#1a1a1a]">2. Uso de la Información</h2>
                <p class="text-[#444] mb-4">Los datos recopilados son utilizados exclusivamente para los siguientes fines:</p>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Finalidad</th>
                            <th>Aplica a</th>
                            <th>Base legal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Gestión del proceso de postulación a pasantías</td>
                            <td><span class="tag tag-blue">Estudiante</span> <span class="tag tag-green">Empresa</span></td>
                            <td>Consentimiento</td>
                        </tr>
                        <tr>
                            <td>Algoritmo de matching entre perfil y oferta</td>
                            <td><span class="tag tag-blue">Estudiante</span></td>
                            <td>Interés legítimo</td>
                        </tr>
                        <tr>
                            <td>Notificaciones sobre el estado de solicitudes</td>
                            <td><span class="tag tag-blue">Estudiante</span> <span class="tag tag-green">Empresa</span></td>
                            <td>Consentimiento</td>
                        </tr>
                        <tr>
                            <td>Verificación de identidad y autenticidad</td>
                            <td><span class="tag tag-blue">Estudiante</span> <span class="tag tag-green">Empresa</span></td>
                            <td>Obligación legal</td>
                        </tr>
                        <tr>
                            <td>Análisis estadístico y mejora del servicio</td>
                            <td>Ambos</td>
                            <td>Interés legítimo</td>
                        </tr>
                        <tr>
                            <td>Prevención de fraude y conductas indebidas</td>
                            <td>Ambos</td>
                            <td>Obligación legal</td>
                        </tr>
                        <tr>
                            <td>Cumplimiento de requerimientos legales o judiciales</td>
                            <td>Ambos</td>
                            <td>Mandato legal</td>
                        </tr>
                    </tbody>
                </table>

                <p class="text-[#444] mt-4">UWorkFlow <strong>no venderá, arrendará ni cederá</strong> datos personales a terceros con fines comerciales o publicitarios bajo ninguna circunstancia.</p>
            </div>

            <!-- 3. Responsabilidades -->
            <div id="responsabilidades" class="scroll-mt-32 bg-white p-8 md:p-12 rounded-3xl border border-gray-100 shadow-sm">
                <h2 class="text-2xl font-bold mb-4 text-[#1a1a1a]">3. Responsabilidades por Rol de Usuario</h2>
                <p class="text-[#444] mb-4">Cada tipo de usuario asume obligaciones específicas en cuanto al uso ético y legal de la plataforma:</p>

                <div class="role-grid">
                    <div class="role-card student">
                        <h3><i data-lucide="graduation-cap" style="width:15px;height:15px;"></i> Obligaciones del Estudiante</h3>
                        <ul>
                            <li>Proveer información verídica en su perfil y CV</li>
                            <li>No suplantar la identidad de terceros</li>
                            <li>No postular con documentos falsos o alterados</li>
                            <li>Respetar la confidencialidad de la información empresarial</li>
                            <li>No compartir credenciales de acceso</li>
                            <li>Notificar cambios en su situación académica</li>
                        </ul>
                    </div>
                    <div class="role-card company">
                        <h3><i data-lucide="building-2" style="width:15px;height:15px;"></i> Obligaciones de la Empresa</h3>
                        <ul>
                            <li>Publicar ofertas de pasantía verídicas y vigentes</li>
                            <li>No usar datos de estudiantes para fines ajenos al proceso</li>
                            <li>Tratar perfiles con criterios no discriminatorios</li>
                            <li>Garantizar condiciones laborales conforme a ley</li>
                            <li>No contactar candidatos fuera de la plataforma sin consentimiento</li>
                            <li>Eliminar datos de candidatos no seleccionados a solicitud</li>
                        </ul>
                    </div>
                </div>

                <div class="legal-box">
                    <h3><i data-lucide="alert-octagon" style="width:16px;height:16px;"></i> Conductas Prohibidas</h3>
                    <p class="text-sm text-red-900 mb-3">Está estrictamente prohibido para <strong>ambos tipos de usuario</strong>:</p>
                    <ul class="policy-list">
                        <li><span class="bullet bullet-red"></span>Publicar, distribuir o almacenar información falsa, engañosa o fraudulenta.</li>
                        <li><span class="bullet bullet-red"></span>Acceder a cuentas ajenas sin autorización.</li>
                        <li><span class="bullet bullet-red"></span>Realizar scraping, extracción masiva de datos o ingeniería inversa sobre la plataforma.</li>
                        <li><span class="bullet bullet-red"></span>Usar la plataforma para fines de acoso, discriminación o amenaza hacia otros usuarios.</li>
                        <li><span class="bullet bullet-red"></span>Intentar vulnerar los sistemas de seguridad de UWorkFlow.</li>
                        <li><span class="bullet bullet-red"></span>Comercializar o transferir datos obtenidos de la plataforma a terceros.</li>
                    </ul>
                </div>
            </div>

            <!-- 4. Protección -->
            <div id="proteccion" class="scroll-mt-32 bg-white p-8 md:p-12 rounded-3xl border border-gray-100 shadow-sm">
                <h2 class="text-2xl font-bold mb-4 text-[#1a1a1a]">4. Protección de Datos</h2>
                <p class="text-[#444] mb-4">UWorkFlow implementa medidas técnicas y organizativas de seguridad conforme a estándares internacionales:</p>

                <ul class="policy-list">
                    <li><span class="bullet"></span><div><strong>Cifrado TLS/HTTPS:</strong> Toda comunicación entre el navegador y los servidores está encriptada mediante protocolos de seguridad de capa de transporte.</div></li>
                    <li><span class="bullet"></span><div><strong>Hash de contraseñas:</strong> Las contraseñas nunca se almacenan en texto plano; se utiliza hashing con algoritmo bcrypt.</div></li>
                    <li><span class="bullet"></span><div><strong>Control de acceso por roles:</strong> Los datos de cada usuario solo son accesibles por el propio usuario y personal autorizado de UWorkFlow.</div></li>
                    <li><span class="bullet"></span><div><strong>Auditoría y logs:</strong> Registramos accesos y modificaciones a datos sensibles para detectar actividades sospechosas.</div></li>
                    <li><span class="bullet"></span><div><strong>Servidores seguros:</strong> Los datos se almacenan en infraestructura certificada con copias de respaldo periódicas.</div></li>
                    <li><span class="bullet"></span><div><strong>Autenticación de dos factores (2FA):</strong> Disponible y recomendada para cuentas corporativas.</div></li>
                </ul>

                <div class="info-box mt-4">
                    En caso de detectarse una brecha de seguridad, UWorkFlow notificará a los usuarios afectados y a las autoridades competentes dentro de las <strong>72 horas</strong> siguientes al conocimiento del incidente.
                </div>
            </div>

            <!-- 5. Derechos -->
            <div id="derechos" class="scroll-mt-32 bg-white p-8 md:p-12 rounded-3xl border border-gray-100 shadow-sm">
                <h2 class="text-2xl font-bold mb-4 text-[#1a1a1a]">5. Derechos del Usuario</h2>
                <p class="text-[#444] mb-4">Todo usuario registrado tiene los siguientes derechos sobre sus datos personales:</p>

                <ul class="policy-list">
                    <li><span class="bullet"></span><div><strong>Acceso:</strong> Solicitar una copia de los datos personales almacenados en cualquier momento.</div></li>
                    <li><span class="bullet"></span><div><strong>Rectificación:</strong> Corregir datos inexactos o incompletos desde el perfil o mediante solicitud formal.</div></li>
                    <li><span class="bullet"></span><div><strong>Supresión ("derecho al olvido"):</strong> Solicitar la eliminación de datos cuando ya no sean necesarios o se retire el consentimiento.</div></li>
                    <li><span class="bullet"></span><div><strong>Oposición:</strong> Oponerse al tratamiento de datos para fines de análisis o estadística.</div></li>
                    <li><span class="bullet"></span><div><strong>Portabilidad:</strong> Recibir sus datos en formato estructurado y de uso común (JSON, CSV).</div></li>
                    <li><span class="bullet"></span><div><strong>Revisión humana:</strong> Solicitar revisión humana cuando una decisión relevante sea tomada exclusivamente por algoritmos.</div></li>
                </ul>

                <p class="text-[#444] mt-4">Para ejercer cualquiera de estos derechos, envíe una solicitud escrita a <strong>privacidad@uworkflow.bo</strong> adjuntando documento de identidad vigente. Plazo de respuesta: <strong>15 días hábiles</strong>.</p>
            </div>

            <!-- 6. Cookies -->
            <div id="cookies" class="scroll-mt-32 bg-white p-8 md:p-12 rounded-3xl border border-gray-100 shadow-sm">
                <h2 class="text-2xl font-bold mb-4 text-[#1a1a1a]">6. Cookies y Tecnologías de Rastreo</h2>
                <p class="text-[#444] mb-4">UWorkFlow utiliza cookies y tecnologías similares para mejorar la experiencia de usuario y analizar el tráfico. Se emplean los siguientes tipos:</p>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Finalidad</th>
                            <th>Duración</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Esenciales</strong></td>
                            <td>Mantener sesión activa y funcionalidades básicas</td>
                            <td>Sesión</td>
                        </tr>
                        <tr>
                            <td><strong>Analíticas</strong></td>
                            <td>Estadísticas de uso y rendimiento</td>
                            <td>12 meses</td>
                        </tr>
                        <tr>
                            <td><strong>Funcionales</strong></td>
                            <td>Recordar preferencias del usuario</td>
                            <td>6 meses</td>
                        </tr>
                        <tr>
                            <td><strong>De seguridad</strong></td>
                            <td>Detectar actividad fraudulenta o inusual</td>
                            <td>30 días</td>
                        </tr>
                    </tbody>
                </table>

                <p class="text-[#444] mt-4">Puedes gestionar o deshabilitar las cookies no esenciales desde la configuración de tu navegador o desde el panel de preferencias de UWorkFlow. La desactivación de cookies esenciales puede afectar el correcto funcionamiento de la plataforma.</p>
            </div>

            <!-- 7. Terceros -->
            <div id="terceros" class="scroll-mt-32 bg-white p-8 md:p-12 rounded-3xl border border-gray-100 shadow-sm">
                <h2 class="text-2xl font-bold mb-4 text-[#1a1a1a]">7. Compartición con Terceros</h2>
                <p class="text-[#444] mb-4">UWorkFlow podrá compartir datos con terceros únicamente en las siguientes circunstancias:</p>

                <ul class="policy-list">
                    <li><span class="bullet"></span><div><strong>Proveedores de infraestructura:</strong> Servicios de alojamiento en la nube que procesan datos bajo acuerdos de confidencialidad estrictos.</div></li>
                    <li><span class="bullet"></span><div><strong>Autoridades competentes:</strong> Cuando exista orden judicial, requerimiento fiscal o mandato legal que obligue a revelar información.</div></li>
                    <li><span class="bullet"></span><div><strong>Universidades aliadas:</strong> Con consentimiento expreso del estudiante, para validar estado académico o avalar prácticas.</div></li>
                    <li><span class="bullet"></span><div><strong>Herramientas de análisis:</strong> Plataformas como Google Analytics, utilizadas con datos anonimizados y sin identificación personal.</div></li>
                </ul>

                <p class="text-[#444] mt-4">En ningún caso se compartirán datos con fines de marketing, publicidad o venta a terceros.</p>
            </div>

            <!-- 8. Retención -->
            <div id="retencion" class="scroll-mt-32 bg-white p-8 md:p-12 rounded-3xl border border-gray-100 shadow-sm">
                <h2 class="text-2xl font-bold mb-4 text-[#1a1a1a]">8. Retención y Eliminación de Datos</h2>
                <p class="text-[#444] mb-4">Los datos personales serán conservados únicamente durante el tiempo necesario para cumplir con los fines para los que fueron recopilados:</p>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Tipo de dato</th>
                            <th>Plazo de retención</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Datos de cuenta activa</td>
                            <td>Durante la vigencia de la cuenta</td>
                        </tr>
                        <tr>
                            <td>Historial de postulaciones</td>
                            <td>3 años desde la postulación</td>
                        </tr>
                        <tr>
                            <td>Datos de empresa verificada</td>
                            <td>5 años desde el último contrato activo</td>
                        </tr>
                        <tr>
                            <td>Logs de seguridad</td>
                            <td>12 meses</td>
                        </tr>
                        <tr>
                            <td>Datos de cuentas eliminadas</td>
                            <td>30 días (período de recuperación)</td>
                        </tr>
                        <tr>
                            <td>Información requerida por ley</td>
                            <td>Según mandato legal aplicable</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- 9. Menores -->
            <div id="menores" class="scroll-mt-32 bg-white p-8 md:p-12 rounded-3xl border border-gray-100 shadow-sm">
                <h2 class="text-2xl font-bold mb-4 text-[#1a1a1a]">9. Menores de Edad</h2>
                <p class="text-[#444] mb-4">UWorkFlow está diseñada exclusivamente para usuarios mayores de <strong>18 años</strong>. No recopilamos intencionalmente datos de menores de edad.</p>
                <p class="text-[#444] mb-4">En el caso excepcional de estudiantes entre 16 y 18 años que participen en programas de pasantía con aval institucional, se requerirá el <strong>consentimiento expreso del tutor legal</strong> y de la universidad, conforme al <span class="article-ref">Art. 5 del Código Niña, Niño y Adolescente (Ley 548)</span>.</p>
                <p class="text-[#444]">Si detectamos que un menor se ha registrado sin autorización, procederemos a eliminar su cuenta y datos de forma inmediata.</p>
            </div>

            <!-- 10. Sanciones -->
            <div id="sanciones" class="scroll-mt-32 bg-white p-8 md:p-12 rounded-3xl border border-gray-100 shadow-sm">
                <h2 class="text-2xl font-bold mb-4 text-[#1a1a1a]">10. Infracciones, Sanciones y Marco Legal</h2>
                <p class="text-[#444] mb-6">El mal uso de la plataforma UWorkFlow puede constituir una infracción administrativa o delito penal conforme a la legislación boliviana vigente.</p>

                <div class="legal-box">
                    <h3><i data-lucide="shield-off" style="width:16px;height:16px;"></i> Sanciones dentro de la Plataforma</h3>
                    <p class="text-sm text-red-900 mb-3">Ante cualquier violación de esta política, UWorkFlow podrá aplicar las siguientes medidas de forma unilateral:</p>
                    <ul class="policy-list">
                        <li><span class="bullet bullet-red"></span>Advertencia formal por mensaje interno.</li>
                        <li><span class="bullet bullet-red"></span>Suspensión temporal o permanente de la cuenta.</li>
                        <li><span class="bullet bullet-red"></span>Eliminación de publicaciones o postulaciones asociadas.</li>
                        <li><span class="bullet bullet-red"></span>Bloqueo de acceso a futuras cuentas con la misma identidad.</li>
                        <li><span class="bullet bullet-red"></span>Reporte a las autoridades competentes cuando corresponda.</li>
                    </ul>
                </div>

                <div class="legal-box mt-6">
                    <h3><i data-lucide="gavel" style="width:16px;height:16px;"></i> Marco Legal Boliviano Aplicable</h3>
                    <p class="text-sm text-red-900 mb-4">Según la naturaleza de la infracción, el usuario podrá estar sujeto a las siguientes disposiciones:</p>

                    <ul class="policy-list">
                        <li>
                            <span class="bullet bullet-red"></span>
                            <div class="text-sm text-red-900">
                                <strong>Falsedad de datos e identidad:</strong> La presentación de documentos falsos, suplantación de identidad o información fraudulenta puede constituir el delito de falsedad material o ideológica, tipificado en los <span class="article-ref">Arts. 198 y 199 del Código Penal Boliviano</span>, sancionado con privación de libertad de 1 a 6 años.
                            </div>
                        </li>
                        <li>
                            <span class="bullet bullet-red"></span>
                            <div class="text-sm text-red-900">
                                <strong>Acceso no autorizado a sistemas informáticos:</strong> El acceso indebido a cuentas o sistemas ajenos está tipificado como delito informático en la <span class="article-ref">Ley N° 164 (Ley General de Telecomunicaciones, TIC y Postal)</span>, con penas de hasta 5 años de privación de libertad.
                            </div>
                        </li>
                        <li>
                            <span class="bullet bullet-red"></span>
                            <div class="text-sm text-red-900">
                                <strong>Uso indebido de datos personales:</strong> La divulgación o uso no autorizado de datos personales de terceros puede ser perseguida conforme a la <span class="article-ref">Ley N° 164</span> y el <span class="article-ref">Art. 21 de la Constitución Política del Estado</span>, que garantiza el derecho a la privacidad e inviolabilidad de datos personales.
                            </div>
                        </li>
                        <li>
                            <span class="bullet bullet-red"></span>
                            <div class="text-sm text-red-900">
                                <strong>Fraude y estafa:</strong> La publicación de ofertas ficticias u obtención de beneficios mediante engaño puede constituir el delito de estafa regulado en el <span class="article-ref">Art. 335 del Código Penal Boliviano</span>, sancionado con 1 a 5 años de privación de libertad.
                            </div>
                        </li>
                        <li>
                            <span class="bullet bullet-red"></span>
                            <div class="text-sm text-red-900">
                                <strong>Discriminación:</strong> El rechazo de postulantes por razones de género, etnia, religión o discapacidad contraviene la <span class="article-ref">Ley N° 045 Contra el Racismo y Toda Forma de Discriminación</span>, con sanciones penales de hasta 5 años de reclusión.
                            </div>
                        </li>
                        <li>
                            <span class="bullet bullet-red"></span>
                            <div class="text-sm text-red-900">
                                <strong>Acoso digital:</strong> Conductas de hostigamiento o intimidación a través de la plataforma pueden ser perseguidas conforme al <span class="article-ref">Art. 312 bis del Código Penal Boliviano</span> y la <span class="article-ref">Ley N° 348 (Ley Integral para Garantizar a las Mujeres una Vida Libre de Violencia)</span>.
                            </div>
                        </li>
                        <li>
                            <span class="bullet bullet-red"></span>
                            <div class="text-sm text-red-900">
                                <strong>Daño informático y sabotaje:</strong> Cualquier acto destinado a interrumpir, dañar o destruir sistemas o datos de UWorkFlow constituye daño informático perseguible conforme a la <span class="article-ref">Ley N° 164</span>, con penas de reclusión y reparación civil de daños.
                            </div>
                        </li>
                        <li>
                            <span class="bullet bullet-red"></span>
                            <div class="text-sm text-red-900">
                                <strong>Trabajo infantil encubierto:</strong> La contratación de menores bajo la figura de pasantía sin cumplir los requisitos del <span class="article-ref">Código Niña, Niño y Adolescente (Ley 548)</span> puede configurar una infracción grave sancionada por el Ministerio de Trabajo.
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="info-box mt-6">
                    <strong>Nota:</strong> UWorkFlow cooperará plenamente con las autoridades judiciales y administrativas bolivianas en cualquier investigación que involucre el uso indebido de la plataforma, incluyendo la entrega de registros, logs de acceso e información de usuarios ante requerimiento legal formal.
                </div>
            </div>

            <!-- 11. Contacto -->
            <div id="contacto" class="scroll-mt-32 bg-white p-8 md:p-12 rounded-3xl border border-gray-100 shadow-sm">
                <h2 class="text-2xl font-bold mb-4 text-[#1a1a1a]">11. Contacto y Consultas</h2>
                <p class="text-[#444] mb-4">Para dudas, reclamos, solicitud de derechos o reporte de incidentes relacionados con esta política:</p>

                <ul class="policy-list">
                    <li><span class="bullet"></span><div><strong>Correo de privacidad:</strong> privacidad@uworkflow.bo</div></li>
                    <li><span class="bullet"></span><div><strong>Soporte general:</strong> soporte@uworkflow.bo</div></li>
                    <li><span class="bullet"></span><div><strong>Reportes de seguridad:</strong> seguridad@uworkflow.bo</div></li>
                    <li><span class="bullet"></span><div><strong>Dirección:</strong> La Paz, Bolivia</div></li>
                </ul>

                <p class="text-[#888] text-sm mt-6">
                    UWorkFlow se reserva el derecho de actualizar esta política. Cualquier modificación sustancial será notificada con al menos <strong>15 días de anticipación</strong> mediante correo electrónico y aviso en la plataforma. El uso continuado tras dicha notificación implicará la aceptación de los nuevos términos.
                </p>
            </div>

        </article>
    </main>

    @include('components.footer')

    <script>
        lucide.createIcons();
    </script>
</body>

</html>