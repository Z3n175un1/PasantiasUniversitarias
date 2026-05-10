<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InternConnect - Company Dashboard</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('uworkflow-logo.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="{{ asset('css/dashboard_company.css') }}">

</head>
<body>

    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="brand">
                    <i data-lucide="graduation-cap"></i>
                    <span>InternConnect</span>
                </div>
            </div>

            <nav class="sidebar-nav">
                <a href="#" class="nav-link active" data-tab="overview">
                    <i data-lucide="layout-dashboard"></i> Dashboard
                </a>
                <a href="#" class="nav-link" data-tab="internships">
                    <i data-lucide="briefcase"></i> My Internships
                </a>
                <a href="#" class="nav-link" data-tab="applicants">
                    <i data-lucide="users"></i> Applicants
                </a>
                <a href="#" class="nav-link" data-tab="profile">
                    <i data-lucide="building-2"></i> Company Profile
                </a>
            </nav>

            <div class="sidebar-footer">
                <div class="company-tag">
                    <span class="company-name">TechCorp Solutions</span>
                    <span class="company-type">Company</span>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i data-lucide="log-out"></i> Logout
                    </button>
                </form>
            </div>
        </aside>

        <main class="main-content">
            <header class="main-header">
                <h1>Welcome, TechCorp Solutions!</h1>
                <p>Manage your internship postings and review candidates</p>
            </header>

            <div class="tab-navigator">
                <button class="tab-item active" data-tab="overview">Overview</button>
                <button class="tab-item" data-tab="internships">My Internships</button>
                <button class="tab-item" data-tab="applicants">Applicants</button>
                <button class="tab-item" data-tab="profile">Company Profile</button>
            </div>

            <div id="tab-content-container">
                <div class="stats-grid">
                    <div class="card stat-card">
                        <span class="stat-label">Active Internships</span>
                        <span class="stat-value">2</span>
                        <div class="stat-info"><i data-lucide="briefcase"></i> Currently open</div>
                    </div>
                    <div class="card stat-card">
                        <span class="stat-label">Total Applicants</span>
                        <span class="stat-value">2</span>
                        <div class="stat-info"><i data-lucide="users"></i> All positions</div>
                    </div>
                    <div class="card stat-card">
                        <span class="stat-label">Pending Review</span>
                        <span class="stat-value pending">1</span>
                        <div class="stat-info"><i data-lucide="file-text"></i> Needs action</div>
                    </div>
                    <div class="card stat-card">
                        <span class="stat-label">Accepted</span>
                        <span class="stat-value accepted">1</span>
                        <div class="stat-info"><i data-lucide="star"></i> Selected</div>
                    </div>
                </div>

                <div class="card">
                    <div class="section-header">
                        <h2><i data-lucide="award" class="award-yellow"></i> Top Recommended Candidates</h2>
                        <p>Best matches based on our intelligent algorithm</p>
                    </div>
                    <div class="candidate-entry">
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=James" class="can-avatar">
                        <div class="can-info">
                            <p class="can-name">James Chen</p>
                            <p class="can-major">Software Engineering</p>
                            <p class="applied-title">Applied for: Backend Engineer Intern</p>
                            <div class="tag-list">
                                <span class="tag-pill">Java</span> <span class="tag-pill">Spring Boot</span> 
                                <span class="tag-pill">Docker</span> <span class="tag-pill">AWS</span>
                            </div>
                        </div>
                        <div class="can-actions">
                            <span class="match-box">95% Match</span>
                            <div class="action-row">
                                <a href="{{ Route::has('candidate.profile') ? route('candidate.profile', 1) : '#' }}" class="btn-outline" style="text-decoration:none; display:inline-block; text-align:center;">View Profile</a>
                                <form action="{{ Route::has('candidate.accept') ? route('candidate.accept', 1) : '#' }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn-success">Accept</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="{{ asset('js/dashboard_company.js') }}"></script>
</body>
</html>