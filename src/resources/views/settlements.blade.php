@extends('layouts.app')
@section('content')

<body class="min-h-screen flex flex-col bg-gray-900 text-gray-100">

    <div id="header-placeholder"></div>

    <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8">

        <!-- Title -->
        <div class="mb-8">
            <h1 class="font-serif text-3xl text-gray-100">Balances & Settlements</h1>
            <p class="text-gray-400 mt-1 text-sm">Track who owes whom and mark settlements as paid.</p>
        </div>

        <!-- Summary Cards -->
        <section class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">
            <article class="rounded-2xl p-6 shadow border border-gray-700 bg-gray-800">
                <p class="text-sm text-gray-400 mb-2">You're owed</p>
                <p class="text-3xl font-semibold text-teal-400">+€{{ number_format($summary['you_are_owed'],2) }}</p>
                <p class="text-xs text-gray-500 mt-1">Across {{ $summary['colocations'] }} colocations</p>
            </article>
            <article class="rounded-2xl p-6 shadow border border-gray-700 bg-gray-800">
                <p class="text-sm text-gray-400 mb-2">You owe</p>
                <p class="text-3xl font-semibold text-red-500">-€{{ number_format($summary['you_owe'],2) }}</p>
                <p class="text-xs text-gray-500 mt-1">{{ $summary['members_you_owe'] }} member(s)</p>
            </article>
            <article class="rounded-2xl p-6 shadow border border-gray-700 bg-gray-800">
                <p class="text-sm text-gray-400 mb-2">Net position</p>
                <p class="text-3xl font-semibold {{ $summary['net']>=0 ? 'text-teal-400':'text-red-500' }}">
                    {{ $summary['net']>=0?'+':'-' }}€{{ number_format(abs($summary['net']),2) }}
                </p>
                <p class="text-xs text-gray-500 mt-1">{{ $currentMonth }}</p>
            </article>
        </section>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

            <!-- Settlements Table -->
            <div class="lg:col-span-2 rounded-2xl shadow border border-gray-700 overflow-hidden bg-gray-800">
                <div class="px-6 py-5 border-b border-gray-700 flex items-center justify-between">
                    <div>
                        <h2 class="font-serif text-xl text-gray-100">Settlement Plan</h2>
                        <p class="text-gray-400 text-sm mt-0.5">Optimized payments to minimize transactions</p>
                    </div>
                    <form method="GET" class="ml-2">
                        <select name="month" onchange="this.form.submit()" class="text-sm border border-gray-600 rounded-lg px-3 py-1.5 bg-gray-900 text-gray-100 focus:outline-none">
                            @foreach($months as $month)
                            <option value="{{ $month }}" {{ $month==$currentMonth?'selected':'' }}>{{ $month }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-700 border-b border-gray-600">
                                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">From</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">To</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Amount</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Colocation</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            @foreach($settlements as $settlement)
                            <tr class="hover:bg-gray-700 transition-colors">
                                <td class="px-6 py-4 flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-semibold" style="background: {{ $settlement->debtor->color ?? '#4B5563' }}; color: {{ $settlement->debtor->text_color ?? '#F9FAFB' }}">
                                        {{ \Str::upper(substr($settlement->debtor->name,0,1).substr(explode(' ',$settlement->debtor->name)[1]??'',0,1)) }}
                                    </div>
                                    <span>{{ $settlement->debtor->name }}</span>
                                </td>
                                <td class="px-6 py-4 flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-semibold" style="background: {{ $settlement->creditor->color ?? '#4B5563' }}; color: {{ $settlement->creditor->text_color ?? '#F9FAFB' }}">
                                        {{ \Str::upper(substr($settlement->creditor->name,0,1).substr(explode(' ',$settlement->creditor->name)[1]??'',0,1)) }}
                                    </div>
                                    <span>{{ $settlement->creditor->name }}</span>
                                </td>
                                <td class="px-6 py-4 text-red-400 font-semibold">€{{ number_format($settlement->amount,2) }}</td>
                                <td class="px-6 py-4 text-gray-400">{{ $settlement->colocation->name }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $settlement->status=='Pending'?'bg-red-900 text-red-400':'bg-teal-900 text-teal-400' }}">
                                        {{ $settlement->status=='Pending' ? 'Pending' : '✓ Paid' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($settlement->status=='Pending')
                                    <button onclick="markPaid({{ $settlement->id }}, this)" class="px-3 py-1.5 rounded-lg text-xs font-medium text-gray-900 bg-teal-400 hover:opacity-90 transition-all">Mark Paid</button>
                                    @else
                                    <span class="text-xs text-gray-500">Settled</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Member Balances -->
            <div class="space-y-4">
                <h2 class="font-serif text-xl text-gray-100 px-1">Member Balances</h2>
                @foreach($members as $member)
                <div class="rounded-2xl p-5 shadow border border-gray-700 bg-gray-800">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-semibold" style="background: {{ $member->color }}; color: {{ $member->text_color }}">
                            {{ $member->initials }}
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-100">{{ $member->name }}</p>
                            <p class="text-xs text-gray-400">{{ $member->colocation }}</p>
                        </div>
                        <span class="text-sm font-bold {{ $member->balance>=0?'text-teal-400':'text-red-500' }}">
                            {{ $member->balance>=0?'+':'-' }}€{{ number_format(abs($member->balance),2) }}
                        </span>
                    </div>

                    <!-- Expandable owes/owedTo -->
                    <div class="text-xs text-gray-300">
                        @if($member->owes->count())
                        <p class="font-medium text-red-400">Owes:</p>
                        <ul class="pl-3 list-disc">
                            @foreach($member->owes as $o)
                            <li>{{ $o->creditor->name }}: €{{ number_format($o->amount,2) }}</li>
                            @endforeach
                        </ul>
                        @endif

                        @if($member->owedTo->count())
                        <p class="font-medium text-teal-400 mt-2">Owed To:</p>
                        <ul class="pl-3 list-disc">
                            @foreach($member->owedTo as $o)
                            <li>{{ $o->debtor->name }}: €{{ number_format($o->amount,2) }}</li>
                            @endforeach
                        </ul>
                        @endif
                    </div>

                    <!-- Balance bar -->
                    <div class="h-1.5 rounded-full bg-gray-700 mt-2">
                        <div class="h-1.5 rounded-full {{ $member->balance>=0?'bg-teal-400':'bg-red-500' }}" style="width: {{ $member->percentage }}%;"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </main>

    <div id="footer-placeholder"></div>

    <div id="toast" class="hidden fixed bottom-6 right-6 z-50 px-5 py-3 rounded-xl shadow-xl text-sm font-medium text-gray-900 bg-teal-400">
        ✓ Settlement marked as paid!
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

        function markPaid(id, btn) {
            fetch(`/settlements/${id}/pay`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(res => res.json())
                .then(() => {
                    const row = btn.closest('tr');
                    row.querySelector('td:nth-child(5)').innerHTML = '<span class="px-2.5 py-1 rounded-full text-xs font-medium bg-teal-900 text-teal-400">✓ Paid</span>';
                    btn.parentElement.innerHTML = '<span class="text-xs text-gray-500">Settled</span>';
                    const toast = document.getElementById('toast');
                    toast.classList.remove('hidden');
                    setTimeout(() => toast.classList.add('hidden'), 2800);
                });
        }
    </script>
</body>
@endsection