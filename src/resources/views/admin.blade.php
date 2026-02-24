@extends('layouts.app')
@section('content')
<body class="min-h-screen flex flex-col" style="background: #F5F0EB;">

  <div id="header-placeholder"></div>

  <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8">

    <!-- Admin Banner -->
    <div class="rounded-2xl p-5 mb-8 flex items-center gap-4 admin-badge text-white shadow-lg">
      <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
      </div>
      <div>
        <h1 class="font-serif text-2xl">Admin Dashboard</h1>
        <p class="text-white/70 text-sm mt-0.5">Full platform oversight and management tools</p>
      </div>
      <div class="ml-auto text-right hidden sm:block">
        <p class="text-xs text-white/60">Logged in as</p>
        <p class="text-sm font-semibold">Super Admin · Alice Laurent</p>
      </div>
    </div>

    <!-- Global Stats -->
    <section class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
      <article class="stat-card rounded-2xl p-5 shadow-sm border border-stone-200" style="background: white;">
        <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-3" style="background: rgba(198,159,137,0.2);">
          <svg class="w-5 h-5" style="color: #C69F89;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </div>
        <p class="text-2xl font-semibold text-stone-800">1,284</p>
        <p class="text-xs text-stone-500 mt-1">Total Users</p>
        <p class="text-xs mt-1.5 font-medium" style="color: #0d9488;">↑ +47 this week</p>
      </article>
      <article class="stat-card rounded-2xl p-5 shadow-sm border border-stone-200" style="background: white;">
        <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-3" style="background: rgba(221,45,74,0.1);">
          <svg class="w-5 h-5" style="color: #DD2D4A;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
        </div>
        <p class="text-2xl font-semibold text-stone-800">342</p>
        <p class="text-xs text-stone-500 mt-1">Colocations</p>
        <p class="text-xs mt-1.5 font-medium" style="color: #0d9488;">↑ +12 this week</p>
      </article>
      <article class="stat-card rounded-2xl p-5 shadow-sm border border-stone-200" style="background: white;">
        <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-3" style="background: rgba(225,187,128,0.2);">
          <svg class="w-5 h-5" style="color: #E1BB80;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <p class="text-2xl font-semibold text-stone-800">€482K</p>
        <p class="text-xs text-stone-500 mt-1">Total Expenses</p>
        <p class="text-xs mt-1.5 font-medium" style="color: #0d9488;">↑ +18% MoM</p>
      </article>
      <article class="stat-card rounded-2xl p-5 shadow-sm border border-stone-200" style="background: white;">
        <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-3" style="background: rgba(148,119,139,0.15);">
          <svg class="w-5 h-5" style="color: #94778B;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
        </div>
        <p class="text-2xl font-semibold text-stone-800">7</p>
        <p class="text-xs text-stone-500 mt-1">Banned Users</p>
        <p class="text-xs mt-1.5 font-medium" style="color: #DD2D4A;">2 new bans</p>
      </article>
    </section>

    <!-- Charts -->
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-8">
      <div class="rounded-2xl p-6 shadow-sm border border-stone-200" style="background: white;">
        <div class="flex items-center justify-between mb-5">
          <div>
            <h2 class="font-serif text-xl text-stone-800">User Growth</h2>
            <p class="text-sm text-stone-400 mt-0.5">New registrations per month</p>
          </div>
        </div>
        <canvas id="userGrowthChart" height="200"></canvas>
      </div>
      <div class="rounded-2xl p-6 shadow-sm border border-stone-200" style="background: white;">
        <div class="flex items-center justify-between mb-5">
          <div>
            <h2 class="font-serif text-xl text-stone-800">Platform Activity</h2>
            <p class="text-sm text-stone-400 mt-0.5">Expenses & settlements volume</p>
          </div>
        </div>
        <canvas id="activityChart" height="200"></canvas>
      </div>
    </section>

    <!-- User Management -->
    <div class="rounded-2xl shadow-sm border border-stone-200 overflow-hidden" style="background: white;">
      <div class="px-6 py-5 border-b border-stone-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
          <h2 class="font-serif text-xl text-stone-800">User Management</h2>
          <p class="text-stone-400 text-sm mt-0.5">Toggle user status, view details</p>
        </div>
        <div class="flex items-center gap-3">
          <input type="text" placeholder="Search users…" class="px-4 py-2 rounded-xl border border-stone-200 text-sm text-stone-600 focus:outline-none w-48" onfocus="this.style.borderColor='#C69F89'" onblur="this.style.borderColor='#e7e5e4'"/>
          <select class="text-sm border border-stone-200 rounded-xl px-3 py-2 text-stone-600 focus:outline-none">
            <option>All Users</option>
            <option>Active</option>
            <option>Banned</option>
          </select>
        </div>
      </div>
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead>
            <tr style="background: #FAFAF9; border-bottom: 1px solid #f0ede8;">
              <th class="text-left px-6 py-3 text-xs font-semibold text-stone-400 uppercase tracking-wider">User</th>
              <th class="text-left px-6 py-3 text-xs font-semibold text-stone-400 uppercase tracking-wider">Joined</th>
              <th class="text-left px-6 py-3 text-xs font-semibold text-stone-400 uppercase tracking-wider">Colocations</th>
              <th class="text-left px-6 py-3 text-xs font-semibold text-stone-400 uppercase tracking-wider">Expenses</th>
              <th class="text-left px-6 py-3 text-xs font-semibold text-stone-400 uppercase tracking-wider">Status</th>
              <th class="text-left px-6 py-3 text-xs font-semibold text-stone-400 uppercase tracking-wider">Toggle</th>
              <th class="px-6 py-3"></th>
            </tr>
          </thead>
          <tbody class="divide-y divide-stone-50">
            <tr class="user-row">
              <td class="px-6 py-4">
                <div class="flex items-center gap-3">
                  <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-semibold" style="background:#E1BB80; color:#563F1B;">AL</div>
                  <div>
                    <p class="text-sm font-medium text-stone-800">Alice Laurent</p>
                    <p class="text-xs text-stone-400">alice@cohaven.io</p>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 text-sm text-stone-500">Jan 2024</td>
              <td class="px-6 py-4 text-sm text-stone-700 font-medium">7</td>
              <td class="px-6 py-4 text-sm text-stone-700 font-medium">€14,280</td>
              <td class="px-6 py-4"><span class="px-2.5 py-1 rounded-full text-xs font-medium" style="background: rgba(68,255,210,0.15); color: #0d9488;">Active</span></td>
              <td class="px-6 py-4">
                <label class="toggle">
                  <input type="checkbox" checked onchange="toggleUser(this, 'Alice Laurent')"/>
                  <div class="toggle-track" style="background: #44FFD2;">
                    <div class="toggle-thumb"></div>
                  </div>
                </label>
              </td>
              <td class="px-6 py-4"><button class="text-xs text-stone-400 hover:text-stone-700 transition-colors">View</button></td>
            </tr>
            <tr class="user-row">
              <td class="px-6 py-4">
                <div class="flex items-center gap-3">
                  <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-semibold" style="background:#CEABB1; color:#563F1B;">MB</div>
                  <div>
                    <p class="text-sm font-medium text-stone-800">Marc Beaumont</p>
                    <p class="text-xs text-stone-400">marc@cohaven.io</p>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 text-sm text-stone-500">Mar 2024</td>
              <td class="px-6 py-4 text-sm text-stone-700 font-medium">3</td>
              <td class="px-6 py-4 text-sm text-stone-700 font-medium">€5,840</td>
              <td class="px-6 py-4"><span class="px-2.5 py-1 rounded-full text-xs font-medium" style="background: rgba(68,255,210,0.15); color: #0d9488;">Active</span></td>
              <td class="px-6 py-4">
                <label class="toggle">
                  <input type="checkbox" checked onchange="toggleUser(this, 'Marc Beaumont')"/>
                  <div class="toggle-track" style="background: #44FFD2;">
                    <div class="toggle-thumb"></div>
                  </div>
                </label>
              </td>
              <td class="px-6 py-4"><button class="text-xs text-stone-400 hover:text-stone-700 transition-colors">View</button></td>
            </tr>
            <tr class="user-row" style="background: rgba(221,45,74,0.03);">
              <td class="px-6 py-4">
                <div class="flex items-center gap-3">
                  <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-semibold opacity-60" style="background:#C0C0C0; color:#374151;">RM</div>
                  <div>
                    <p class="text-sm font-medium text-stone-500 line-through">René Moreau</p>
                    <p class="text-xs text-stone-400">rene@test.io</p>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 text-sm text-stone-400">Jun 2024</td>
              <td class="px-6 py-4 text-sm text-stone-400">1</td>
              <td class="px-6 py-4 text-sm text-stone-400">€220</td>
              <td class="px-6 py-4"><span class="px-2.5 py-1 rounded-full text-xs font-medium" style="background: rgba(221,45,74,0.1); color: #DD2D4A;">Banned</span></td>
              <td class="px-6 py-4">
                <label class="toggle">
                  <input type="checkbox" onchange="toggleUser(this, 'René Moreau')"/>
                  <div class="toggle-track" style="background: #e5e7eb;">
                    <div class="toggle-thumb"></div>
                  </div>
                </label>
              </td>
              <td class="px-6 py-4"><button class="text-xs text-stone-400 hover:text-stone-700 transition-colors">View</button></td>
            </tr>
            <tr class="user-row">
              <td class="px-6 py-4">
                <div class="flex items-center gap-3">
                  <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-semibold" style="background:#C5E0D8; color:#0d9488;">SL</div>
                  <div>
                    <p class="text-sm font-medium text-stone-800">Sophie Leclerc</p>
                    <p class="text-xs text-stone-400">sophie@cohaven.io</p>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 text-sm text-stone-500">Feb 2024</td>
              <td class="px-6 py-4 text-sm text-stone-700 font-medium">4</td>
              <td class="px-6 py-4 text-sm text-stone-700 font-medium">€9,120</td>
              <td class="px-6 py-4"><span class="px-2.5 py-1 rounded-full text-xs font-medium" style="background: rgba(68,255,210,0.15); color: #0d9488;">Active</span></td>
              <td class="px-6 py-4">
                <label class="toggle">
                  <input type="checkbox" checked onchange="toggleUser(this, 'Sophie Leclerc')"/>
                  <div class="toggle-track" style="background: #44FFD2;">
                    <div class="toggle-thumb"></div>
                  </div>
                </label>
              </td>
              <td class="px-6 py-4"><button class="text-xs text-stone-400 hover:text-stone-700 transition-colors">View</button></td>
            </tr>
            <tr class="user-row" style="background: rgba(221,45,74,0.03);">
              <td class="px-6 py-4">
                <div class="flex items-center gap-3">
                  <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-semibold opacity-60" style="background:#C9C9C9; color:#374151;">LB</div>
                  <div>
                    <p class="text-sm font-medium text-stone-500 line-through">Lucas Bernard</p>
                    <p class="text-xs text-stone-400">lbernard@spam.net</p>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 text-sm text-stone-400">Aug 2024</td>
              <td class="px-6 py-4 text-sm text-stone-400">0</td>
              <td class="px-6 py-4 text-sm text-stone-400">€0</td>
              <td class="px-6 py-4"><span class="px-2.5 py-1 rounded-full text-xs font-medium" style="background: rgba(221,45,74,0.1); color: #DD2D4A;">Banned</span></td>
              <td class="px-6 py-4">
                <label class="toggle">
                  <input type="checkbox" onchange="toggleUser(this, 'Lucas Bernard')"/>
                  <div class="toggle-track" style="background: #e5e7eb;">
                    <div class="toggle-thumb"></div>
                  </div>
                </label>
              </td>
              <td class="px-6 py-4"><button class="text-xs text-stone-400 hover:text-stone-700 transition-colors">View</button></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="px-6 py-4 border-t border-stone-100 flex items-center justify-between" style="background: #FAFAF9;">
        <p class="text-sm text-stone-500">Showing 5 of 1,284 users</p>
        <div class="flex items-center gap-2">
          <button class="px-3 py-1.5 rounded-lg text-xs border border-stone-200 text-stone-500 hover:bg-stone-50 transition-colors">← Prev</button>
          <button class="px-3 py-1.5 rounded-lg text-xs border border-stone-200 text-stone-500 hover:bg-stone-50 transition-colors">Next →</button>
        </div>
      </div>
    </div>
  </main>

  <div id="footer-placeholder"></div>

  <!-- Toast -->
  <div id="adminToast" class="hidden fixed bottom-6 right-6 z-50 px-5 py-3 rounded-xl shadow-xl text-sm font-medium text-white transition-all" style="background: #563F1B;"></div>

  <style>
    body { font-family: 'DM Sans', sans-serif; }
    .font-serif { font-family: 'DM Serif Display', serif; }
    .stat-card { transition: transform 0.2s ease, box-shadow 0.2s ease; }
    .stat-card:hover { transform: translateY(-3px); }
    .user-row { transition: background 0.12s; }
    .user-row:hover { background: rgba(198,159,137,0.07); }
    .toggle { position: relative; display: inline-flex; align-items: center; cursor: pointer; }
    .toggle input { position: absolute; opacity: 0; width: 0; height: 0; }
    .toggle-track { width: 44px; height: 24px; border-radius: 99px; transition: background 0.2s; }
    .toggle-thumb { position: absolute; left: 4px; width: 16px; height: 16px; border-radius: 50%; background: white; transition: transform 0.2s; box-shadow: 0 1px 3px rgba(0,0,0,0.3); }
    input:checked + .toggle-track { background: #44FFD2 !important; }
    input:checked + .toggle-track .toggle-thumb { transform: translateX(20px); }
    .admin-badge { background: linear-gradient(135deg, #DD2D4A, #94778B); }
    .modal-backdrop { animation: fadeIn 0.2s ease; }
    .modal-box { animation: slideUp 0.25s ease; }
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
  </style>







  <script>
      async function loadComponent(id, file) {
        try { const r = await fetch(file); if(r.ok) document.getElementById(id).innerHTML = await r.text(); } catch(e) {}
        }
        loadComponent('header-placeholder', 'header.html');
        loadComponent('footer-placeholder', 'footer.html');
        
        function toggleUser(checkbox, name) {
      const track = checkbox.nextElementSibling;
      if (checkbox.checked) {
        track.style.background = '#44FFD2';
        showToast(`✓ ${name} has been activated`);
      } else {
        track.style.background = '#e5e7eb';
        showToast(`⛔ ${name} has been banned`);
        }
        }
        
    function showToast(msg) {
      const t = document.getElementById('adminToast');
      t.textContent = msg;
      t.classList.remove('hidden');
      setTimeout(() => t.classList.add('hidden'), 3000);
    }

    // User Growth Chart
    new Chart(document.getElementById('userGrowthChart').getContext('2d'), {
      type: 'line',
      data: {
        labels: ['May','Jun','Jul','Aug','Sep','Oct'],
        datasets: [{
          label: 'New Users',
          data: [145, 182, 220, 198, 267, 314],
          borderColor: '#C69F89',
          backgroundColor: 'rgba(198,159,137,0.1)',
          borderWidth: 2.5,
          pointBackgroundColor: '#C69F89',
          pointRadius: 4,
          tension: 0.4,
          fill: true
        }]
      },
      options: {
        responsive: true, maintainAspectRatio: true,
        plugins: { legend: { display: false } },
        scales: {
          y: { grid: { color: 'rgba(0,0,0,0.04)' }, border: { display: false }, ticks: { color: '#78716c' } },
          x: { grid: { display: false }, border: { display: false }, ticks: { color: '#78716c' } }
        }
      }
    });

    // Activity Chart
    new Chart(document.getElementById('activityChart').getContext('2d'), {
      type: 'bar',
      data: {
        labels: ['May','Jun','Jul','Aug','Sep','Oct'],
        datasets: [
          { label: 'Expenses', data: [820, 960, 1100, 890, 1240, 1380], backgroundColor: '#C69F89', borderRadius: 6, borderSkipped: false },
          { label: 'Settlements', data: [340, 420, 580, 310, 650, 720], backgroundColor: '#44FFD2', borderRadius: 6, borderSkipped: false }
        ]
      },
      options: {
        responsive: true, maintainAspectRatio: true,
        plugins: { legend: { labels: { boxWidth: 10, color: '#78716c', font: { size: 11 } } } },
        scales: {
          y: { grid: { color: 'rgba(0,0,0,0.04)' }, border: { display: false }, ticks: { color: '#78716c' } },
          x: { grid: { display: false }, border: { display: false }, ticks: { color: '#78716c' } }
        }
      }
    });
  </script>
</body>
@endsection