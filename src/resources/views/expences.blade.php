@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-[#0B0F1A] text-white flex flex-col">

  <!-- HEADER -->
  <div class="max-w-7xl mx-auto w-full px-6 py-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <h1 class="font-serif text-3xl text-[#F0EDE8]">Expenses</h1>
      <p class="text-gray-400 mt-1 text-sm">Track and manage all shared expenses.</p>
    </div>
    <button onclick="openExpenseModal()"
      class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-medium text-white shadow-md hover:opacity-90 active:scale-95 transition-all"
      style="background: #DD2D4A;">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
      </svg>
      Add Expense
    </button>
  </div>

  <!-- FILTERS -->
  <div class="max-w-7xl mx-auto w-full px-6 flex flex-wrap gap-3 mb-6 items-center">
    <select class="text-sm border border-white/20 bg-[#111318] rounded-xl px-4 py-2 text-white focus:outline-none shadow-sm">
      <option>All Colocations</option>
      @foreach($colocations as $c)
      <option>{{ $c->name }}</option>
      @endforeach
    </select>

    <select class="text-sm border border-white/20 bg-[#111318] rounded-xl px-4 py-2 text-white focus:outline-none shadow-sm">
      <option>All Months</option>
      @for($m = 1; $m <= 12; $m++)
        <option>{{ \Carbon\Carbon::create()->month($m)->format('F') }}</option>
        @endfor
    </select>

    <select class="text-sm border border-white/20 bg-[#111318] rounded-xl px-4 py-2 text-white focus:outline-none shadow-sm">
      <option>All Categories</option>
      @foreach($categories as $category)
      <option>{{ $category->name }}</option>
      @endforeach
    </select>

    <span class="text-xs text-gray-400 ml-auto flex items-center gap-2">
      <span class="w-3 h-3 rounded-full bg-orange-500/20 animate-pulse"></span>
      Unpaid items highlighted
    </span>
  </div>

  <!-- EXPENSE CARDS -->
  <div class="max-w-7xl mx-auto w-full px-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    @forelse($expenses as $expense)
    <div class="group flex flex-col justify-between rounded-2xl border border-white/10 bg-[#111318]
                  hover:-translate-y-1 hover:shadow-2xl hover:shadow-black/40 transition-all duration-300">

      <!-- HEADER -->
      <div>
        <div class="flex justify-between items-start p-5">
          <div>
            <p class="text-[10px] uppercase tracking-widest text-white/30">Expense</p>
            <h3 class="text-sm font-semibold text-[#F0EDE8] truncate">{{ $expense->title }}</h3>
          </div>
          <div class="text-right">
            <p class="text-[10px] uppercase tracking-widest text-white/30">Amount</p>
            <p class="text-xl font-bold text-[#C9A84C]">€{{ number_format($expense->amount, 2) }}</p>
          </div>
        </div>

        <div class="h-px bg-white/5"></div>

        <!-- INFO -->
        <div class="grid grid-cols-2 gap-4 p-5 text-xs">
          <div>
            <p class="text-white/30 uppercase tracking-wider">Date</p>
            <p class="text-white/70">{{ \Carbon\Carbon::parse($expense->expense_date)->format('d M Y') }}</p>
          </div>
          <div>
            <p class="text-white/30 uppercase tracking-wider">Category</p>
            <span class="inline-block px-2.5 py-1 rounded-full bg-[#C9A84C]/10 text-[#C9A84C] text-[10px] font-semibold">
              {{ $expense->category->name ?? '—' }}
            </span>
          </div>
          <div>
            <p class="text-white/30 uppercase tracking-wider">Payer</p>
            <p class="text-white/70 truncate">{{ optional($expense->user)->name ?? '—' }}</p>
          </div>
          <div>
            <p class="text-white/30 uppercase tracking-wider">Colocation</p>
            <p class="text-white/70 truncate">{{ optional($expense->colocation)->name ?? '—' }}</p>
          </div>
        </div>
      </div>

      <!-- FOOTER -->
      <div class="border-t border-white/5 p-4 flex items-center justify-between">
        @if($expense->is_paid)
        <span class="px-3 py-1 rounded-full bg-green-500/10 text-green-400 text-[10px] font-bold">● Paid</span>
        @else
        <span class="px-3 py-1 rounded-full bg-orange-500/10 text-orange-400 text-[10px] font-bold animate-pulse">● Unpaid</span>
        @endif

        <div class="flex items-center gap-2">
          <a href="{{ route('expenses.details', $expense->id) }}" class="px-4 py-2 text-[11px] font-semibold rounded-lg bg-[#C9A84C] text-black hover:brightness-110 active:scale-95 transition">
            View
          </a>
          <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 text-[11px] font-semibold rounded-lg bg-red-500/10 text-red-400 border border-red-500/20 hover:bg-red-500/20 hover:text-red-300 active:scale-95 transition">
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

</div>

<!-- ADD EXPENSE MODAL -->
<div id="expenseModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
  <div class="absolute inset-0 bg-black/50" onclick="closeExpenseModal()"></div>

  <div class="relative bg-[#111318] rounded-2xl shadow-2xl w-full max-w-lg p-6 max-h-screen overflow-y-auto">
    <div class="flex items-center justify-between mb-6">
      <h3 class="font-serif text-2xl text-[#F0EDE8]">New Expense</h3>
      <button onclick="closeExpenseModal()" class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:bg-gray-800 hover:text-white transition-all">✕</button>
    </div>

    <form method="POST" action="{{ route('expenses.store') }}" class="space-y-4">
      @csrf

      <div>
        <label class="block text-sm font-medium text-gray-300 mb-1.5">Expense Title</label>
        <input type="text" name="title" placeholder="Monthly groceries" required
          class="w-full px-4 py-2.5 rounded-xl bg-[#0F172A] border border-white/20 text-white focus:outline-none focus:border-[#C9A84C]" />
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-300 mb-1.5">Amount (€)</label>
          <input type="number" name="amount" step="0.01" placeholder="0.00" required
            class="w-full px-4 py-2.5 rounded-xl bg-[#0F172A] border border-white/20 text-white focus:outline-none focus:border-[#C9A84C]" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-300 mb-1.5">Date</label>
          <input type="date" name="expense_date" required
            class="w-full px-4 py-2.5 rounded-xl bg-[#0F172A] border border-white/20 text-white focus:outline-none focus:border-[#C9A84C]" />
        </div>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-300 mb-1.5">Category</label>
        <select name="category_id" required class="w-full px-4 py-2.5 rounded-xl bg-[#0F172A] border border-white/20 text-white focus:outline-none focus:border-[#C9A84C]">
          <option value="">Select a category…</option>
          @foreach($categories as $category)
          <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-300 mb-1.5">Payer</label>
        <select name="user_id" required class="w-full px-4 py-2.5 rounded-xl bg-[#0F172A] border border-white/20 text-white focus:outline-none focus:border-[#C9A84C]">
          <option value="">Select payer…</option>
          @foreach($users as $user)
          <option value="{{ $user->id }}">{{ $user->name }}</option>
          @endforeach
        </select>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-300 mb-1.5">Colocation</label>
        <select name="colocation_id" required class="w-full px-4 py-2.5 rounded-xl bg-[#0F172A] border border-white/20 text-white focus:outline-none focus:border-[#C9A84C]">
          <option value="">Select colocation…</option>
          @foreach($colocations as $colocation)
          <option value="{{ $colocation->id }}">{{ $colocation->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="flex gap-3 mt-6">
        <button type="button" onclick="closeExpenseModal()" class="flex-1 px-4 py-2.5 rounded-xl border border-white/20 text-sm font-medium hover:bg-white/10 transition">
          Cancel
        </button>
        <button type="submit" class="flex-1 px-4 py-2.5 rounded-xl text-sm font-medium text-white bg-[#DD2D4A] hover:opacity-90 transition">
          Save Expense
        </button>
      </div>
    </form>
  </div>
</div>

<script>
  function openExpenseModal() {
    document.getElementById('expenseModal').classList.remove('hidden');
  }

  function closeExpenseModal() {
    document.getElementById('expenseModal').classList.add('hidden');
  }
</script>

@endsection