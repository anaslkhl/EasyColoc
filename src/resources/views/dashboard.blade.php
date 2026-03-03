@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-950 text-gray-200 p-8">

  <!-- Header -->
  <div class="flex justify-between items-center mb-8">
    <div>
      <h1 class="text-3xl font-bold">Dashboard</h1>
      <p class="text-gray-400">Welcome back, {{ $user->name }}</p>
    </div>

    <div class="bg-gray-800 px-4 py-2 rounded-lg">
      @if($isOwner)
      <span class="text-green-400 font-semibold">Owner</span>
      @else
      <span class="text-blue-400 font-semibold">Member</span>
      @endif
    </div>
  </div>

  <!-- Balance Cards -->
  <div class="grid md:grid-cols-4 gap-6 mb-10">

    <div class="bg-gray-900 p-6 rounded-xl shadow-lg">
      <p class="text-gray-400">Total Paid</p>
      <h2 class="text-2xl font-bold text-green-400">
        {{ number_format($totalPaid,2) }} DH
      </h2>
    </div>

    <div class="bg-gray-900 p-6 rounded-xl shadow-lg">
      <p class="text-gray-400">You Owe</p>
      <h2 class="text-2xl font-bold text-red-400">
        {{ number_format($totalOwes,2) }} DH
      </h2>
    </div>

    <div class="bg-gray-900 p-6 rounded-xl shadow-lg">
      <p class="text-gray-400">Owed To You</p>
      <h2 class="text-2xl font-bold text-blue-400">
        {{ number_format($totalOwedToUser,2) }} DH
      </h2>
    </div>

    <div class="bg-gray-900 p-6 rounded-xl shadow-lg">
      <p class="text-gray-400">Your Balance</p>

      @if($balance >= 0)
      <h2 class="text-2xl font-bold text-green-400">
        +{{ number_format($balance,2) }} DH
      </h2>
      @else
      <h2 class="text-2xl font-bold text-red-400">
        {{ number_format($balance,2) }} DH
      </h2>
      @endif
    </div>

  </div>

  <!-- User Info Section -->
  <div class="bg-gray-900 p-6 rounded-xl shadow-lg mb-8">
    <h2 class="text-xl font-bold mb-4">Your Information</h2>

    <div class="grid md:grid-cols-2 gap-4 text-gray-300">
      <p><strong>Name:</strong> {{ $user->name }}</p>
      <p><strong>Email:</strong> {{ $user->email }}</p>
      <p><strong>Joined:</strong> {{ $user->created_at->format('d M Y') }}</p>

      @if($colocation)
      <p><strong>Colocation:</strong> {{ $colocation->name }}</p>
      @endif
    </div>
  </div>

  <!-- Owner Section -->
  @if($isOwner)
  <div class="bg-gray-900 p-6 rounded-xl shadow-lg">
    <h2 class="text-xl font-bold mb-4">Owner Controls</h2>

    <div class="flex gap-4">
      <a href="{{ route('expenses.index') }}"
        class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded-lg">
        Add Expense
      </a>

      <a href="{{ route('expenses.index') }}"
        class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg">
        Manage Members
      </a>
    </div>
  </div>
  @endif

</div>
@endsection