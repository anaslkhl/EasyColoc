@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center">
    <div class="bg-[#1A3D64] p-8 rounded-2xl shadow-lg w-full max-w-md">
        <h2 class="text-3xl font-bold text-white mb-6 text-center">Create Your Account</h2>
        <form action="{{ url('create') }}" method="POST" class="space-y-5">
            @csrf
            <!-- Full Name -->
            <div>
                <label class="block text-gray-200 mb-1" for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="John Doe"
                    class="w-full px-4 py-3 rounded-lg bg-[#1D546C] text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#473472]" required>
            </div>


            <!-- Role -->

            <div>
                <select name="role" id="role" name="role" class="w-full px-4 py-3 rounded-lg bg-[#1D546C] text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#473472]">
                    <option value="member">member</option>
                </select>

                <!-- Email -->
                <div>
                    <label class="block text-gray-200 mb-1" for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="john@example.com"
                        class="w-full px-4 py-3 rounded-lg bg-[#1D546C] text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#473472]" required>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-gray-200 mb-1" for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="********"
                        class="w-full px-4 py-3 rounded-lg bg-[#1D546C] text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#473472]" required>
                    <p class="text-gray-400 text-sm mt-1">Minimum 8 characters</p>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-gray-200 mb-1" for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="password_confirmation" placeholder="********"
                        class="w-full px-4 py-3 rounded-lg bg-[#1D546C] text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#473472]" required>
                </div>

                <!-- Terms -->
                <div class="flex items-center">
                    <input type="checkbox" id="terms" name="terms" class="w-4 h-4 text-purple-600 bg-gray-700 rounded focus:ring-purple-500" required>
                    <label for="terms" class="ml-2 text-gray-300 text-sm">I agree to the <a href="#"
                            class="text-purple-400 hover:underline">Terms & Conditions</a></label>
                </div>

                <!-- Submit -->
                <button type="submit"
                    class="w-full py-3 bg-[#473472] hover:bg-purple-700 rounded-lg text-white font-semibold transition-all duration-300">Sign
                    Up</button>
        </form>
        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <p class="text-gray-400 mt-6 text-center">Already have an account? <a href="loginForm"
                class="text-purple-400 hover:underline">Login</a></p>
    </div>
</div>
@endsection 