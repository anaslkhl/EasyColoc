@extends('layouts.app')

@section('content')
<main class="flex flex-col items-center justify-center min-h-screen bg-gray-50 px-4 sm:px-6 lg:px-8">

    <!-- Logo -->
    <div class="mb-8">
        <img src="{{ asset('img//home/ca-us/Desktop/working_dir/EasyColoc/src/resources/img/ChatGPT Image Feb 23, 2026, 02_29_18 PM.png') }}" alt="Site Logo" class="w-32 h-auto mx-auto">
    </div>

    <!-- Hero Title -->
    <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 text-center mb-4">Welcome, Anas 👋</h1>

    <!-- Description -->
    <p class="text-lg sm:text-xl text-gray-600 text-center max-w-2xl mb-8">
        Discover everything you need in one place. Manage your colocations, expenses, and members easily, all from a professional dashboard.
    </p>

    <!-- Call-to-Action Buttons -->
    <div class="flex flex-col sm:flex-row gap-4">
        <a href="#" class="px-6 py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition">
            Get Started
        </a>
        <a href="#" class="px-6 py-3 bg-gray-200 text-gray-800 rounded-lg font-medium hover:bg-gray-300 transition">
            Learn More
        </a>
    </div>

    <!-- Optional Illustration -->
    <div class="mt-12 w-full max-w-4xl">
        <img src="{{ asset('images/landing-illustration.png') }}" alt="Illustration" class="w-full h-auto rounded-lg shadow-lg">
    </div>

</main>
@endsection