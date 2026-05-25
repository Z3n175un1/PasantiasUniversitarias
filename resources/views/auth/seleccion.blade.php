<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Únete | UWorkFlow</title>
    <link rel="icon" href="{{ asset('uworkflow-logo.ico') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            letter-spacing: -0.02em;
        }

        .bg-soft {
            background-color: #fcfcfd;
        }

        .fade-in {
            animation: fadeIn 0.4s ease forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="bg-soft min-h-screen flex items-center justify-center px-4 py-12">

    <div class="w-full max-w-[800px] fade-in">

        <div class="flex justify-center mb-6">
            <a href="{{ url('/') }}"
                class="flex items-center gap-2 group text-gray-400 hover:text-black transition-colors text-xs font-bold uppercase tracking-wider">
                <i data-lucide="arrow-left" class="w-4 h-4 transition-transform group-hover:-translate-x-0.5"></i>
                Volver al inicio
            </a>
        </div>

        <div class="text-center mb-10">
            <div class="flex items-center justify-center gap-2 mb-4">
                <div class="w-10 h-10 bg-black rounded-xl flex items-center justify-center shadow-lg">
                    <i data-lucide="layers" class="text-white w-6 h-6"></i>
                </div>
                <span class="text-2xl font-bold tracking-tight text-black">UWorkFlow</span>
            </div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Bienvenido, ¿cómo deseas unirte?</h1>
            <p class="text-gray-500 text-sm mt-1">Selecciona tu perfil de usuario para configurar tu cuenta.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 px-4">

            {{-- Tarjeta: Estudiante --}}
            <a href="{{ route('registro', ['rol' => 'student']) }}"
                class="group text-left bg-white p-8 rounded-[2rem] border border-gray-200 shadow-[0_15px_30px_rgba(0,0,0,0.02)] hover:border-[#2b6df2] hover:shadow-[0_20px_40px_rgba(43,109,242,0.06)] transition-all duration-300 flex flex-col justify-between h-[260px]">
                <div
                    class="w-14 h-14 bg-blue-50 text-[#2b6df2] rounded-2xl flex items-center justify-center transition-colors group-hover:bg-[#2b6df2] group-hover:text-white duration-300">
                    <i data-lucide="graduation-cap" class="w-7 h-7"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-1 flex items-center gap-2">
                        Soy Estudiante
                        <i data-lucide="arrow-right"
                            class="w-4 h-4 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all text-[#2b6df2]"></i>
                    </h3>
                    <p class="text-sm text-gray-500 font-medium leading-relaxed">
                        Busco pasantías, convenios institucionales y mi primera experiencia laboral en Bolivia.
                    </p>
                </div>
            </a>

            {{-- Tarjeta: Empresa --}}
            <a href="{{ route('registro', ['rol' => 'company']) }}"
                class="group text-left bg-white p-8 rounded-[2rem] border border-gray-200 shadow-[0_15px_30px_rgba(0,0,0,0.02)] hover:border-[#2b6df2] hover:shadow-[0_20px_40px_rgba(43,109,242,0.06)] transition-all duration-300 flex flex-col justify-between h-[260px]">
                <div
                    class="w-14 h-14 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center transition-colors group-hover:bg-[#2b6df2] group-hover:text-white duration-300">
                    <i data-lucide="building-2" class="w-7 h-7"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-1 flex items-center gap-2">
                        Soy Empresa / Reclutador
                        <i data-lucide="arrow-right"
                            class="w-4 h-4 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all text-[#2b6df2]"></i>
                    </h3>
                    <p class="text-sm text-gray-500 font-medium leading-relaxed">
                        Quiero publicar vacantes, gestionar postulantes y firmar convenios con universidades.
                    </p>
                </div>
            </a>

        </div>
    </div>

    <script>lucide.createIcons();</script>

</body>

</html>