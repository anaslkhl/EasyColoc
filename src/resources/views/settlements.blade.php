@extends('layouts.app')
@section('content')

<div class="min-h-screen bg-[#0B0F1A] text-white flex flex-col">

    <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-10">

        <!-- PAGE TITLE -->
        <div class="mb-8">
            <h1 class="font-serif text-3xl text-[#F0EDE8]">Balances & Settlements</h1>
            <p class="text-gray-400 mt-1 text-sm">See who owes you, what you owe, and manage payments easily.</p>
        </div>

        @if(Auth::user()->colocations->count() === 0)
        <!-- No Colocation Message -->
        <div class="bg-[#111318] p-8 rounded-3xl border border-[#1F2937] text-center">
            <p class="text-gray-400 mb-4">You don’t have any colocations yet.</p>
            <a href="{{ route('colocations.create') }}"
                class="inline-block px-6 py-3 rounded-xl bg-[#DD2D4A] hover:opacity-90 transition font-semibold text-sm text-white">
                Create Your First Colocation
            </a>
        </div>
        @else
        <!-- User has Colocation(s) -->
        @foreach(Auth::user()->colocations as $colocation)
        <div class="bg-[#111318] border border-[#1F2937] rounded-3xl p-8 mb-8">

            <!-- Colocation Header -->
            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-[#D4AF37]">{{ $colocation->name }}</h2>
                    <p class="text-gray-400 mt-1">{{ $colocation->description ?? 'No description' }}</p>
                </div>
                <span class="px-4 py-1 rounded-full text-sm font-semibold {{ $colocation->status === 'active' ? 'bg-emerald-500/20 text-emerald-400' : 'bg-red-500/20 text-red-400' }}">
                    {{ ucfirst($colocation->status) }}
                </span>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                <div class="p-5 rounded-2xl border border-gray-700 bg-[#0F172A] shadow">
                    <p class="text-sm text-gray-400 mb-2">You're Owed</p>
                    <p class="text-2xl font-semibold text-teal-400">€{{ number_format($summary['you_are_owed'] ?? 0,2) }}</p>
                </div>
                <div class="p-5 rounded-2xl border border-gray-700 bg-[#0F172A] shadow">
                    <p class="text-sm text-gray-400 mb-2">You Owe</p>
                    <p class="text-2xl font-semibold text-red-500">€{{ number_format($summary['you_owe'] ?? 0,2) }}</p>
                </div>
                <div class="p-5 rounded-2xl border border-gray-700 bg-[#0F172A] shadow">
                    <p class="text-sm text-gray-400 mb-2">Net</p>
                    <p class="text-2xl font-semibold {{ ($summary['net'] ?? 0)>=0 ? 'text-teal-400':'text-red-500' }}">
                        €{{ number_format(abs($summary['net'] ?? 0),2) }}
                    </p>
                </div>
            </div>

            <!-- Settlements Table -->
            @if($settlements->count() > 0)
            <div class="overflow-x-auto rounded-2xl border border-gray-700 bg-[#0F172A]">
                <table class="w-full text-sm">
                    <thead class="bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-gray-400 uppercase tracking-wider">From</th>
                            <th class="px-6 py-3 text-left text-gray-400 uppercase tracking-wider">To</th>
                            <th class="px-6 py-3 text-left text-gray-400 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-3 text-left text-gray-400 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @foreach($settlements as $settlement)
                        <tr class="bg-gray-900">
                            <td class="px-4 py-2">{{ $settlement->fromUser?->name ?? 'Unknown' }}</td>
                            <td class="px-4 py-2">{{ $settlement->toUser?->name ?? 'Unknown' }}</td>
                            <td class="px-4 py-2">{{ $settlement->amount }}</td>
                            <td class="px-4 py-2 capitalize">
                                @if($settlement->status == 'pending')
                                Pending
                                @else
                                Settled
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                @if($settlement->status == 'pending' && Auth::id() === $settlement->from_user)
                                <form action="{{ route('settlements.markPaid', $settlement->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit"
                                        class="px-3 py-1.5 rounded-lg text-xs font-medium text-gray-900 bg-teal-400 hover:opacity-90 transition-all">
                                        Mark Paid
                                    </button>
                                </form>
                                @elseif($settlement->status == 'pending')
                                <span class="text-xs text-gray-500">Pending</span>
                                @else
                                <span class="text-xs text-gray-500">Settled</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
            @else
            <p class="text-gray-400 mt-4 text-center">No settlements yet for this colocation.</p>
            @endif

        </div>
        @endforeach
        @endif
    </main>

    <!-- Toast -->
    <div id="toast" class="hidden fixed bottom-6 right-6 z-50 px-5 py-3 rounded-xl shadow-xl text-sm font-medium text-gray-900 bg-teal-400">
        ✓ Settlement marked as paid!
    </div>

    <script>
        function markPaid(id, btn) {
            fetch(`/settlements/${id}/pay`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(res => res.json()).then(() => {
                const row = btn.closest('tr');
                row.querySelector('td:nth-child(4)').innerHTML = '<span class="px-2 py-1 rounded-full text-xs font-medium bg-teal-900 text-teal-400">Paid</span>';
                btn.parentElement.innerHTML = '<span class="text-xs text-gray-500">Settled</span>';
                const toast = document.getElementById('toast');
                toast.classList.remove('hidden');
                setTimeout(() => toast.classList.add('hidden'), 2800);
            });
        }
    </script>
    @endsection