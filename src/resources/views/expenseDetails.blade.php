@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-[#0f1115] text-white px-6 py-10">

    {{-- Page Header --}}
    <div class="max-w-5xl mx-auto mb-8">
        <p class="text-xs uppercase tracking-[0.3em] text-white/30">
            Expense Details
        </p>
        <h1 class="text-2xl font-bold text-[#F0EDE8] mt-2">
            {{ $expense->title }}
        </h1>
    </div>

    {{-- Main Card --}}
    <div class="max-w-5xl mx-auto">

        <div class="rounded-3xl border border-white/10 bg-[#111318] shadow-2xl shadow-black/40 overflow-hidden">

            {{-- Top Section --}}
            <div class="p-6 flex flex-col md:flex-row md:items-center md:justify-between gap-6">

                {{-- Amount --}}
                <div>
                    <p class="text-xs uppercase tracking-widest text-white/30">
                        Amount
                    </p>
                    <p class="text-3xl font-bold text-[#C9A84C] mt-1">
                        €{{ number_format($expense->amount, 2) }}
                    </p>
                </div>

                {{-- Status --}}
                <div>
                    <p class="text-xs uppercase tracking-widest text-white/30">
                        Status
                    </p>

                    @if($expense->is_paid)
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full 
                                     bg-green-500/10 text-green-400 text-xs font-semibold mt-1">
                        <span class="w-2 h-2 rounded-full bg-green-400"></span>
                        Paid
                    </span>
                    @else
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full 
                                     bg-orange-500/10 text-orange-400 text-xs font-semibold mt-1">
                        <span class="w-2 h-2 rounded-full bg-orange-400 animate-pulse"></span>
                        Unpaid
                    </span>
                    @endif
                </div>

            </div>

            <div class="h-px bg-white/5"></div>

            {{-- Info Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6 text-sm">

                <div>
                    <p class="text-xs uppercase tracking-wider text-white/30">
                        Date
                    </p>
                    <p class="text-white/70 mt-1">
                        {{ \Carbon\Carbon::parse($expense->expense_date)->format('d M Y') }}
                    </p>
                </div>

                <div>
                    <p class="text-xs uppercase tracking-wider text-white/30">
                        Category
                    </p>
                    <p class="text-white/70 mt-1">
                        {{ $expense->category->name ?? '—' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs uppercase tracking-wider text-white/30">
                        Payer
                    </p>
                    <p class="text-white/70 mt-1">
                        {{ $expense->user->name ?? '—' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs uppercase tracking-wider text-white/30">
                        Colocation
                    </p>
                    <p class="text-white/70 mt-1">
                        {{ $expense->colocation->name ?? '—' }}
                    </p>
                </div>

            </div>

            <div class="h-px bg-white/5"></div>

            {{-- Footer Actions --}}
            <div class="p-5 flex flex-col sm:flex-row items-center justify-between gap-4 bg-white/[0.02]">

                <a href="{{ route('expenses.show') }}"
                    class="text-xs text-white/40 hover:text-white transition">
                    ← Back to Expenses
                </a>

                <div class="flex items-center gap-3">

                    

                    {{-- Delete --}}
                    <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            onclick="return confirm('Delete this expense?')"
                            class="px-5 py-2 rounded-xl text-xs font-semibold
                                       bg-red-500/10 text-red-400 border border-red-500/20
                                       hover:bg-red-500/20 hover:text-red-300
                                       active:scale-95 transition">
                            Delete
                        </button>
                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection