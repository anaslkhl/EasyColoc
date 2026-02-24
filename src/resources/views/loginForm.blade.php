@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-[#0C2B4E]">
    <div class="bg-[#1A3D64] p-8 rounded-2xl shadow-lg w-full max-w-md">
        <h2 class="text-3xl font-bold text-white mb-6 text-center">Welcome Back</h2>

        <form action="{{ route('login') }}" method="GET" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-gray-200 mb-1">Email</label>
                <input type="email" id="email" name="email" placeholder="john@example.com"
                    class="w-full px-4 py-3 rounded-lg bg-[#1D546C] text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#473472]" required>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-gray-200 mb-1">Password</label>
                <input type="password" id="password" name="password" placeholder="********"
                    class="w-full px-4 py-3 rounded-lg bg-[#1D546C] text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#473472]" required>
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember"
                        class="w-4 h-4 text-purple-600 bg-gray-700 rounded focus:ring-purple-500">
                    <label for="remember" class="ml-2 text-gray-300 text-sm">Remember Me</label>
                </div>

                <a href="{{ url('password.request') }}" class="text-purple-400 hover:underline text-sm">Forgot Password?</a>
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full py-3 bg-[#473472] hover:bg-purple-700 rounded-lg text-white font-semibold transition-all duration-300">
                Login
            </button>
        </form>

        <!-- Validation Errors -->
        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mt-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <p class="text-gray-400 mt-6 text-center">
            Don't have an account? <a href="{{ route('register') }}" class="text-purple-400 hover:underline">Sign Up</a>
        </p>
    </div>
</div>
@endsection