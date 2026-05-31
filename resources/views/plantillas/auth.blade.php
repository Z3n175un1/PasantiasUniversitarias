<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Registro') | UWorkFlow</title>

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

        .input-focus:focus {
            border-color: #2b6df2;
            box-shadow: 0 0 0 4px rgba(43, 109, 242, 0.1);
        }

        .error-input {
            border-color: #ef4444 !important;
            background-color: #fef2f2 !important;
        }

        .success-input {
            border-color: #10b981 !important;
            background-color: #f0fdf4 !important;
        }

        .success-input:focus {
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1) !important;
            border-color: #10b981 !important;
        }

        .req-item {
            transition: all 0.2s ease;
        }

        @stack('styles')
    </style>
</head>

<body class="bg-soft min-h-screen flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-2xl">
        {{-- Botón Volver --}}
        <div class="flex justify-center mb-6">
            <a href="{{ route('seleccion') }}"
                class="flex items-center gap-2 group text-gray-400 hover:text-black transition-colors text-xs font-bold uppercase tracking-wider">
                <i data-lucide="arrow-left" class="w-4 h-4 transition-transform group-hover:-translate-x-0.5"></i>
                Cambiar tipo de cuenta
            </a>
        </div>

        <section
            class="bg-white rounded-[2rem] border border-gray-200 shadow-[0_20px_50px_rgba(0,0,0,0.04)] overflow-hidden">
            <div class="p-8 md:p-12">
                @yield('content')
            </div>
        </section>
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
        });
    </script>
    @stack('scripts')
</body>

</html>