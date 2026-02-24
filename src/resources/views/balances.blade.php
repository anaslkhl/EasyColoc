@extends('layouts.app')
@section('content')

<body class="min-h-screen flex flex-col" style="background: #F5F0EB;">

    <div id="header-placeholder"></div>

    <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8">

        <!-- Title -->
        <div class="mb-8">
            <h1 class="font-serif text-3xl text-stone-800">Balances & Settlements</h1>
            <p class="text-stone-500 mt-1 text-sm">Track who owes whom and mark settlements as paid.</p>
        </div>

        <!-- Balance Overview Cards -->
        <section class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">
            <article class="rounded-2xl p-6 shadow-sm border border-stone-200" style="background: white;">
                <p class="text-sm text-stone-500 mb-2">You're owed</p>
                <p class="text-3xl font-semibold" style="color: #0d9488;">+€120.20</p>
                <p class="text-xs text-stone-400 mt-1">Across 2 colocations</p>
            </article>
            <article class="rounded-2xl p-6 shadow-sm border border-stone-200" style="background: white;">
                <p class="text-sm text-stone-500 mb-2">You owe</p>
                <p class="text-3xl font-semibold" style="color: #DD2D4A;">-€45.00</p>
                <p class="text-xs text-stone-400 mt-1">To 1 member</p>
            </article>
            <article class="rounded-2xl p-6 shadow-sm border border-stone-200" style="background: white;">
                <p class="text-sm text-stone-500 mb-2">Net position</p>
                <p class="text-3xl font-semibold" style="color: #0d9488;">+€75.20</p>
                <p class="text-xs text-stone-400 mt-1">October 2025</p>
            </article>
        </section>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
            <!-- Settlements Table -->
            <div class="lg:col-span-2 rounded-2xl shadow-sm border border-stone-200 overflow-hidden" style="background: white;">
                <div class="px-6 py-5 border-b border-stone-100 flex items-center justify-between">
                    <div>
                        <h2 class="font-serif text-xl text-stone-800">Settlement Plan</h2>
                        <p class="text-stone-400 text-sm mt-0.5">Optimized payments to minimize transactions</p>
                    </div>
                    <select class="text-sm border border-stone-200 rounded-lg px-3 py-1.5 text-stone-600 focus:outline-none">
                        <option>October 2025</option>
                        <option>September 2025</option>
                    </select>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr style="background: #FAFAF9; border-bottom: 1px solid #f0ede8;">
                                <th class="text-left px-6 py-3 text-xs font-semibold text-stone-400 uppercase tracking-wider">From</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-stone-400 uppercase tracking-wider">To</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-stone-400 uppercase tracking-wider">Amount</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-stone-400 uppercase tracking-wider">Colocation</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-stone-400 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-stone-50">
                            <tr class="settle-row" id="row1">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-semibold" style="background:#CEABB1; color:#563F1B;">MB</div>
                                        <span class="text-sm text-stone-700">Marc B.</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-semibold" style="background:#E1BB80; color:#563F1B;">AL</div>
                                        <span class="text-sm text-stone-700">Alice L.</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4"><span class="text-sm font-semibold" style="color: #DD2D4A;">€120.50</span></td>
                                <td class="px-6 py-4"><span class="text-sm text-stone-500">Rue de la Paix</span></td>
                                <td class="px-6 py-4"><span class="px-2.5 py-1 rounded-full text-xs font-medium" style="background: rgba(221,45,74,0.1); color: #DD2D4A;">Pending</span></td>
                                <td class="px-6 py-4">
                                    <button onclick="markPaid('row1', this)" class="px-3 py-1.5 rounded-lg text-xs font-medium text-white hover:opacity-90 active:scale-95 transition-all" style="background: #44FFD2; color: #0d5e50;">Mark Paid</button>
                                </td>
                            </tr>
                            <tr class="settle-row" id="row2">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-semibold" style="background:#C0C0C0; color:#374151;">JD</div>
                                        <span class="text-sm text-stone-700">Jean D.</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-semibold" style="background:#C5E0D8; color:#0d9488;">SL</div>
                                        <span class="text-sm text-stone-700">Sophie L.</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4"><span class="text-sm font-semibold" style="color: #DD2D4A;">€75.20</span></td>
                                <td class="px-6 py-4"><span class="text-sm text-stone-500">Rue de la Paix</span></td>
                                <td class="px-6 py-4"><span class="px-2.5 py-1 rounded-full text-xs font-medium" style="background: rgba(221,45,74,0.1); color: #DD2D4A;">Pending</span></td>
                                <td class="px-6 py-4">
                                    <button onclick="markPaid('row2', this)" class="px-3 py-1.5 rounded-lg text-xs font-medium hover:opacity-90 active:scale-95 transition-all" style="background: #44FFD2; color: #0d5e50;">Mark Paid</button>
                                </td>
                            </tr>
                            <tr class="settle-row" id="row3">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-semibold" style="background:#DCE2AA; color:#3d4a0a;">NK</div>
                                        <span class="text-sm text-stone-700">Nina K.</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-semibold" style="background:#CEABB1; color:#563F1B;">MB</div>
                                        <span class="text-sm text-stone-700">Marc B.</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4"><span class="text-sm font-semibold" style="color: #DD2D4A;">€45.00</span></td>
                                <td class="px-6 py-4"><span class="text-sm text-stone-500">Les Lilas Coloc</span></td>
                                <td class="px-6 py-4"><span class="px-2.5 py-1 rounded-full text-xs font-medium" style="background: rgba(68,255,210,0.15); color: #0d9488;">✓ Paid</span></td>
                                <td class="px-6 py-4"><span class="text-xs text-stone-300">Settled</span></td>
                            </tr>
                            <tr class="settle-row" id="row4">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-semibold" style="background:#E1BB80; color:#563F1B;">AL</div>
                                        <span class="text-sm text-stone-700">Alice L.</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-semibold" style="background:#C5E0D8; color:#0d9488;">SL</div>
                                        <span class="text-sm text-stone-700">Sophie L.</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4"><span class="text-sm font-semibold" style="color: #DD2D4A;">€30.00</span></td>
                                <td class="px-6 py-4"><span class="text-sm text-stone-500">Montmartre House</span></td>
                                <td class="px-6 py-4"><span class="px-2.5 py-1 rounded-full text-xs font-medium" style="background: rgba(221,45,74,0.1); color: #DD2D4A;">Pending</span></td>
                                <td class="px-6 py-4">
                                    <button onclick="markPaid('row4', this)" class="px-3 py-1.5 rounded-lg text-xs font-medium hover:opacity-90 active:scale-95 transition-all" style="background: #44FFD2; color: #0d5e50;">Mark Paid</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Member Balance Cards -->
            <div class="space-y-4">
                <h2 class="font-serif text-xl text-stone-800 px-1">Member Balances</h2>

                <!-- Each member balance -->
                <div class="rounded-2xl p-5 shadow-sm border border-stone-200" style="background: white;">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-semibold" style="background:#E1BB80; color:#563F1B;">AL</div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-stone-800">Alice Laurent</p>
                            <p class="text-xs text-stone-400">Rue de la Paix</p>
                        </div>
                        <span class="text-sm font-bold" style="color: #0d9488;">+€45.00</span>
                    </div>
                    <div class="h-1.5 rounded-full" style="background: #f0ede8;">
                        <div class="h-1.5 rounded-full" style="background: #0d9488; width: 70%;"></div>
                    </div>
                </div>

                <div class="rounded-2xl p-5 shadow-sm border border-stone-200" style="background: white;">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-semibold" style="background:#CEABB1; color:#563F1B;">MB</div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-stone-800">Marc Beaumont</p>
                            <p class="text-xs text-stone-400">Rue de la Paix</p>
                        </div>
                        <span class="text-sm font-bold" style="color: #DD2D4A;">-€120.50</span>
                    </div>
                    <div class="h-1.5 rounded-full" style="background: #f0ede8;">
                        <div class="h-1.5 rounded-full" style="background: #DD2D4A; width: 85%;"></div>
                    </div>
                </div>

                <div class="rounded-2xl p-5 shadow-sm border border-stone-200" style="background: white;">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-semibold" style="background:#C5E0D8; color:#0d9488;">SL</div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-stone-800">Sophie Leclerc</p>
                            <p class="text-xs text-stone-400">Rue de la Paix</p>
                        </div>
                        <span class="text-sm font-bold" style="color: #0d9488;">+€75.20</span>
                    </div>
                    <div class="h-1.5 rounded-full" style="background: #f0ede8;">
                        <div class="h-1.5 rounded-full" style="background: #0d9488; width: 55%;"></div>
                    </div>
                </div>

                <div class="rounded-2xl p-5 shadow-sm border border-stone-200" style="background: white;">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-semibold" style="background:#DCE2AA; color:#3d4a0a;">NK</div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-stone-800">Nina Kaufmann</p>
                            <p class="text-xs text-stone-400">Les Lilas Coloc</p>
                        </div>
                        <span class="text-sm font-bold" style="color: #DD2D4A;">-€10.00</span>
                    </div>
                    <div class="h-1.5 rounded-full" style="background: #f0ede8;">
                        <div class="h-1.5 rounded-full" style="background: #DD2D4A; width: 20%;"></div>
                    </div>
                </div>

                <div class="rounded-2xl p-5 shadow-sm border border-stone-200" style="background: white;">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-semibold" style="background:#C0C0C0; color:#374151;">JD</div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-stone-800">Jean Dubois</p>
                            <p class="text-xs text-stone-400">Rue de la Paix</p>
                        </div>
                        <span class="text-sm font-bold" style="color: #DD2D4A;">-€210.00</span>
                    </div>
                    <div class="h-1.5 rounded-full" style="background: #f0ede8;">
                        <div class="h-1.5 rounded-full" style="background: #DD2D4A; width: 95%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div id="footer-placeholder"></div>

    <!-- Mark Paid Toast -->
    <div id="toast" class="hidden fixed bottom-6 right-6 z-50 px-5 py-3 rounded-xl shadow-xl text-sm font-medium text-white" style="background: #0d9488;">
        ✓ Settlement marked as paid!
    </div>









    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }

        .font-serif {
            font-family: 'DM Serif Display', serif;
        }

        .settle-row {
            transition: background 0.12s;
        }

        .settle-row:hover {
            background: rgba(198, 159, 137, 0.07);
        }

        .modal-backdrop {
            animation: fadeIn 0.2s ease;
        }

        .modal-box {
            animation: slideUp 0.25s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .balance-bar {
            height: 6px;
            border-radius: 99px;
            transition: width 0.6s ease;
        }
    </style>



    <script>
        async function loadComponent(id, file) {
            try {
                const r = await fetch(file);
                if (r.ok) document.getElementById(id).innerHTML = await r.text();
            } catch (e) {}
        }
        loadComponent('header-placeholder', 'header.html');
        loadComponent('footer-placeholder', 'footer.html');

        function markPaid(rowId, btn) {
            const row = document.getElementById(rowId);
            // Update status cell
            const statusCell = row.cells[4];
            statusCell.innerHTML = '<span class="px-2.5 py-1 rounded-full text-xs font-medium" style="background: rgba(68,255,210,0.15); color: #0d9488;">✓ Paid</span>';
            // Update action cell
            btn.parentElement.innerHTML = '<span class="text-xs text-stone-300">Settled</span>';
            // Toast
            const toast = document.getElementById('toast');
            toast.classList.remove('hidden');
            setTimeout(() => toast.classList.add('hidden'), 2800);
        }
    </script>
</body>
@endsection