<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InternConnect - Student Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard_student.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <div class="dashboard-wrapper">
        <aside class="sidebar">
            <div class="sidebar-top">
                <div class="logo">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                    <span>InternConnect</span>
                </div>
                <nav class="nav-menu">
                    <a href="{{ Route::has('student.dashboard') ? route('student.dashboard') : '#' }}" class="nav-item active">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                        Dashboard
                    </a>
                    <a href="{{ Route::has('student.search') ? route('student.search') : '#' }}" class="nav-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        Search Internships
                    </a>
                    <a href="{{ Route::has('student.applications') ? route('student.applications') : '#' }}" class="nav-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                        My Applications
                    </a>
                    <a href="{{ Route::has('student.profile') ? route('student.profile') : '#' }}" class="nav-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        Profile
                    </a>
                </nav>
            </div>
            <div class="sidebar-bottom">
                <div class="user-pill">
                    <strong>{{ Auth::user()->nombre ?? 'Estudiante' }}</strong>
                    <span>Estudiante</span>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <main class="content">
            <header class="header">
                <h1>¡Bienvenido de vuelta, {{ Auth::user()->nombre ?? 'Estudiante' }}!</h1>
                <p>Explora oportunidades de pasantías y haz seguimiento a tus postulaciones</p>
                <div class="tabs">
                    <button class="tab-btn active">Overview</button>
                    <button class="tab-btn">Search Internships</button>
                    <button class="tab-btn">My Applications</button>
                    <button class="tab-btn">Profile</button>
                </div>
            </header>

            <section class="profile-card">
                <div class="profile-main">
                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=150&h=150&fit=crop" alt="User" class="avatar">
                    <div class="profile-info">
                        <h2>{{ Auth::user()->nombre ?? 'Estudiante' }}</h2>
                        <span>{{ Auth::user()->correo ?? 'correo@universidad.edu' }}</span>
                    </div>
                </div>
                <div class="profile-details">
                    <div class="detail-box">
                        <label>Career</label>
                        <strong>Computer Science</strong>
                    </div>
                    <div class="detail-box">
                        <label>University</label>
                        <strong>Stanford University</strong>
                    </div>
                    <div class="detail-box">
                        <label>GPA</label>
                        <strong>3.8/4.0</strong>
                    </div>
                    <div class="detail-box">
                        <label>CV Status</label>
                        <span class="status-pill">Uploaded</span>
                    </div>
                </div>
                <div class="skills-box">
                    <label>Skills</label>
                    <div class="tags">
                        <span class="tag">React</span>
                        <span class="tag">TypeScript</span>
                        <span class="tag">Python</span>
                        <span class="tag">Machine Learning</span>
                    </div>
                </div>
            </section>

            <section class="recommended">
                <div class="section-title">
                    <h3>Recommended for You <span class="badge-icon">🏅</span></h3>
                    <p>Best matches based on your profile</p>
                </div>

                <div class="jobs-grid">
                    <div class="job-card">
                        <div class="card-tags">
                            <span class="best-match">Best Match</span>
                            <span class="work-mode hybrid">Hybrid</span>
                        </div>
                        <h4>Frontend Developer Intern</h4>
                        <div class="company">
                            <div class="company-logo">🏢</div>
                            <div>
                                <strong>TechCorp</strong>
                                <span>Solutions</span>
                            </div>
                        </div>
                        <p class="job-desc">Join our team to build modern web applications using React and TypeScri...</p>
                        <div class="job-info">
                            <div>📍 San Francisco, CA</div>
                            <div>🕒 3 months</div>
                            <div>📁 Software Development</div>
                        </div>
                        <div class="small-tags">
                            <span>React</span> <span>TypeScript</span> <span>HTML/CSS</span> <span>+1 more</span>
                        </div>
                        <button class="btn-applied">Applied</button>
                    </div>

                    <div class="job-card">
                        <div class="card-tags">
                            <span class="best-match">Best Match</span>
                            <span class="work-mode remote">Remote</span>
                        </div>
                        <h4>Data Science Intern</h4>
                        <div class="company">
                            <div class="company-logo">📊</div>
                            <div>
                                <strong>DataViz Inc</strong>
                                <span>Analytics</span>
                            </div>
                        </div>
                        <p class="job-desc">Work with our data team to analyze large datasets and create insightful...</p>
                        <div class="job-info">
                            <div>📍 Remote</div>
                            <div>🕒 6 months</div>
                            <div>📁 Data Science</div>
                        </div>
                        <div class="small-tags">
                            <span>Python</span> <span>SQL</span> <span>Statistics</span> <span>+1 more</span>
                        </div>
                        <button class="btn-applied">Applied</button>
                    </div>

                    <div class="job-card">
                        <div class="card-tags">
                            <span class="best-match">Best Match</span>
                            <span class="work-mode onsite">On-site</span>
                        </div>
                        <h4>Backend Engineer Intern</h4>
                        <div class="company">
                            <div class="company-logo">🏢</div>
                            <div>
                                <strong>TechCorp</strong>
                                <span>Solutions</span>
                            </div>
                        </div>
                        <p class="job-desc">Develop and maintain server-side applications. Experience with cloud...</p>
                        <div class="job-info">
                            <div>📍 New York, NY</div>
                            <div>🕒 4 months</div>
                            <div>📁 Software Development</div>
                        </div>
                        <div class="small-tags">
                            <span>Java</span> <span>Spring Boot</span> <span>SQL</span> <span>+1 more</span>
                        </div>
                        <form action="{{ Route::has('internships.apply') ? route('internships.apply', 1) : '#' }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-apply">Apply Now</button>
                        </form>
                    </div>
                </div>
            </section>
        </main>
    </div>

</body>
</html>