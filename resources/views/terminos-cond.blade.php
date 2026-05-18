<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Términos y Condiciones') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('uworkflow-logo.ico') }}">
    <style>
        body {
            font-family: 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
            line-height: 1.55;
            margin: 40px auto;
            max-width: auto;
            padding: 0 20px;
            color: #1e2a3a;
            background-color: #fafcfd;
        }
        h1, h2, h3 {
            color: #0b3b5f;
            margin-top: 1.8em;
        }
        h1 {
            border-bottom: 2px solid #2c7da0;
            padding-bottom: 10px;
            font-size: 2rem;
        }
        h2 {
            border-left: 5px solid #2c7da0;
            padding-left: 15px;
            margin-top: 2rem;
            font-size: 1.5rem;
        }
        p, li {
            text-align: justify;
        }
        .definition {
            background: #eef4f8;
            padding: 12px 20px;
            border-radius: 8px;
            margin: 20px 0;
            font-size: 0.95rem;
            border-left: 4px solid #1f7a8c;
        }
        .footer-note {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #cbd5e1;
            font-size: 0.85rem;
            color: #2c3e50;
            text-align: center;
        }
        ul, ol {
            margin-bottom: 1.2rem;
        }
        strong {
            color: #0f4c5f;
        }
        .highlight {
            background-color: #fef9e6;
            padding: 2px 4px;
            border-radius: 4px;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 min-h-screen w-screen">
    <x-nav-bar />
    <main class="flex-1 flex flex-col py-12 px-48">
        <h1 class="font-bold text-3xl mb-8">Términos y Condiciones de Uso</h1>
        <p><strong>Vigencia:</strong> 20 de abril de 2026<br>
        <strong>Plataforma:</strong> Sistema de Gestión de Oportunidades de Pasantías (en adelante, “UWorkFlow”)<br>

        <p>Los presentes <strong>Términos y Condiciones</strong> (en adelante, “TyC”) regulan el acceso, navegación y utilización de la Plataforma, así como los servicios de intermediación, difusión y gestión de vacantes de pasantías ofrecidas a estudiantes, egresados y empresas colaboradoras dentro del territorio del <strong>Estado Plurinacional de Bolivia</strong>. Al registrarse, acceder o utilizar cualquier funcionalidad de la Plataforma, el Usuario manifiesta su aceptación expresa, plena e incondicional de todas las cláusulas contenidas en este documento. Si el Usuario no está conforme con algún término, deberá abstenerse de utilizar la Plataforma.</p>

        <div class="definition">
        <strong>Definiciones clave (interpretación uniforme):</strong><br>
        - <strong>Plataforma:</strong> Sitio web y/o aplicación digital operada para conectar postulantes con empresas anfitrionas de pasantías.<br>
        - <strong>Usuario:</strong> Toda persona natural o jurídica (incluyendo empresas, instituciones, estudiantes, egresados) que acceda, se registre o haga uso de la Plataforma.<br>
        - <strong>Postulante:</strong> Usuario que busca una pasantía, sea estudiante o profesional en formación.<br>
        - <strong>Empresa Participante:</strong> Persona jurídica o unidad productiva debidamente verificada que ofrece plazas de pasantía.<br>
        - <strong>Datos personales:</strong> Cualquier información concerniente a una persona física identificada o identificable (Ley N° 1640, Ley de Protección de Datos Personales de Bolivia).<br>
        - <strong>Leyes aplicables:</strong> Constitución Política del Estado, Código Penal, Ley N° 1640 (Protección de Datos Personales), Ley N° 145 (Ley de Lucha contra el Ciberdelito y Delitos Informáticos), y demás normativa vigente en Bolivia.
        </div>

        <h2>1. Objeto y alcance territorial</h2>
        <p><strong>1.1.</strong> La Plataforma tiene por objeto facilitar el encuentro entre Postulantes y Empresas Participantes para el desarrollo de pasantías formativas o laborales, exclusivamente dentro del territorio boliviano. Cualquier uso fuera del país o pretendiendo elusión de jurisdicción boliviana constituye una violación material de los TyC.</p>
        <p><strong>1.2.</strong> El operador de la Plataforma actúa únicamente como <strong>intermediario tecnológico</strong> y no es parte de la relación laboral, académica o contractual que pueda surgir entre Postulante y Empresa Participante. En consecuencia, no se responsabiliza por el contenido de las ofertas, la idoneidad de los pasantes, ni por el cumplimiento de obligaciones laborales o de seguridad social.</p>

        <h2>2. Registro, veracidad de la información y capacidad legal</h2>
        <p><strong>2.1.</strong> Para acceder a funcionalidades restringidas, el Usuario deberá registrarse proporcionando información verdadera, exacta, actualizada y completa. El suministro de datos falsos o la suplantación de identidad constituye causal de suspensión inmediata y acciones legales por falsedad ideológica o material, conforme al Código Penal boliviano (arts. 198 y ss.).</p>
        <p><strong>2.2.</strong> Los Postulantes declaran tener capacidad legal suficiente para obligarse (mayores de 18 años o menores emancipados; en caso de menores de edad, deberán contar con autorización expresa de sus representantes legales). Las Empresas Participantes deberán estar legalmente constituidas y registradas en el sistema tributario boliviano.</p>
        <p><strong>2.3.</strong> La Plataforma se reserva el derecho de verificar la identidad y antecedentes de los Usuarios, así como rechazar solicitudes de registro que no cumplan con estándares mínimos de confiabilidad.</p>

        <h2>3. Privacidad y tratamiento de datos personales (Ley N° 1640)</h2>
        <p><strong>3.1.</strong> Todos los datos personales recolectados serán tratados conforme a los principios de licitud, finalidad, proporcionalidad y confidencialidad establecidos en la <strong>Ley N° 1640 de Protección de Datos Personales</strong> y su Decreto Supremo Reglamentario. El responsable del tratamiento es el operador de la Plataforma, quien ha implementado medidas técnicas, administrativas y organizativas para garantizar la seguridad de los datos.</p>
        <p><strong>3.2.</strong> La información será utilizada exclusivamente para: (i) gestión de postulaciones y procesos de selección; (ii) comunicación de oportunidades; (iii) cumplimiento de obligaciones legales; (iv) mejora del servicio. No se cederán datos a terceros no autorizados, salvo mandato judicial o consentimiento explícito del titular.</p>
        <p><strong>3.3.</strong> El Usuario titular de los datos podrá ejercer los derechos de acceso, rectificación, cancelación y oposición (ARCO) mediante solicitud escrita al correo [privacy@plataformapasantias.bo].</p>

        <h2>4. Confidencialidad y seguridad de la información</h2>
        <p><strong>4.1.</strong> La Plataforma adopta estándares de cifrado, controles de acceso, auditorías periódicas y políticas de backup para resguardar la integridad y confidencialidad de la información almacenada. No obstante, ningún sistema es completamente infalible; el Usuario reconoce que las comunicaciones por Internet pueden tener riesgos residuales.</p>
        <p><strong>4.2.</strong> Toda información marcada como “confidencial” o que por su naturaleza lo sea (ej. evaluaciones psicotécnicas, datos de salud, referencias laborales) recibirá un tratamiento de alto nivel de protección. El Usuario se obliga a no divulgar credenciales de acceso a terceros, siendo responsable exclusivo de las acciones realizadas desde su cuenta.</p>

        <h2>5. Verificación y limitación de responsabilidad por empresas participantes</h2>
        <p><strong>5.1.</strong> La Plataforma realiza un proceso de verificación documental preliminar de las Empresas Participantes (NIT, constitución legal, representante legal). Dicha verificación no implica una garantía absoluta de solvencia moral, financiera o legal de la empresa. El Postulante asume la responsabilidad de realizar sus propias diligencias antes de aceptar cualquier pasantía.</p>
        <p><strong>5.2.</strong> El operador no será responsable por incumplimientos laborales, accidentes, acoso, discriminación o cualquier otra controversia que surja directamente entre Postulante y Empresa Participante. En estos casos, las partes deberán acudir a la vía conciliatoria o judicial correspondiente (Ministerio de Trabajo, Juzgados Laborales, etc.).</p>

        <h2>6. Obligaciones del usuario y uso adecuado</h2>
        <p><strong>6.1.</strong> El Usuario se compromete a:</p>
        <ul>
        <li>Utilizar la Plataforma de buena fe, respetando la normativa boliviana, la moral y el orden público.</li>
        <li>No publicar contenido falso, difamatorio, discriminatorio, violento o que vulnere derechos de propiedad intelectual de terceros.</li>
        <li>No realizar actividades que sobrecarguen, interfieran o dañen los sistemas informáticos de la Plataforma.</li>
        <li>No recolectar datos de otros usuarios con fines maliciosos (spam, phishing, estafa).</li>
        </ul>
        <p><strong>6.2.</strong> Queda expresamente prohibido el uso de robots, spiders o scraping sin autorización previa por escrito del operador. Cualquier extracción masiva de información será considerada un ataque a la seguridad.</p>

        <h2>7. Incumplimiento y régimen sancionatorio</h2>
        <p><strong>7.1.</strong> El incumplimiento de cualquiera de las disposiciones de los TyC dará lugar a acciones progresivas: (a) advertencia; (b) suspensión temporal de la cuenta; (c) cancelación definitiva y bloqueo de acceso; (d) remisión de antecedentes a las autoridades competentes (Fiscalía General del Estado, Viceministerio de Transparencia, etc.) cuando el hecho pueda constituir delito.</p>
        <p><strong>7.2.</strong> Las sanciones se aplicarán sin perjuicio de las acciones civiles o penales que correspondan conforme al ordenamiento jurídico boliviano.</p>

        <h2>8. Seguridad informática, hacking y delitos electrónicos</h2>
        <p><strong>8.1.</strong> Cualquier intento de acceso no autorizado a sistemas, vulneración de medidas de seguridad, introducción de malware, ataques de denegación de servicio (DDoS), ingeniería social, o cualquier conducta tipificada en la <strong>Ley N° 145 “Ley de Lucha contra el Ciberdelito y Delitos Informáticos”</strong> (arts. 363 a 379) será denunciado penalmente ante la Fiscalía Especializada en Ciberdelincuencia. Las sanciones pueden incluir penas privativas de libertad de 2 a 10 años según la gravedad.</p>
        <p><strong>8.2.</strong> La Plataforma mantiene sistemas de monitoreo y registros de logs de accesos para facilitar la investigación forense en caso de incidentes de seguridad.</p>

        <h2>9. Piratería, reproducción ilícita y propiedad intelectual</h2>
        <p><strong>9.1.</strong> Todos los contenidos de la Plataforma (código fuente, diseño, bases de datos, textos, gráficos, marcas, logotipos) son propiedad del operador o de sus licenciantes, protegidos por la Ley N° 1322 de Derecho de Autor y tratados internacionales. Queda terminantemente prohibida la reproducción, distribución, comunicación pública o transformación no autorizada.</p>
        <p><strong>9.2.</strong> La extracción o reutilización sistemática de partes sustanciales de la base de datos de pasantías sin consentimiento expreso constituye un acto de competencia desleal y delito informático, pasible de sanciones civiles y penales (multas de hasta 200.000 UFV´s, según la gravedad).</p>

        <h2>10. Limitación de responsabilidad y exclusión de garantías</h2>
        <p><strong>10.1.</strong> La Plataforma se proporciona “en el estado en que se encuentra” (“AS IS”). El operador no garantiza la disponibilidad ininterrumpida, ausencia de errores, ni la total seguridad frente a ataques externos. Se realizarán esfuerzos comercialmente razonables para mantener el servicio, pero no responde por interrupciones derivadas de mantenimiento, fuerza mayor, ciberataques o decisiones gubernamentales.</p>
        <p><strong>10.2.</strong> En ningún caso el operador será responsable por daños indirectos, pérdida de ganancias, daño moral o lucro cesante derivado del uso o imposibilidad de uso de la Plataforma, salvo dolo o culpa grave debidamente acreditada ante tribunal competente.</p>

        <h2>11. Modificaciones de los Términos y Condiciones</h2>
        <p><strong>11.1.</strong> El operador se reserva el derecho de actualizar o modificar los TyC en cualquier momento. Las modificaciones serán publicadas en esta misma URL con indicación de la fecha de vigencia. Se considerará que el Usuario acepta los cambios si continúa utilizando la Plataforma después de 10 días hábiles desde la publicación. En caso de cambios sustanciales (tratamiento de datos, responsabilidades), se enviará una notificación al correo registrado.</p>

        <h2>12. Legislación aplicable y jurisdicción</h2>
        <p><strong>12.1.</strong> Los presentes TyC se rigen e interpretan conforme a las leyes del <strong>Estado Plurinacional de Bolivia</strong>, con exclusión de principios de conflicto de leyes.</p>
        <p><strong>12.2.</strong> Cualquier controversia, disputa o reclamación derivada de estos TyC o del uso de la Plataforma será sometida a la jurisdicción de los tribunales ordinarios de la ciudad de <strong>La Paz, Bolivia</strong>, renunciando las partes a cualquier otro fuero que pudiera corresponderles (incluyendo fueros extranjeros).</p>
        <p><strong>12.3.</strong> No obstante lo anterior, para reclamaciones de cuantía menor (hasta 10.000 UFV) se podrá acudir a mecanismos de conciliación extrajudicial ante el Centro de Conciliación y Arbitraje de la Cámara de Comercio de La Paz, siempre que ambas partes lo acuerden.</p>

        <h2>13. Nulidad parcial y subsistencia</h2>
        <p>Si alguna cláusula de estos TyC fuese declarada nula o inaplicable por autoridad competente, las restantes permanecerán en pleno vigor y efecto, interpretándose en la forma más beneficiosa para el cumplimiento de su objeto.</p>

        <h2>14. Aceptación expresa y declaración final</h2>
        <p>El uso continuado de la Plataforma después del registro o del primer acceso implica la aceptación plena, voluntaria e irrevocable de todas las disposiciones contenidas en este instrumento legal. Se recomienda al Usuario imprimir o conservar una copia digital para su referencia.</p>

        <p><strong>Para consultas o notificaciones judiciales/extrajudiciales:</strong><br>
        Correo electrónico: 
        uworkflow@contacto.com.bo<br>
        </p>

        <div class="footer-note">
            © 2026 Plataforma de Pasantías Bolivia — Todos los derechos reservados.<br>
        </div>
    </main>
</body>
</html>