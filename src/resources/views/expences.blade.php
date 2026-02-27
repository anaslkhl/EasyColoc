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
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
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

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

      @forelse($expenses as $expense)

      <div class="group flex flex-col justify-between rounded-2xl border border-white/10 
            bg-[#111318] hover:-translate-y-1.5 hover:shadow-2xl 
            hover:shadow-black/40 transition-all duration-300 h-[320px]">

        {{-- ───────── HEADER ───────── --}}
        <div>
          <div class="flex justify-between items-start p-5">
            <div class="min-w-0">
              <p class="text-[10px] uppercase tracking-widest text-white/30">
                Expense
              </p>
              <h3 class="text-sm font-semibold text-[#F0EDE8] truncate">
                {{ $expense->title }}
              </h3>
            </div>

            <div class="text-right shrink-0">
              <p class="text-[10px] uppercase tracking-widest text-white/30">
                Amount
              </p>
              <p class="text-xl font-bold text-[#C9A84C]">
                €{{ number_format($expense->amount, 2) }}
              </p>
            </div>
          </div>

          <div class="h-px bg-white/5"></div>

          {{-- ───────── INFO ───────── --}}
          <div class="grid grid-cols-2 gap-4 p-5 text-xs">

            <div class="space-y-1">
              <p class="text-white/30 uppercase tracking-wider">Date</p>
              <p class="text-white/70">
                {{ \Carbon\Carbon::parse($expense->expense_date)->format('d M Y') }}
              </p>
            </div>

            <div class="space-y-1">
              <p class="text-white/30 uppercase tracking-wider">Category</p>
              <span class="inline-block px-2.5 py-1 rounded-full 
                             bg-[#C9A84C]/10 text-[#C9A84C] 
                             text-[10px] font-semibold">
                {{ $expense->category->name ?? '—' }}
              </span>
            </div>

            <div class="space-y-1">
              <p class="text-white/30 uppercase tracking-wider">Payer</p>
              <p class="text-white/70 truncate">
                {{ optional($expense->user)->name ?? '—' }}
              </p>
            </div>

            <div class="space-y-1">
              <p class="text-white/30 uppercase tracking-wider">Colocation</p>
              <p class="text-white/70 truncate">
                {{ optional($expense->colocation)->name ?? '—' }}
              </p>
            </div>

          </div>
        </div>

        {{-- ───────── FOOTER ───────── --}}
        <div class="border-t border-white/5 p-4 flex items-center justify-between">

          {{-- Status --}}
          @if($expense->is_paid)
          <span class="px-3 py-1 rounded-full 
                     bg-green-500/10 text-green-400 
                     text-[10px] font-bold">
            ● Paid
          </span>
          @else
          <span class="px-3 py-1 rounded-full 
                     bg-orange-500/10 text-orange-400 
                     text-[10px] font-bold animate-pulse">
            ● Unpaid
          </span>
          @endif

          {{-- Buttons --}}
          <div class="flex items-center gap-2">

            {{-- View Button --}}
            <a href="{{ route('expenses.show', $expense->id) }}"
              class="px-4 py-2 text-[11px] font-semibold rounded-lg
                  bg-[#C9A84C] text-black
                  hover:brightness-110 active:scale-95
                  transition">
              View
            </a>

            {{-- Delete Button --}}
            <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST">
              @csrf
              @method('DELETE')

              <button type="submit"
                class="px-4 py-2 text-[11px] font-semibold rounded-lg
                       bg-red-500/10 text-red-400 border border-red-500/20
                       hover:bg-red-500/20 hover:text-red-300
                       active:scale-95 transition">
                Delete
              </button>
            </form>

          </div>
        </div>

      </div>

      @empty

      <div class="col-span-full flex flex-col items-center py-20 text-white/30">
        <p class="uppercase tracking-widest text-xs">No expenses found</p>
      </div>

      @endforelse
    </div>

  </main>

  <div id="footer-placeholder"></div>

  <!-- Add Expense Modal -->
  <div id="expenseModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">

    <div class="modal-backdrop absolute inset-0 bg-black/50" onclick="closeExpenseModal()"></div>

    <div class="modal-box relative bg-white rounded-2xl shadow-2xl w-full max-w-lg p-6 max-h-screen overflow-y-auto">

      <div class="flex items-center justify-between mb-6">
        <h3 class="font-serif text-2xl text-stone-800">New Expense</h3>
        <button onclick="closeExpenseModal()"
          class="w-8 h-8 rounded-lg flex items-center justify-center text-stone-400 hover:bg-stone-100 hover:text-stone-700 transition-all">
          ✕
        </button>
      </div>

      <form method="POST" action="{{ route('expenses.store') }}">
        @csrf

        <div class="space-y-4">

          <!-- Title -->
          <div>
            <label class="block text-sm font-medium text-stone-700 mb-1.5">Expense Title</label>
            <input type="text" name="name" required
              placeholder="e.g. Monthly groceries"
              class="w-full px-4 py-2.5 rounded-xl border border-stone-200 text-sm text-stone-700 focus:outline-none focus:border-[#C69F89]" />
          </div>

          <!-- Amount + Date -->
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-stone-700 mb-1.5">Amount (€)</label>
              <input type="number" name="amount" step="0.01" required
                placeholder="0.00"
                class="w-full px-4 py-2.5 rounded-xl border border-stone-200 text-sm text-stone-700 focus:outline-none focus:border-[#C69F89]" />
            </div>
            <div>
              <label class="block text-sm font-medium text-stone-700 mb-1.5">Date</label>
              <input type="date" name="expense_date" required
                class="w-full px-4 py-2.5 rounded-xl border border-stone-200 text-sm text-stone-700 focus:outline-none focus:border-[#C69F89]" />
            </div>
          </div>

          <!-- Category -->
          <div>
            <label class="block text-sm font-medium text-stone-700 mb-1.5">Category</label>
            <select name="category_id" required
              class="w-full px-4 py-2.5 rounded-xl border border-stone-200 text-sm text-stone-700 focus:outline-none focus:border-[#C69F89]">

              <option value="">Select a category…</option>

              @foreach($categories as $category)
              <option value="{{ $category->id }}">
                {{ $category->name }}
              </option>
              @endforeach
            </select>
          </div>

          <!-- Payer -->
          <div>
            <label class="block text-sm font-medium text-stone-700 mb-1.5">Payer</label>
            <select name="user_id" required
              class="w-full px-4 py-2.5 rounded-xl border border-stone-200 text-sm text-stone-700 focus:outline-none focus:border-[#C69F89]">

              <option value="">Select payer…</option>

              @foreach($users as $user)
              <option value="{{ $user->id }}">
                {{ $user->name }}
              </option>
              @endforeach
            </select>
          </div>

          <!-- Colocation -->
          <div>
            <label class="block text-sm font-medium text-stone-700 mb-1.5">Colocation</label>
            <select name="colocation_id" required
              class="w-full px-4 py-2.5 rounded-xl border border-stone-200 text-sm text-stone-700 focus:outline-none focus:border-[#C69F89]">

              <option value="">Select colocation…</option>
              @foreach($colocations as $colocation)
              <option value="{{ $colocation->id }}">
                {{ $colocation->name }}
              </option>
              @endforeach
            </select>
          </div>

          <!-- Notes -->
        </div>

        <!-- Buttons -->
        <div class="flex gap-3 mt-6">
          <button type="button" onclick="closeExpenseModal()"
            class="flex-1 px-4 py-2.5 rounded-xl border border-stone-200 text-sm font-medium text-stone-600 hover:bg-stone-50 transition-all">
            Cancel
          </button>

          <button type="submit"
            class="flex-1 px-4 py-2.5 rounded-xl text-sm font-medium text-white transition-all hover:opacity-90 active:scale-95"
            style="background: #DD2D4A;">
            Save Expense
          </button>
        </div>

      </form>
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

    function openExpenseModal() {
      document.getElementById('expenseModal').classList.remove('hidden');
    }

    function closeExpenseModal() {
      document.getElementById('expenseModal').classList.add('hidden');
    }

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