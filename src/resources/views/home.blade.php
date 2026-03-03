@extends('layouts.app')

@section('content')
<main
    class="flex-col items-center justify-center min-h-screen bg-cover bg-center bg-no-repeat"
    style="background-image: url('{{ asset('images/pexels-felix-mittermeier-957085.jpg') }}');">
    >
    <div class="absolute inset-0 bg-black/40"></div>

    <!-- Content -->
    <div class="relative z-10 flex flex-col items-center text-center px-4 sm:px-6 lg:px-8">
        <!-- Logo -->
        <div class="mb-8">
            <img src="{{ asset('images/back.png') }}" alt="Site Logo" class="w-32 h-auto mx-auto">
        </div>

        <!-- Hero Title -->
        <h1 class="text-5xl font-bold text-white mb-4">Welcome, 👋</h1>

        <!-- Description -->
        <p class="text-lg sm:text-xl text-gray-200 max-w-2xl mb-8">
            Discover everything you need in one place. Manage your colocations, expenses, and members easily, all from a professional dashboard.
        </p>

        <!-- Call-to-Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#" class="px-6 py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition">
                Get Started
            </a>
            <a href="#" class="px-6 py-3 bg-white/20 backdrop-blur-sm text-white rounded-lg font-medium hover:bg-white/40 transition">
                Learn More
            </a>
        </div>

    </div>

</main>
@endsection