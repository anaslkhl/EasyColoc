@extends('layouts.app')
@section('content')
<main class="bg-gray-900 text-gray-200 min-h-screen py-10">
    <div class="container mx-auto px-4 max-w-lg">

        <h1 class="text-2xl font-bold mb-4">Inviter un membre à {{ $colocation->name }}</h1>

        @if(session('success'))
        <div class="mb-4 px-4 py-2 bg-green-700 text-white rounded">{{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="mb-4 px-4 py-2 bg-red-700 text-white rounded">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('invite.send', $colocation) }}" class="bg-gray-800 p-6 rounded-2xl shadow-md space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Adresse e-mail</label>
                <input type="email" name="email" id="email" required
                    class="w-full px-3 py-2 rounded-lg bg-gray-700 text-gray-200 border border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <button type="submit" class="w-full px-4 py-2 bg-indigo-600 hover:bg-indigo-500 rounded-lg text-white font-semibold transition">
                Envoyer l'invitation
            </button>
        </form>
    </div>
</main>
@endsection