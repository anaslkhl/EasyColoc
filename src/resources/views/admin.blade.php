@extends('layouts.app')
@section('content')
<div class="min-h-screen flex flex-col bg-[#0B0F1A] text-white">

  <!-- Admin Header -->
  <div class="rounded-2xl p-6 mb-8 flex flex-col md:flex-row md:items-center gap-4 bg-gradient-to-r from-[#DD2D4A] to-[#94778B] shadow-lg">
    <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center">
      <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
      </svg>
    </div>
    <div>
      <h1 class="font-serif text-2xl">Admin Dashboard</h1>
      <p class="text-white/70 text-sm mt-1">Full platform oversight and management tools</p>
    </div>
    <div class="ml-auto text-right hidden sm:block">
      <p class="text-xs text-white/60">Logged in as</p>
      <p class="text-sm font-semibold">{{ auth()->user()->name }}</p>
    </div>
  </div>

  <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-4 space-y-8">

    <!-- Global Stats -->
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
      <article class="rounded-2xl p-5 shadow-lg bg-[#111827] flex flex-col items-start gap-2 hover:scale-105 transition-transform">
        <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-3 bg-gray-700/20">
          <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
        </div>
        <p class="text-2xl font-semibold">{{ $totalUsers }}</p>
        <p class="text-xs text-gray-400">Total Users</p>
      </article>

      <article class="rounded-2xl p-5 shadow-lg bg-[#111827] flex flex-col items-start gap-2 hover:scale-105 transition-transform">
        <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-3 bg-gray-700/20">
          <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
          </svg>
        </div>
        <p class="text-2xl font-semibold">{{ $totalColocations }}</p>
        <p class="text-xs text-gray-400">Total Colocations</p>
      </article>

      <article class="rounded-2xl p-5 shadow-lg bg-[#111827] flex flex-col items-start gap-2 hover:scale-105 transition-transform">
        <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-3 bg-gray-700/20">
          <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </div>
        <p class="text-2xl font-semibold">€{{ number_format($totalExpenses, 0, '.', ',') }}</p>
        <p class="text-xs text-gray-400">Total Expenses</p>
      </article>

      <article class="rounded-2xl p-5 shadow-lg bg-[#111827] flex flex-col items-start gap-2 hover:scale-105 transition-transform">
        <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-3 bg-gray-700/20">
          <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
          </svg>
        </div>
        <p class="text-2xl font-semibold">{{ $bannedUsers }}</p>
        <p class="text-xs text-gray-400">Banned Users</p>
      </article>
    </section>

    <!-- Users Table -->
    <div class="rounded-2xl shadow-lg overflow-hidden bg-[#111827]">
      <div class="px-6 py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-gray-700">
        <h2 class="font-serif text-xl">User Management</h2>
      </div>
      <div class="overflow-x-auto">
        <table class="w-full text-left text-gray-300">
          <thead class="bg-[#1E1E2A] text-gray-400 uppercase text-xs">
            <tr>
              <th class="px-6 py-3">User</th>
              <th class="px-6 py-3">Email</th>
              <th class="px-6 py-3">Joined</th>
              <th class="px-6 py-3">Status</th>
              <th class="px-6 py-3">Toggle</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-700">
            @foreach($users as $user)
            <tr class="hover:bg-gray-800 transition">
              <td class="px-6 py-4">{{ $user->name }}</td>
              <td class="px-6 py-4">{{ $user->email }}</td>
              <td class="px-6 py-4">{{ $user->created_at->format('M Y') }}</td>
              <td class="px-6 py-4">
                <span class="px-2 py-1 rounded-full text-xs font-medium {{ $user->is_banned ? 'bg-red-700/30' : 'bg-green-700/30' }}">
                  {{ $user->is_banned ? 'Banned' : 'Active' }}
                </span>
              </td>
              <td class="px-6 py-4">
                <form method="POST" action="{{ route('admin.toggleUser', $user) }}">
                  @csrf
                  @method('PATCH')
                  <button type="submit"
                    class="px-3 py-1 rounded-xl bg-gray-700 hover:bg-gray-600 text-xs">
                    {{ $user->is_banned ? 'Unban' : 'Ban' }}
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

  </main>
</div>
@endsection