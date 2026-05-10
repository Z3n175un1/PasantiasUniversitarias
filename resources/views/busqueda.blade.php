<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name', 'UWorkFlow') }} - Busca tú pasantía</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <x-nav-bar />
    <main class="flex-1 flex items-center justify-center p-6">
        <div class="w-full max-w-lg">
            <!-- Brand -->
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-600 rounded-2xl shadow-xl shadow-blue-100 mb-4">
                    <i data-lucide="graduation-cap" class="text-white w-8 h-8"></i>
                </div>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Busca tú pasantía</h1>
                <p class="text-slate-500 mt-2">Únete a la red de pasantías universitarias</p>
            </div>
        </div>
    </main>
    
</body>
</html>