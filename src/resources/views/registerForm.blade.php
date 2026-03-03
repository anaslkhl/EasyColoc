@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-[#0C2B4E] px-4">
    <div class="bg-[#1A3D64] p-8 rounded-2xl shadow-2xl w-full max-w-md">
        <h2 class="text-3xl font-bold text-white mb-6 text-center">Create Your Account</h2>

        <form action="{{ url('create') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-gray-200 mb-1">Full Name</label>
                <input type="text" name="name" placeholder="John Doe"
                    class="w-full px-4 py-3 rounded-xl bg-[#1D546C] text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#473472]" required>
            </div>

            <div>
                <label class="block text-gray-200 mb-1">Role</label>
                <select name="role" class="w-full px-4 py-3 rounded-xl bg-[#1D546C] text-white focus:outline-none focus:ring-2 focus:ring-[#473472]">
                    <option value="member">Member</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-200 mb-1">Email</label>
                <input type="email" name="email" placeholder="john@example.com"
                    class="w-full px-4 py-3 rounded-xl bg-[#1D546C] text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#473472]" required>
            </div>

            <div>
                <label class="block text-gray-200 mb-1">Password</label>
                <input type="password" name="password" placeholder="********"
                    class="w-full px-4 py-3 rounded-xl bg-[#1D546C] text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#473472]" required>
                <p class="text-gray-400 text-sm mt-1">Minimum 8 characters</p>
            </div>

            <div>
                <label class="block text-gray-200 mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" placeholder="********"
                    class="w-full px-4 py-3 rounded-xl bg-[#1D546C] text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#473472]" required>
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" id="terms" name="terms" class="w-4 h-4 text-purple-600 bg-gray-700 rounded focus:ring-purple-500" required>
                <label for="terms" class="text-gray-300 text-sm">
                    I agree to the <a href="#" class="text-purple-400 hover:underline">Terms & Conditions</a>
                </label>
            </div>

            <button type="submit" class="w-full py-3 bg-[#473472] hover:bg-purple-700 rounded-xl text-white font-semibold transition-all duration-300">
                Sign Up
            </button>
        </form>

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
            Already have an account? <a href="{{ route('loginForm') }}" class="text-purple-400 hover:underline">Login</a>
        </p>
    </div>
</div>
@endsection