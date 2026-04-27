// Cargar iconos de Lucide
lucide.createIcons();

// --- CONTENIDO DE LAS VISTAS ---
const views = {
    overview: `
        <div class="stats-grid">
            <div class="card"><span class="stat-label">Active Internships</span><span class="stat-value">2</span><div class="stat-info"><i data-lucide="briefcase"></i> Currently open</div></div>
            <div class="card"><span class="stat-label">Total Applicants</span><span class="stat-value">2</span><div class="stat-info"><i data-lucide="users"></i> All positions</div></div>
            <div class="card"><span class="stat-label">Pending Review</span><span class="stat-value pending">1</span><div class="stat-info"><i data-lucide="file-text"></i> Needs action</div></div>
            <div class="card"><span class="stat-label">Accepted</span><span class="stat-value accepted">1</span><div class="stat-info"><i data-lucide="star"></i> Selected</div></div>
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
                    <div class="tag-list"><span class="tag-pill">Java</span><span class="tag-pill">Spring Boot</span><span class="tag-pill">Docker</span><span class="tag-pill">AWS</span></div>
                </div>
                <div style="text-align:right">
                    <span class="match-box">95% Match</span>
                    <div style="display:flex; gap:8px">
                        <button class="btn-outline">View Profile</button>
                        <button class="btn-success">Accept</button>
                    </div>
                </div>
            </div>
        </div>
    `,
    internships: `
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px">
            <div><h2>My Internships</h2><p style="color:var(--text-muted)">Manage your internship postings</p></div>
            <button class="btn-primary" style="background:#000; display:flex; align-items:center; gap:8px"><i data-lucide="plus"></i> Post New Internship</button>
        </div>
        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:24px">
            <div class="card">
                <div style="display:flex; justify-content:space-between; margin-bottom:12px">
                    <b style="font-size:16px">Frontend Developer Intern</b>
                    <span class="status-badge accepted">active</span>
                </div>
                <p style="color:var(--text-muted); font-size:13px; line-height:1.5">Join our team to build modern web applications using React and TypeScript. You will work on real projects...</p>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px; margin:20px 0; font-size:13px">
                    <div><span class="stat-label">Area</span><br><b>Software Development</b></div>
                    <div><span class="stat-label">Modality</span><br><b>Hybrid</b></div>
                    <div><span class="stat-label">Duration</span><br><b>3 months</b></div>
                    <div><span class="stat-label">Applicants</span><br><b>1</b></div>
                </div>
                <div style="display:flex; gap:10px; border-top:1px solid var(--border-color); padding-top:16px">
                    <button class="btn-outline" style="flex:1"><i data-lucide="edit-2" style="width:14px"></i> Edit</button>
                    <button class="btn-outline" style="flex:1; color:#ef4444"><i data-lucide="trash-2" style="width:14px"></i> Delete</button>
                </div>
            </div>
            </div>
    `,
    applicants: `
        <div class="card">
            <h2>All Applicants</h2>
            <p style="color:var(--text-muted); margin-bottom:20px">Review and manage candidate applications</p>
            <table class="applicants-table">
                <thead><tr><th>Candidate</th><th>Position</th><th>Career</th><th>Match Score</th><th>Status</th></tr></thead>
                <tbody>
                    <tr>
                        <td><div style="display:flex; align-items:center; gap:10px"><div class="avatar-initial">E</div><div><b>Emma Rodriguez</b><br><small>emma@univ.edu</small></div></div></td>
                        <td>Frontend Developer</td><td>Computer Science</td><td><b style="color:var(--primary-blue)">92%</b></td>
                        <td><span class="status-badge accepted">accepted</span></td>
                    </tr>
                    <tr>
                        <td><div style="display:flex; align-items:center; gap:10px"><div class="avatar-initial J">J</div><div><b>James Chen</b><br><small>james@univ.edu</small></div></div></td>
                        <td>Backend Engineer</td><td>Software Engineering</td><td><b style="color:var(--primary-blue)">95%</b></td>
                        <td><span class="status-badge pending">pending</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    `,
    profile: `
        <div class="card">
            <h2>Company Information</h2><p style="color:var(--text-muted)">Manage your company profile</p>
            <div class="form-layout">
                <div class="form-group"><label class="form-label">Company Name</label><input class="form-input" value="TechCorp Solutions"></div>
                <div class="form-group"><label class="form-label">Industry</label><input class="form-input" value="Technology"></div>
                <div class="form-group"><label class="form-label">Contact Email</label><input class="form-input" value="hr@techcorp.com"></div>
                <div class="form-group"><label class="form-label">Website</label><input class="form-input" value="www.techcorp.com"></div>
                <div class="form-group full"><label class="form-label">Description</label><textarea class="form-textarea">Leading software development company specializing in AI...</textarea></div>
            </div>
            <button class="btn-primary" style="margin-top:20px">Update Profile</button>
        </div>
    `
};

// --- LÓGICA DE NAVEGACIÓN ---
const container = document.getElementById('tab-content-container');
const buttons = document.querySelectorAll('.nav-link, .tab-item');

function goToTab(id) {
    container.innerHTML = views[id] || '<h2>Coming Soon</h2>';
    lucide.createIcons();
    
    buttons.forEach(btn => {
        if(btn.getAttribute('data-tab') === id) btn.classList.add('active');
        else btn.classList.remove('active');
    });
}

buttons.forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        goToTab(btn.getAttribute('data-tab'));
    });
});