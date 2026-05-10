<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InternConnect - Student Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @if(session('success'))
        <div class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-bounce">
            {{ session('success') }}
        </div>
    @endif
    @if(session('info'))
        <div class="fixed top-4 right-4 bg-blue-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            {{ session('info') }}
        </div>
    @endif
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-gray-200 flex flex-col justify-between py-6 px-4">
            <div class="sidebar-top">
                <div class="flex items-center gap-2 font-bold text-lg mb-10">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                    <span>InternConnect</span>
                </div>
                <nav class="flex flex-col gap-1">
                    <a href="{{ Route::has('student.dashboard') ? route('student.dashboard') : '#' }}" class="flex items-center gap-3 py-2.5 px-3 text-sm font-medium text-gray-500 rounded-lg transition-colors hover:bg-gray-100 active:bg-blue-50 active:text-blue-600">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                        Dashboard
                    </a>
                    <a href="{{ Route::has('student.search') ? route('student.search') : '#' }}" class="flex items-center gap-3 py-2.5 px-3 text-sm font-medium text-gray-500 rounded-lg transition-colors hover:bg-gray-100">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        Search Internships
                    </a>
                    <a href="{{ Route::has('student.applications') ? route('student.applications') : '#' }}" class="flex items-center gap-3 py-2.5 px-3 text-sm font-medium text-gray-500 rounded-lg transition-colors hover:bg-gray-100">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                        My Applications
                    </a>
                    <a href="{{ Route::has('student.profile') ? route('student.profile') : '#' }}" class="flex items-center gap-3 py-2.5 px-3 text-sm font-medium text-gray-500 rounded-lg transition-colors hover:bg-gray-100">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        Profile
                    </a>
                </nav>
            </div>
            <div class="border-t border-gray-200 pt-5">
                <div class="user-pill">
                    <strong class="block text-sm">{{ Auth::user()->nombre }} {{ $student->apellidos ?? '' }}</strong>
                    <span class="text-xs text-gray-500">Estudiante</span>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full py-2.5 border border-gray-200 bg-white rounded-lg flex items-center justify-center gap-2 cursor-pointer font-medium">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto py-10 px-16">
            <header class="header">
                <h1 class="text-3xl mb-2">¡Bienvenido de vuelta, {{ Auth::user()->nombre ?? 'Estudiante' }}!</h1>
                <p class="text-gray-500 mb-6">Explora oportunidades de pasantías y haz seguimiento a tus postulaciones</p>
                <div class="bg-gray-200 p-1 rounded-xl flex gap-1 mb-8">
                    <button class="px-4 py-2 rounded-lg font-medium text-gray-500 bg-transparent active:bg-white active:text-gray-900 shadow">Overview</button>
                    <button class="px-4 py-2 rounded-lg font-medium text-gray-500 bg-transparent hover:bg-gray-100">Search Internships</button>
                    <button class="px-4 py-2 rounded-lg font-medium text-gray-500 bg-transparent hover:bg-gray-100">My Applications</button>
                    <button class="px-4 py-2 rounded-lg font-medium text-gray-500 bg-transparent hover:bg-gray-100">Profile</button>
                </div>
            </header>

            <!-- Profile Card -->
            <section class="bg-white border border-gray-200 rounded-2xl p-6 max-w-4xl mx-auto mb-10">
                <div class="flex items-center gap-4 pb-6 border-b border-gray-200">
                    <img src="{{ $student->foto_url ?? 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=150&h=150&fit=crop' }}" alt="User" class="w-14 h-14 rounded-full object-cover">
                    <div class="profile-info">
                        <h2 class="text-lg">{{ Auth::user()->nombre }} {{ $student->apellidos ?? '' }}</h2>
                        <span class="text-gray-500 text-sm">{{ Auth::user()->correo }}</span>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-5 py-6">
                    <div class="detail-box">
                        <label class="block text-xs text-gray-400 mb-1">Career</label>
                        <strong class="text-base">{{ $student->career->nombre ?? 'N/A' }}</strong>
                    </div>
                    <div class="detail-box">
                        <label class="block text-xs text-gray-400 mb-1">Faculty</label>
                        <strong class="text-base">{{ $student->career->faculty->nombre ?? 'N/A' }}</strong>
                    </div>
                    <div class="detail-box">
                        <label class="block text-xs text-gray-400 mb-1">CI</label>
                        <strong class="text-base">{{ $student->ci ?? 'N/A' }}</strong>
                    </div>
                    <div class="detail-box">
                        <label class="block text-xs text-gray-400 mb-1">CV Status</label>
                        @if($student && $student->cv)
                            <span class="bg-green-50 text-green-600 border border-green-200 px-2 py-0.5 rounded-md text-xs font-semibold">Uploaded</span>
                        @else
                            <span class="bg-red-50 text-red-600 border border-red-200 px-2 py-0.5 rounded-md text-xs font-semibold">Not Uploaded</span>
                        @endif
                    </div>
                </div>
                <div class="border-t border-gray-200 pt-5">
                    <label class="block text-xs text-gray-400 mb-1">Skills</label>
                    <div class="flex flex-wrap gap-2">
                        <span class="bg-gray-200 px-3 py-1.5 rounded-md text-xs font-medium">React</span>
                        <span class="bg-gray-200 px-3 py-1.5 rounded-md text-xs font-medium">TypeScript</span>
                        <span class="bg-gray-200 px-3 py-1.5 rounded-md text-xs font-medium">Python</span>
                        <span class="bg-gray-200 px-3 py-1.5 rounded-md text-xs font-medium">Machine Learning</span>
                    </div>
                </div>
            </section>

            <!-- Recommended Jobs -->
            <section class="recommended">
                <div class="mb-5">
                    <h3 class="text-lg flex items-center gap-2">Recommended for You <span class="text-base">🏅</span></h3>
                    <p class="text-gray-500 text-sm">Best matches based on your profile</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 max-w-4xl mx-auto">
                    @forelse($offers as $offer)
                        <div class="bg-white border border-gray-200 rounded-2xl p-6 flex flex-col">
                            <div class="flex justify-between mb-4">
                                <span class="bg-yellow-100 text-yellow-600 text-xs font-bold px-2 py-1 rounded">Best Match</span>
                                <span class="bg-purple-100 text-purple-600 text-xs font-bold px-2 py-1 rounded">{{ $offer->tipo }}</span>
                            </div>
                            <h4 class="text-base font-semibold mb-2">{{ $offer->titulo }}</h4>
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-9 h-9 bg-gray-200 flex items-center justify-center rounded-md">🏢</div>
                                <div>
                                    <strong class="text-sm">{{ $offer->company->nombre ?? 'Unknown' }}</strong>
                                    <span class="text-xs text-gray-500">{{ $offer->company->industria ?? 'Solutions' }}</span>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 leading-relaxed mb-4">{{ Str::limit($offer->requisitos, 100) }}</p>
                            <div class="text-xs text-gray-600 flex flex-col gap-1 mb-4">
                                <div>📍 {{ $offer->company->ubicacion ?? 'N/A' }}</div>
                                <div>🕒 {{ \Carbon\Carbon::parse($offer->fecha_inicio)->diffInMonths($offer->fecha_fin) }} months</div>
                                <div>📁 {{ $offer->career->nombre ?? 'Software Development' }}</div>
                            </div>
                            <div class="border-t border-gray-200 pt-3 mb-5 flex flex-wrap gap-1">
                                @php
                                    $tags = explode(',', $offer->requisitos); // Dummy split for now
                                @endphp
                                @foreach(array_slice($tags, 0, 3) as $tag)
                                    <span class="bg-gray-200 px-2 py-1 rounded text-xs font-medium text-gray-600">{{ trim($tag) }}</span>
                                @endforeach
                            </div>
                            <form action="{{ route('applications.store') }}" method="POST" class="mt-auto">
                                @csrf
                                <input type="hidden" name="offer_id" value="{{ $offer->id }}">
                                <button type="submit" class="w-full py-2.5 bg-black text-white font-semibold cursor-pointer rounded">Apply Now</button>
                            </form>
                        </div>
                    @empty
                        <div class="col-span-full py-10 text-center text-gray-500">
                            No recommended offers found at the moment.
                        </div>
                    @endforelse
                </div>
            </section>
        </main>
    </div>
</body>
</html>