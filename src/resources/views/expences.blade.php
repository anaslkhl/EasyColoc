@extends('layouts.app')

@section('content')

<body class="min-h-screen flex flex-col" style="background: #F5F0EB;">

  <div id="header-placeholder"></div>

  <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8">

    <!-- Title Row -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
      <div>
        <h1 class="font-serif text-3xl text-stone-800">Expenses</h1>
        <p class="text-stone-500 mt-1 text-sm">Track and manage all shared expenses.</p>
      </div>
      <button onclick="openExpenseModal()" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-medium text-white shadow-sm hover:opacity-90 active:scale-95 transition-all" style="background: #DD2D4A;">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Add Expense
      </button>
    </div>

    <!-- Filters -->
    <div class="flex flex-wrap gap-3 mb-6">
      <select class="text-sm border border-stone-200 bg-white rounded-xl px-4 py-2 text-stone-600 focus:outline-none shadow-sm">
        <option>All Colocations</option>
        <option>Rue de la Paix</option>
        <option>Les Lilas Coloc</option>
        <option>Montmartre House</option>
      </select>
      <select class="text-sm border border-stone-200 bg-white rounded-xl px-4 py-2 text-stone-600 focus:outline-none shadow-sm">
        <option>October 2025</option>
        <option>September 2025</option>
        <option>August 2025</option>
      </select>
      <select class="text-sm border border-stone-200 bg-white rounded-xl px-4 py-2 text-stone-600 focus:outline-none shadow-sm">
        <option>All Categories</option>
        <option>Rent</option>
        <option>Utilities</option>
        <option>Groceries</option>
        <option>Internet</option>
        <option>Cleaning</option>
        <option>Other</option>
      </select>
      <div class="flex items-center gap-2 ml-auto">
        <span class="text-xs text-stone-400 flex items-center gap-1.5">
          <span class="w-3 h-3 inline-block rounded" style="background: rgba(221,45,74,0.15); border-left: 2px solid #DD2D4A;"></span>
          Unpaid items highlighted
        </span>
      </div>
    </div>

    <!-- Expenses Table -->
    <div class="rounded-2xl shadow-sm border border-stone-200 overflow-hidden" style="background: white;">
      <div class="overflow-x-auto">
        <table class="w-full" id="expensesTable">
          <thead>
            <tr style="background: #FAFAF9; border-bottom: 1px solid #f0ede8;">
              <th class="sortable text-left px-6 py-4 text-xs font-semibold text-stone-400 uppercase tracking-wider" onclick="sortTable(0)">Title ↕</th>
              <th class="sortable text-left px-6 py-4 text-xs font-semibold text-stone-400 uppercase tracking-wider" onclick="sortTable(1)">Amount ↕</th>
              <th class="sortable text-left px-6 py-4 text-xs font-semibold text-stone-400 uppercase tracking-wider" onclick="sortTable(2)">Date ↕</th>
              <th class="text-left px-6 py-4 text-xs font-semibold text-stone-400 uppercase tracking-wider">Category</th>
              <th class="text-left px-6 py-4 text-xs font-semibold text-stone-400 uppercase tracking-wider">Payer</th>
              <th class="text-left px-6 py-4 text-xs font-semibold text-stone-400 uppercase tracking-wider">Status</th>
              <th class="px-6 py-4"></th>
            </tr>
          </thead>
          <tbody id="expensesBody" class="divide-y divide-stone-50">
            <!-- Unpaid Row -->
            <tr class="exp-row unpaid">
              <td class="px-6 py-4 text-sm font-medium text-stone-800">Monthly Rent</td>
              <td class="px-6 py-4 text-sm font-semibold text-stone-700">€900.00</td>
              <td class="px-6 py-4 text-sm text-stone-500">01 Oct 2025</td>
              <td class="px-6 py-4"><span class="px-2.5 py-1 rounded-full text-xs font-medium" style="background: rgba(198,159,137,0.25); color: #8B6B56;">Rent</span></td>
              <td class="px-6 py-4">
                <div class="flex items-center gap-2">
                  <div class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-semibold" style="background:#E1BB80; color:#563F1B;">AL</div>
                  <span class="text-sm text-stone-600">Alice L.</span>
                </div>
              </td>
              <td class="px-6 py-4"><span class="px-2.5 py-1 rounded-full text-xs font-medium" style="background: rgba(221,45,74,0.1); color: #DD2D4A;">Unpaid</span></td>
              <td class="px-6 py-4"><button class="text-xs text-stone-400 hover:text-stone-700 transition-colors">Edit</button></td>
            </tr>
            <tr class="exp-row">
              <td class="px-6 py-4 text-sm font-medium text-stone-800">Electricity Bill</td>
              <td class="px-6 py-4 text-sm font-semibold text-stone-700">€85.40</td>
              <td class="px-6 py-4 text-sm text-stone-500">03 Oct 2025</td>
              <td class="px-6 py-4"><span class="px-2.5 py-1 rounded-full text-xs font-medium" style="background: rgba(221,45,74,0.1); color: #DD2D4A;">Utilities</span></td>
              <td class="px-6 py-4">
                <div class="flex items-center gap-2">
                  <div class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-semibold" style="background:#CEABB1; color:#563F1B;">MB</div>
                  <span class="text-sm text-stone-600">Marc B.</span>
                </div>
              </td>
              <td class="px-6 py-4"><span class="px-2.5 py-1 rounded-full text-xs font-medium" style="background: rgba(68,255,210,0.15); color: #0d9488;">Paid</span></td>
              <td class="px-6 py-4"><button class="text-xs text-stone-400 hover:text-stone-700 transition-colors">Edit</button></td>
            </tr>
            <tr class="exp-row">
              <td class="px-6 py-4 text-sm font-medium text-stone-800">Weekly Groceries</td>
              <td class="px-6 py-4 text-sm font-semibold text-stone-700">€156.80</td>
              <td class="px-6 py-4 text-sm text-stone-500">05 Oct 2025</td>
              <td class="px-6 py-4"><span class="px-2.5 py-1 rounded-full text-xs font-medium" style="background: rgba(68,255,210,0.15); color: #0d9488;">Groceries</span></td>
              <td class="px-6 py-4">
                <div class="flex items-center gap-2">
                  <div class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-semibold" style="background:#C5E0D8; color:#0d9488;">SL</div>
                  <span class="text-sm text-stone-600">Sophie L.</span>
                </div>
              </td>
              <td class="px-6 py-4"><span class="px-2.5 py-1 rounded-full text-xs font-medium" style="background: rgba(68,255,210,0.15); color: #0d9488;">Paid</span></td>
              <td class="px-6 py-4"><button class="text-xs text-stone-400 hover:text-stone-700 transition-colors">Edit</button></td>
            </tr>
            <tr class="exp-row unpaid">
              <td class="px-6 py-4 text-sm font-medium text-stone-800">Internet Subscription</td>
              <td class="px-6 py-4 text-sm font-semibold text-stone-700">€45.00</td>
              <td class="px-6 py-4 text-sm text-stone-500">08 Oct 2025</td>
              <td class="px-6 py-4"><span class="px-2.5 py-1 rounded-full text-xs font-medium" style="background: rgba(148,119,139,0.15); color: #94778B;">Internet</span></td>
              <td class="px-6 py-4">
                <div class="flex items-center gap-2">
                  <div class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-semibold" style="background:#DCE2AA; color:#3d4a0a;">NK</div>
                  <span class="text-sm text-stone-600">Nina K.</span>
                </div>
              </td>
              <td class="px-6 py-4"><span class="px-2.5 py-1 rounded-full text-xs font-medium" style="background: rgba(221,45,74,0.1); color: #DD2D4A;">Unpaid</span></td>
              <td class="px-6 py-4"><button class="text-xs text-stone-400 hover:text-stone-700 transition-colors">Edit</button></td>
            </tr>
            <tr class="exp-row">
              <td class="px-6 py-4 text-sm font-medium text-stone-800">Cleaning Service</td>
              <td class="px-6 py-4 text-sm font-semibold text-stone-700">€250.00</td>
              <td class="px-6 py-4 text-sm text-stone-500">10 Oct 2025</td>
              <td class="px-6 py-4"><span class="px-2.5 py-1 rounded-full text-xs font-medium" style="background: rgba(220,226,170,0.4); color: #3d4a0a;">Cleaning</span></td>
              <td class="px-6 py-4">
                <div class="flex items-center gap-2">
                  <div class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-semibold" style="background:#E1BB80; color:#563F1B;">AL</div>
                  <span class="text-sm text-stone-600">Alice L.</span>
                </div>
              </td>
              <td class="px-6 py-4"><span class="px-2.5 py-1 rounded-full text-xs font-medium" style="background: rgba(68,255,210,0.15); color: #0d9488;">Paid</span></td>
              <td class="px-6 py-4"><button class="text-xs text-stone-400 hover:text-stone-700 transition-colors">Edit</button></td>
            </tr>
            <tr class="exp-row">
              <td class="px-6 py-4 text-sm font-medium text-stone-800">Gas Bill</td>
              <td class="px-6 py-4 text-sm font-semibold text-stone-700">€62.30</td>
              <td class="px-6 py-4 text-sm text-stone-500">12 Oct 2025</td>
              <td class="px-6 py-4"><span class="px-2.5 py-1 rounded-full text-xs font-medium" style="background: rgba(221,45,74,0.1); color: #DD2D4A;">Utilities</span></td>
              <td class="px-6 py-4">
                <div class="flex items-center gap-2">
                  <div class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-semibold" style="background:#CEABB1; color:#563F1B;">MB</div>
                  <span class="text-sm text-stone-600">Marc B.</span>
                </div>
              </td>
              <td class="px-6 py-4"><span class="px-2.5 py-1 rounded-full text-xs font-medium" style="background: rgba(68,255,210,0.15); color: #0d9488;">Paid</span></td>
              <td class="px-6 py-4"><button class="text-xs text-stone-400 hover:text-stone-700 transition-colors">Edit</button></td>
            </tr>
            <tr class="exp-row unpaid">
              <td class="px-6 py-4 text-sm font-medium text-stone-800">Water Bill</td>
              <td class="px-6 py-4 text-sm font-semibold text-stone-700">€38.50</td>
              <td class="px-6 py-4 text-sm text-stone-500">15 Oct 2025</td>
              <td class="px-6 py-4"><span class="px-2.5 py-1 rounded-full text-xs font-medium" style="background: rgba(221,45,74,0.1); color: #DD2D4A;">Utilities</span></td>
              <td class="px-6 py-4">
                <div class="flex items-center gap-2">
                  <div class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-semibold" style="background:#C0C0C0; color:#374151;">JD</div>
                  <span class="text-sm text-stone-600">Jean D.</span>
                </div>
              </td>
              <td class="px-6 py-4"><span class="px-2.5 py-1 rounded-full text-xs font-medium" style="background: rgba(221,45,74,0.1); color: #DD2D4A;">Unpaid</span></td>
              <td class="px-6 py-4"><button class="text-xs text-stone-400 hover:text-stone-700 transition-colors">Edit</button></td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- Table Footer -->
      <div class="px-6 py-4 border-t border-stone-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3" style="background: #FAFAF9;">
        <p class="text-sm text-stone-500">Showing <span class="font-medium text-stone-700">7</span> expenses · <span style="color: #DD2D4A;" class="font-medium">3 unpaid</span></p>
        <p class="text-sm font-semibold text-stone-700">Total: €1,538.00</p>
      </div>
    </div>
  </main>

  <div id="footer-placeholder"></div>

  <!-- Add Expense Modal -->
  <div id="expenseModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="modal-backdrop absolute inset-0 bg-black/50" onclick="closeExpenseModal()"></div>
    <div class="modal-box relative bg-white rounded-2xl shadow-2xl w-full max-w-lg p-6 max-h-screen overflow-y-auto">
      <div class="flex items-center justify-between mb-6">
        <h3 class="font-serif text-2xl text-stone-800">New Expense</h3>
        <button onclick="closeExpenseModal()" class="w-8 h-8 rounded-lg flex items-center justify-center text-stone-400 hover:bg-stone-100 hover:text-stone-700 transition-all">✕</button>
      </div>
      <div class="space-y-4">
        <div>
          <label class="block text-sm font-medium text-stone-700 mb-1.5">Expense Title</label>
          <input type="text" placeholder="e.g. Monthly groceries" class="w-full px-4 py-2.5 rounded-xl border border-stone-200 text-sm text-stone-700 focus:outline-none transition-all" onfocus="this.style.borderColor='#C69F89'" onblur="this.style.borderColor='#e7e5e4'"/>
        </div>
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-stone-700 mb-1.5">Amount (€)</label>
            <input type="number" placeholder="0.00" step="0.01" class="w-full px-4 py-2.5 rounded-xl border border-stone-200 text-sm text-stone-700 focus:outline-none transition-all" onfocus="this.style.borderColor='#C69F89'" onblur="this.style.borderColor='#e7e5e4'"/>
          </div>
          <div>
            <label class="block text-sm font-medium text-stone-700 mb-1.5">Date</label>
            <input type="date" class="w-full px-4 py-2.5 rounded-xl border border-stone-200 text-sm text-stone-700 focus:outline-none transition-all" onfocus="this.style.borderColor='#C69F89'" onblur="this.style.borderColor='#e7e5e4'"/>
          </div>
        </div>
        <div>
          <label class="block text-sm font-medium text-stone-700 mb-1.5">Category</label>
          <select class="w-full px-4 py-2.5 rounded-xl border border-stone-200 text-sm text-stone-700 focus:outline-none transition-all" onfocus="this.style.borderColor='#C69F89'" onblur="this.style.borderColor='#e7e5e4'">
            <option value="">Select a category…</option>
            <option>Rent</option>
            <option>Utilities</option>
            <option>Groceries</option>
            <option>Internet</option>
            <option>Cleaning</option>
            <option>Transport</option>
            <option>Other</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-stone-700 mb-1.5">Payer</label>
          <select class="w-full px-4 py-2.5 rounded-xl border border-stone-200 text-sm text-stone-700 focus:outline-none transition-all" onfocus="this.style.borderColor='#C69F89'" onblur="this.style.borderColor='#e7e5e4'">
            <option>Alice Laurent</option>
            <option>Marc Beaumont</option>
            <option>Sophie Leclerc</option>
            <option>Nina Kaufmann</option>
            <option>Jean Dubois</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-stone-700 mb-1.5">Colocation</label>
          <select class="w-full px-4 py-2.5 rounded-xl border border-stone-200 text-sm text-stone-700 focus:outline-none transition-all" onfocus="this.style.borderColor='#C69F89'" onblur="this.style.borderColor='#e7e5e4'">
            <option>Rue de la Paix</option>
            <option>Les Lilas Coloc</option>
            <option>Montmartre House</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-stone-700 mb-1.5">Notes (optional)</label>
          <textarea rows="2" placeholder="Any additional details…" class="w-full px-4 py-2.5 rounded-xl border border-stone-200 text-sm text-stone-700 focus:outline-none transition-all resize-none" onfocus="this.style.borderColor='#C69F89'" onblur="this.style.borderColor='#e7e5e4'"></textarea>
        </div>
      </div>
      <div class="flex gap-3 mt-6">
        <button onclick="closeExpenseModal()" class="flex-1 px-4 py-2.5 rounded-xl border border-stone-200 text-sm font-medium text-stone-600 hover:bg-stone-50 transition-all">Cancel</button>
        <button onclick="closeExpenseModal()" class="flex-1 px-4 py-2.5 rounded-xl text-sm font-medium text-white transition-all hover:opacity-90 active:scale-95" style="background: #DD2D4A;">Save Expense</button>
      </div>
    </div>
  </div>

  <script>
    async function loadComponent(id, file) {
      try { const r = await fetch(file); if(r.ok) document.getElementById(id).innerHTML = await r.text(); } catch(e) {}
    }
    loadComponent('header-placeholder', 'header.html');
    loadComponent('footer-placeholder', 'footer.html');

    function openExpenseModal() { document.getElementById('expenseModal').classList.remove('hidden'); }
    function closeExpenseModal() { document.getElementById('expenseModal').classList.add('hidden'); }

    let sortDir = {};
    function sortTable(col) {
      const tbody = document.getElementById('expensesBody');
      const rows = Array.from(tbody.querySelectorAll('tr'));
      sortDir[col] = !sortDir[col];
      rows.sort((a, b) => {
        const aT = a.cells[col].textContent.trim();
        const bT = b.cells[col].textContent.trim();
        return sortDir[col] ? aT.localeCompare(bT) : bT.localeCompare(aT);
      });
      rows.forEach(r => tbody.appendChild(r));
    }
  </script>
</body>
@endsection