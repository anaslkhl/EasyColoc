@extends('layouts.app')

@section('content')

<body class="min-h-screen flex flex-col" style="background: #F5F0EB;">

  <div id="header-placeholder"></div>

  <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8">

    <!-- Title + Filter Row -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
      <div>
        <h1 class="font-serif text-3xl text-stone-800">Colocations</h1>
        <p class="text-stone-500 mt-1 text-sm">Manage members, roles, and expenses per colocation.</p>
      </div>
      <button onclick="openAddMemberModal()" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-medium text-white shadow-sm hover:shadow-md active:scale-95 transition-all" style="background: #DD2D4A;">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Add Member
      </button>
    </div>

    <!-- Colocation Selector -->
    <div class="flex flex-wrap gap-3 mb-8">
      <button class="coloc-tab px-5 py-2 rounded-full text-sm font-medium text-white transition-all" style="background: #563F1B;" data-coloc="0">Rue de la Paix</button>
      <button class="coloc-tab px-5 py-2 rounded-full text-sm font-medium text-stone-600 transition-all hover:bg-stone-200" style="background: #E5DDD4;" data-coloc="1">Les Lilas Coloc</button>
      <button class="coloc-tab px-5 py-2 rounded-full text-sm font-medium text-stone-600 transition-all hover:bg-stone-200" style="background: #E5DDD4;" data-coloc="2">Montmartre House</button>
      <button class="coloc-tab px-5 py-2 rounded-full text-sm font-medium text-stone-600 transition-all hover:bg-stone-200" style="background: #E5DDD4;" data-coloc="3">Bastille Loft</button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
      <!-- Members Table -->
      <div class="lg:col-span-2 rounded-2xl shadow-sm border border-stone-200 overflow-hidden" style="background: white;">
        <div class="px-6 py-5 border-b border-stone-100 flex items-center justify-between">
          <div>
            <h2 class="font-serif text-xl text-stone-800">Members</h2>
            <p class="text-stone-400 text-sm mt-0.5">Rue de la Paix · 5 members</p>
          </div>
          <select id="monthFilter" class="text-sm border border-stone-200 rounded-lg px-3 py-1.5 text-stone-600 focus:outline-none">
            <option>October 2025</option>
            <option>September 2025</option>
            <option>August 2025</option>
          </select>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full">
            <thead>
              <tr style="background: #FAFAF9;">
                <th class="text-left px-6 py-3 text-xs font-semibold text-stone-400 uppercase tracking-wider">Member</th>
                <th class="text-left px-6 py-3 text-xs font-semibold text-stone-400 uppercase tracking-wider">Role</th>
                <th class="text-left px-6 py-3 text-xs font-semibold text-stone-400 uppercase tracking-wider">Reputation</th>
                <th class="text-left px-6 py-3 text-xs font-semibold text-stone-400 uppercase tracking-wider">Balance</th>
                <th class="px-6 py-3"></th>
              </tr>
            </thead>
            <tbody class="divide-y divide-stone-50">
              <tr class="member-row">
                <td class="px-6 py-4">
                  <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-semibold" style="background:#E1BB80; color:#563F1B;">AL</div>
                    <div>
                      <p class="text-sm font-medium text-stone-800">Alice Laurent</p>
                      <p class="text-xs text-stone-400">alice@cohaven.io</p>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4"><span class="px-2.5 py-1 rounded-full text-xs font-medium" style="background: rgba(86,63,27,0.1); color: #563F1B;">Admin</span></td>
                <td class="px-6 py-4">
                  <div class="flex items-center gap-2">
                    <span class="text-sm font-semibold text-stone-700">+12</span>
                    <div class="flex gap-1">
                      <button class="rep-btn w-6 h-6 rounded flex items-center justify-center text-xs hover:bg-teal-50 transition-colors" style="color: #44FFD2;" title="+1">▲</button>
                      <button class="rep-btn w-6 h-6 rounded flex items-center justify-center text-xs hover:bg-red-50 transition-colors" style="color: #DD2D4A;" title="-1">▼</button>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4"><span class="text-sm font-semibold" style="color: #0d9488;">+€45.00</span></td>
                <td class="px-6 py-4"><button onclick="confirmRemove('Alice Laurent')" class="text-xs text-stone-400 hover:text-red-500 transition-colors">Remove</button></td>
              </tr>
              <tr class="member-row">
                <td class="px-6 py-4">
                  <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-semibold" style="background:#CEABB1; color:#563F1B;">MB</div>
                    <div>
                      <p class="text-sm font-medium text-stone-800">Marc Beaumont</p>
                      <p class="text-xs text-stone-400">marc@cohaven.io</p>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4"><span class="px-2.5 py-1 rounded-full text-xs font-medium" style="background: rgba(198,159,137,0.2); color: #8B6B56;">Member</span></td>
                <td class="px-6 py-4">
                  <div class="flex items-center gap-2">
                    <span class="text-sm font-semibold text-stone-700">+8</span>
                    <div class="flex gap-1">
                      <button class="rep-btn w-6 h-6 rounded flex items-center justify-center text-xs hover:bg-teal-50 transition-colors" style="color: #44FFD2;">▲</button>
                      <button class="rep-btn w-6 h-6 rounded flex items-center justify-center text-xs hover:bg-red-50 transition-colors" style="color: #DD2D4A;">▼</button>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4"><span class="text-sm font-semibold" style="color: #DD2D4A;">-€120.50</span></td>
                <td class="px-6 py-4"><button onclick="confirmRemove('Marc Beaumont')" class="text-xs text-stone-400 hover:text-red-500 transition-colors">Remove</button></td>
              </tr>
              <tr class="member-row">
                <td class="px-6 py-4">
                  <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-semibold" style="background:#C5E0D8; color:#0d9488;">SL</div>
                    <div>
                      <p class="text-sm font-medium text-stone-800">Sophie Leclerc</p>
                      <p class="text-xs text-stone-400">sophie@cohaven.io</p>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4"><span class="px-2.5 py-1 rounded-full text-xs font-medium" style="background: rgba(198,159,137,0.2); color: #8B6B56;">Member</span></td>
                <td class="px-6 py-4">
                  <div class="flex items-center gap-2">
                    <span class="text-sm font-semibold text-stone-700">+15</span>
                    <div class="flex gap-1">
                      <button class="rep-btn w-6 h-6 rounded flex items-center justify-center text-xs hover:bg-teal-50 transition-colors" style="color: #44FFD2;">▲</button>
                      <button class="rep-btn w-6 h-6 rounded flex items-center justify-center text-xs hover:bg-red-50 transition-colors" style="color: #DD2D4A;">▼</button>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4"><span class="text-sm font-semibold" style="color: #0d9488;">+€75.20</span></td>
                <td class="px-6 py-4"><button onclick="confirmRemove('Sophie Leclerc')" class="text-xs text-stone-400 hover:text-red-500 transition-colors">Remove</button></td>
              </tr>
              <tr class="member-row">
                <td class="px-6 py-4">
                  <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-semibold" style="background:#DCE2AA; color:#3d4a0a;">NK</div>
                    <div>
                      <p class="text-sm font-medium text-stone-800">Nina Kaufmann</p>
                      <p class="text-xs text-stone-400">nina@cohaven.io</p>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4"><span class="px-2.5 py-1 rounded-full text-xs font-medium" style="background: rgba(198,159,137,0.2); color: #8B6B56;">Member</span></td>
                <td class="px-6 py-4">
                  <div class="flex items-center gap-2">
                    <span class="text-sm font-semibold text-stone-700">+3</span>
                    <div class="flex gap-1">
                      <button class="rep-btn w-6 h-6 rounded flex items-center justify-center text-xs hover:bg-teal-50 transition-colors" style="color: #44FFD2;">▲</button>
                      <button class="rep-btn w-6 h-6 rounded flex items-center justify-center text-xs hover:bg-red-50 transition-colors" style="color: #DD2D4A;">▼</button>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4"><span class="text-sm font-semibold" style="color: #DD2D4A;">-€10.00</span></td>
                <td class="px-6 py-4"><button onclick="confirmRemove('Nina Kaufmann')" class="text-xs text-stone-400 hover:text-red-500 transition-colors">Remove</button></td>
              </tr>
              <tr class="member-row">
                <td class="px-6 py-4">
                  <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-semibold" style="background:#C0C0C0; color:#374151;">JD</div>
                    <div>
                      <p class="text-sm font-medium text-stone-800">Jean Dubois</p>
                      <p class="text-xs text-stone-400">jean@cohaven.io</p>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4"><span class="px-2.5 py-1 rounded-full text-xs font-medium" style="background: rgba(198,159,137,0.2); color: #8B6B56;">Member</span></td>
                <td class="px-6 py-4">
                  <div class="flex items-center gap-2">
                    <span class="text-sm font-semibold" style="color: #DD2D4A;">-2</span>
                    <div class="flex gap-1">
                      <button class="rep-btn w-6 h-6 rounded flex items-center justify-center text-xs hover:bg-teal-50 transition-colors" style="color: #44FFD2;">▲</button>
                      <button class="rep-btn w-6 h-6 rounded flex items-center justify-center text-xs hover:bg-red-50 transition-colors" style="color: #DD2D4A;">▼</button>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4"><span class="text-sm font-semibold" style="color: #DD2D4A;">-€210.00</span></td>
                <td class="px-6 py-4"><button onclick="confirmRemove('Jean Dubois')" class="text-xs text-stone-400 hover:text-red-500 transition-colors">Remove</button></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Side Info -->
      <div class="space-y-5">
        <!-- Coloc Info Card -->
        <div class="rounded-2xl p-6 shadow-sm border border-stone-200" style="background: white;">
          <h3 class="font-serif text-lg text-stone-800 mb-4">Colocation Info</h3>
          <div class="space-y-3">
            <div class="flex justify-between text-sm">
              <span class="text-stone-500">Address</span>
              <span class="text-stone-700 font-medium">12 Rue de la Paix, Paris</span>
            </div>
            <div class="flex justify-between text-sm">
              <span class="text-stone-500">Created</span>
              <span class="text-stone-700 font-medium">Jan 2024</span>
            </div>
            <div class="flex justify-between text-sm">
              <span class="text-stone-500">Total Expenses</span>
              <span class="text-stone-700 font-medium">€14,280</span>
            </div>
            <div class="flex justify-between text-sm">
              <span class="text-stone-500">This Month</span>
              <span class="text-stone-700 font-medium">€1,620</span>
            </div>
          </div>
        </div>

        <!-- Expense Summary -->
        <div class="rounded-2xl p-6 shadow-sm border border-stone-200" style="background: white;">
          <h3 class="font-serif text-lg text-stone-800 mb-4">October Breakdown</h3>
          <div class="space-y-3">
            <div class="flex items-center justify-between">
              <div class="flex items-center gap-2 text-sm text-stone-600">
                <div class="w-2 h-2 rounded-full" style="background: #C69F89;"></div>Rent
              </div>
              <span class="text-sm font-semibold text-stone-700">€900</span>
            </div>
            <div class="flex items-center justify-between">
              <div class="flex items-center gap-2 text-sm text-stone-600">
                <div class="w-2 h-2 rounded-full" style="background: #DD2D4A;"></div>Electricity
              </div>
              <span class="text-sm font-semibold text-stone-700">€85</span>
            </div>
            <div class="flex items-center justify-between">
              <div class="flex items-center gap-2 text-sm text-stone-600">
                <div class="w-2 h-2 rounded-full" style="background: #44FFD2;"></div>Groceries
              </div>
              <span class="text-sm font-semibold text-stone-700">€340</span>
            </div>
            <div class="flex items-center justify-between">
              <div class="flex items-center gap-2 text-sm text-stone-600">
                <div class="w-2 h-2 rounded-full" style="background: #94778B;"></div>Internet
              </div>
              <span class="text-sm font-semibold text-stone-700">€45</span>
            </div>
            <div class="flex items-center justify-between">
              <div class="flex items-center gap-2 text-sm text-stone-600">
                <div class="w-2 h-2 rounded-full" style="background: #DCE2AA;"></div>Cleaning
              </div>
              <span class="text-sm font-semibold text-stone-700">€250</span>
            </div>
            <div class="border-t border-stone-100 pt-3 flex justify-between">
              <span class="text-sm font-semibold text-stone-600">Total</span>
              <span class="text-sm font-bold text-stone-800">€1,620</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <div id="footer-placeholder"></div>

  <!-- Add Member Modal -->
  <div id="addMemberModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="modal-backdrop absolute inset-0 bg-black/50" onclick="closeAddMemberModal()"></div>
    <div class="modal-box relative bg-white rounded-2xl shadow-2xl w-full max-w-md p-6">
      <div class="flex items-center justify-between mb-6">
        <h3 class="font-serif text-2xl text-stone-800">Add Member</h3>
        <button onclick="closeAddMemberModal()" class="w-8 h-8 rounded-lg flex items-center justify-center text-stone-400 hover:bg-stone-100 hover:text-stone-700 transition-all">✕</button>
      </div>
      <div class="space-y-4">
        <div>
          <label class="block text-sm font-medium text-stone-700 mb-1.5">Full Name</label>
          <input type="text" placeholder="e.g. Thomas Martin" class="w-full px-4 py-2.5 rounded-xl border border-stone-200 text-sm text-stone-700 focus:outline-none focus:ring-2 focus:border-transparent transition-all" style="--tw-ring-color: #C69F89; focus:ring-color: #C69F89;" onfocus="this.style.borderColor='#C69F89'" onblur="this.style.borderColor='#e7e5e4'" />
        </div>
        <div>
          <label class="block text-sm font-medium text-stone-700 mb-1.5">Email Address</label>
          <input type="email" placeholder="thomas@example.com" class="w-full px-4 py-2.5 rounded-xl border border-stone-200 text-sm text-stone-700 focus:outline-none transition-all" onfocus="this.style.borderColor='#C69F89'" onblur="this.style.borderColor='#e7e5e4'" />
        </div>
        <div>
          <label class="block text-sm font-medium text-stone-700 mb-1.5">Role</label>
          <select class="w-full px-4 py-2.5 rounded-xl border border-stone-200 text-sm text-stone-700 focus:outline-none transition-all" onfocus="this.style.borderColor='#C69F89'" onblur="this.style.borderColor='#e7e5e4'">
            <option>Member</option>
            <option>Admin</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-stone-700 mb-1.5">Colocation</label>
          <select class="w-full px-4 py-2.5 rounded-xl border border-stone-200 text-sm text-stone-700 focus:outline-none transition-all" onfocus="this.style.borderColor='#C69F89'" onblur="this.style.borderColor='#e7e5e4'">
            <option>Rue de la Paix</option>
            <option>Les Lilas Coloc</option>
            <option>Montmartre House</option>
            <option>Bastille Loft</option>
          </select>
        </div>
      </div>
      <div class="flex gap-3 mt-6">
        <button onclick="closeAddMemberModal()" class="flex-1 px-4 py-2.5 rounded-xl border border-stone-200 text-sm font-medium text-stone-600 hover:bg-stone-50 transition-all">Cancel</button>
        <button onclick="closeAddMemberModal()" class="flex-1 px-4 py-2.5 rounded-xl text-sm font-medium text-white transition-all hover:opacity-90 active:scale-95" style="background: #DD2D4A;">Add Member</button>
      </div>
    </div>
  </div>

  <!-- Remove Confirm Modal -->
  <div id="removeModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="modal-backdrop absolute inset-0 bg-black/50" onclick="closeRemoveModal()"></div>
    <div class="modal-box relative bg-white rounded-2xl shadow-2xl w-full max-w-sm p-6 text-center">
      <div class="w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-4" style="background: rgba(221,45,74,0.1);">
        <svg class="w-7 h-7" style="color: #DD2D4A;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
        </svg>
      </div>
      <h3 class="font-serif text-xl text-stone-800 mb-2">Remove Member?</h3>
      <p class="text-sm text-stone-500 mb-6" id="removeName">This action cannot be undone.</p>
      <div class="flex gap-3">
        <button onclick="closeRemoveModal()" class="flex-1 px-4 py-2.5 rounded-xl border border-stone-200 text-sm font-medium text-stone-600 hover:bg-stone-50 transition-all">Cancel</button>
        <button onclick="closeRemoveModal()" class="flex-1 px-4 py-2.5 rounded-xl text-sm font-medium text-white transition-all" style="background: #DD2D4A;">Remove</button>
      </div>
    </div>
  </div>

  <script>
    async function loadComponent(id, file) {
      try {
        const r = await fetch(file);
        if (r.ok) document.getElementById(id).innerHTML = await r.text();
      } catch (e) {}
    }
    loadComponent('header-placeholder', 'header.html');
    loadComponent('footer-placeholder', 'footer.html');

    function openAddMemberModal() {
      document.getElementById('addMemberModal').classList.remove('hidden');
    }

    function closeAddMemberModal() {
      document.getElementById('addMemberModal').classList.add('hidden');
    }

    function confirmRemove(name) {
      document.getElementById('removeName').textContent = `Remove ${name} from this colocation?`;
      document.getElementById('removeModal').classList.remove('hidden');
    }

    function closeRemoveModal() {
      document.getElementById('removeModal').classList.add('hidden');
    }

    // Tab switching
    document.querySelectorAll('.coloc-tab').forEach(tab => {
      tab.addEventListener('click', function() {
        document.querySelectorAll('.coloc-tab').forEach(t => {
          t.style.background = '#E5DDD4';
          t.style.color = '#57534e';
        });
        this.style.background = '#563F1B';
        this.style.color = 'white';
      });
    });
  </script>
  @endsection