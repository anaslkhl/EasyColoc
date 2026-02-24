@extends('layouts.app')

@section('content')

<body class="min-h-screen flex flex-col" style="background: #F5F0EB;">

  <!-- HEADER -->
  <div id="header-placeholder"></div>

  <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8">

    <!-- Page Title -->
    <div class="mb-8">
      <h1 class="font-serif text-3xl text-stone-800">Good morning, Alice 👋</h1>
      <p class="text-stone-500 mt-1 text-sm">Here's what's happening across your colocations today.</p>
    </div>

    <!-- Stat Cards -->
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
      <!-- Card 1 -->
      <article class="stat-card rounded-2xl p-6 shadow-sm border border-stone-200" style="background: white;">
        <div class="flex items-start justify-between mb-4">
          <div class="w-11 h-11 rounded-xl flex items-center justify-center" style="background: rgba(198,159,137,0.2);">
            <svg class="w-5 h-5" style="color: #C69F89;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
          </div>
          <span class="text-xs font-medium px-2.5 py-1 rounded-full" style="background: rgba(68,255,210,0.15); color: #0d9488;">+2 this month</span>
        </div>
        <p class="text-3xl font-semibold text-stone-800">7</p>
        <p class="text-sm text-stone-500 mt-1">Active Colocations</p>
      </article>

      <!-- Card 2 -->
      <article class="stat-card rounded-2xl p-6 shadow-sm border border-stone-200" style="background: white;">
        <div class="flex items-start justify-between mb-4">
          <div class="w-11 h-11 rounded-xl flex items-center justify-center" style="background: rgba(221,45,74,0.1);">
            <svg class="w-5 h-5" style="color: #DD2D4A;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
          </div>
          <span class="text-xs font-medium px-2.5 py-1 rounded-full" style="background: rgba(68,255,210,0.15); color: #0d9488;">+5 new</span>
        </div>
        <p class="text-3xl font-semibold text-stone-800">34</p>
        <p class="text-sm text-stone-500 mt-1">Total Members</p>
      </article>

      <!-- Card 3 -->
      <article class="stat-card rounded-2xl p-6 shadow-sm border border-stone-200" style="background: white;">
        <div class="flex items-start justify-between mb-4">
          <div class="w-11 h-11 rounded-xl flex items-center justify-center" style="background: rgba(225,187,128,0.2);">
            <svg class="w-5 h-5" style="color: #E1BB80;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
          <span class="text-xs font-medium px-2.5 py-1 rounded-full" style="background: rgba(221,45,74,0.1); color: #DD2D4A;">↑ 12%</span>
        </div>
        <p class="text-3xl font-semibold text-stone-800">€4,820</p>
        <p class="text-sm text-stone-500 mt-1">Total Expenses (Oct)</p>
      </article>

      <!-- Card 4 -->
      <article class="stat-card rounded-2xl p-6 shadow-sm border border-stone-200" style="background: white;">
        <div class="flex items-start justify-between mb-4">
          <div class="w-11 h-11 rounded-xl flex items-center justify-center" style="background: rgba(148,119,139,0.15);">
            <svg class="w-5 h-5" style="color: #94778B;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
          </div>
          <span class="text-xs font-medium px-2.5 py-1 rounded-full" style="background: rgba(221,45,74,0.1); color: #DD2D4A;">8 pending</span>
        </div>
        <p class="text-3xl font-semibold text-stone-800">€1,240</p>
        <p class="text-sm text-stone-500 mt-1">Outstanding Balances</p>
      </article>
    </section>

    <!-- Charts Row -->
    <section class="grid grid-cols-1 lg:grid-cols-5 gap-5 mb-8">
      <!-- Expenses Bar Chart -->
      <div class="lg:col-span-3 rounded-2xl p-6 shadow-sm border border-stone-200" style="background: white;">
        <div class="flex items-center justify-between mb-6">
          <div>
            <h2 class="font-serif text-xl text-stone-800">Monthly Expenses</h2>
            <p class="text-sm text-stone-400 mt-0.5">Last 6 months overview</p>
          </div>
          <select class="text-sm border border-stone-200 rounded-lg px-3 py-1.5 text-stone-600 focus:outline-none focus:ring-2 focus:ring-offset-1" style="--tw-ring-color: #C69F89;">
            <option>2025</option>
            <option>2024</option>
          </select>
        </div>
        <canvas id="expensesChart" height="200"></canvas>
      </div>

      <!-- Category Doughnut -->
      <div class="lg:col-span-2 rounded-2xl p-6 shadow-sm border border-stone-200" style="background: white;">
        <div class="mb-6">
          <h2 class="font-serif text-xl text-stone-800">By Category</h2>
          <p class="text-sm text-stone-400 mt-0.5">October 2025</p>
        </div>
        <canvas id="categoryChart" height="190"></canvas>
        <div class="mt-4 space-y-2">
          <div class="flex items-center justify-between text-xs text-stone-500">
            <div class="flex items-center gap-2"><span class="w-3 h-3 rounded-full inline-block" style="background:#C69F89;"></span>Rent</div>
            <span class="font-medium text-stone-700">45%</span>
          </div>
          <div class="flex items-center justify-between text-xs text-stone-500">
            <div class="flex items-center gap-2"><span class="w-3 h-3 rounded-full inline-block" style="background:#DD2D4A;"></span>Utilities</div>
            <span class="font-medium text-stone-700">22%</span>
          </div>
          <div class="flex items-center justify-between text-xs text-stone-500">
            <div class="flex items-center gap-2"><span class="w-3 h-3 rounded-full inline-block" style="background:#44FFD2;"></span>Groceries</div>
            <span class="font-medium text-stone-700">18%</span>
          </div>
          <div class="flex items-center justify-between text-xs text-stone-500">
            <div class="flex items-center gap-2"><span class="w-3 h-3 rounded-full inline-block" style="background:#94778B;"></span>Other</div>
            <span class="font-medium text-stone-700">15%</span>
          </div>
        </div>
      </div>
    </section>

    <!-- Activity Feed -->
    <section class="rounded-2xl shadow-sm border border-stone-200 overflow-hidden" style="background: white;">
      <div class="px-6 py-5 border-b border-stone-100 flex items-center justify-between">
        <div>
          <h2 class="font-serif text-xl text-stone-800">Recent Activity</h2>
          <p class="text-sm text-stone-400 mt-0.5">Latest events across all colocations</p>
        </div>
        <a href="#" class="text-sm font-medium hover:underline" style="color: #DD2D4A;">View all →</a>
      </div>
      <div class="divide-y divide-stone-50">
        <!-- Activity Items -->
        <div class="activity-item flex items-start gap-4 px-6 py-4 cursor-default rounded-none">
          <div class="w-9 h-9 rounded-full flex items-center justify-center flex-shrink-0 text-sm font-semibold mt-0.5" style="background: #E1BB80; color: #563F1B;">MB</div>
          <div class="flex-1 min-w-0">
            <p class="text-sm text-stone-700"><span class="font-semibold">Marc Beaumont</span> added an expense <span class="font-semibold">€85.40 — Electricity</span></p>
            <p class="text-xs text-stone-400 mt-0.5">Rue de la Paix Coloc · 2 hours ago</p>
          </div>
          <span class="text-xs px-2.5 py-1 rounded-full flex-shrink-0" style="background: rgba(221,45,74,0.1); color: #DD2D4A;">Expense</span>
        </div>
        <div class="activity-item flex items-start gap-4 px-6 py-4 cursor-default">
          <div class="w-9 h-9 rounded-full flex items-center justify-center flex-shrink-0 text-sm font-semibold mt-0.5" style="background: #C5E0D8; color: #0d9488;">SL</div>
          <div class="flex-1 min-w-0">
            <p class="text-sm text-stone-700"><span class="font-semibold">Sophie Leclerc</span> marked settlement of <span class="font-semibold">€120 as paid</span></p>
            <p class="text-xs text-stone-400 mt-0.5">Les Lilas Coloc · 5 hours ago</p>
          </div>
          <span class="text-xs px-2.5 py-1 rounded-full flex-shrink-0" style="background: rgba(68,255,210,0.15); color: #0d9488;">Settled</span>
        </div>
        <div class="activity-item flex items-start gap-4 px-6 py-4 cursor-default">
          <div class="w-9 h-9 rounded-full flex items-center justify-center flex-shrink-0 text-sm font-semibold mt-0.5" style="background: #CEABB1; color: #563F1B;">JD</div>
          <div class="flex-1 min-w-0">
            <p class="text-sm text-stone-700"><span class="font-semibold">Jean Dubois</span> joined <span class="font-semibold">Montmartre House</span></p>
            <p class="text-xs text-stone-400 mt-0.5">Montmartre House · Yesterday</p>
          </div>
          <span class="text-xs px-2.5 py-1 rounded-full flex-shrink-0" style="background: rgba(198,159,137,0.2); color: #563F1B;">Member</span>
        </div>
        <div class="activity-item flex items-start gap-4 px-6 py-4 cursor-default">
          <div class="w-9 h-9 rounded-full flex items-center justify-center flex-shrink-0 text-sm font-semibold mt-0.5" style="background: #DCE2AA; color: #3d4a0a;">NK</div>
          <div class="flex-1 min-w-0">
            <p class="text-sm text-stone-700"><span class="font-semibold">Nina Kaufmann</span> updated expense <span class="font-semibold">Internet — €45</span></p>
            <p class="text-xs text-stone-400 mt-0.5">Bastille Loft · Yesterday</p>
          </div>
          <span class="text-xs px-2.5 py-1 rounded-full flex-shrink-0" style="background: rgba(220,226,170,0.4); color: #3d4a0a;">Updated</span>
        </div>
        <div class="activity-item flex items-start gap-4 px-6 py-4 cursor-default">
          <div class="w-9 h-9 rounded-full flex items-center justify-center flex-shrink-0 text-sm font-semibold mt-0.5" style="background: #C9C9C9; color: #374151;">AL</div>
          <div class="flex-1 min-w-0">
            <p class="text-sm text-stone-700"><span class="font-semibold">Alice Laurent</span> created new colocation <span class="font-semibold">Belleville Studio</span></p>
            <p class="text-xs text-stone-400 mt-0.5">2 days ago</p>
          </div>
          <span class="text-xs px-2.5 py-1 rounded-full flex-shrink-0" style="background: rgba(148,119,139,0.15); color: #94778B;">Coloc</span>
        </div>
      </div>
    </section>
  </main>

  <!-- FOOTER -->
  <div id="footer-placeholder"></div>

  <script>
    // Load header & footer
    async function loadComponent(id, file) {
      try {
        const res = await fetch(file);
        if (res.ok) document.getElementById(id).innerHTML = await res.text();
      } catch (e) {}
    }
    loadComponent('header-placeholder', 'header.html');
    loadComponent('footer-placeholder', 'footer.html');

    // Bar Chart
    const ctx = document.getElementById('expensesChart').getContext('2d');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
        datasets: [{
          label: 'Total Expenses (€)',
          data: [3800, 4200, 3600, 4900, 4100, 4820],
          backgroundColor: ['#C69F89', '#C69F89', '#C69F89', '#C69F89', '#C69F89', '#DD2D4A'],
          borderRadius: 8,
          borderSkipped: false
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
          legend: {
            display: false
          },
          tooltip: {
            callbacks: {
              label: ctx => ' €' + ctx.parsed.y.toLocaleString()
            }
          }
        },
        scales: {
          y: {
            grid: {
              color: 'rgba(0,0,0,0.04)'
            },
            border: {
              display: false
            },
            ticks: {
              color: '#78716c',
              callback: v => '€' + v
            }
          },
          x: {
            grid: {
              display: false
            },
            border: {
              display: false
            },
            ticks: {
              color: '#78716c'
            }
          }
        }
      }
    });

    // Donut Chart
    const ctx2 = document.getElementById('categoryChart').getContext('2d');
    new Chart(ctx2, {
      type: 'doughnut',
      data: {
        labels: ['Rent', 'Utilities', 'Groceries', 'Other'],
        datasets: [{
          data: [45, 22, 18, 15],
          backgroundColor: ['#C69F89', '#DD2D4A', '#44FFD2', '#94778B'],
          borderWidth: 0,
          hoverOffset: 8
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
          legend: {
            display: false
          }
        },
        cutout: '68%'
      }
    });
  </script>
</body>
@endsection