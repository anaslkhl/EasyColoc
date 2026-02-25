@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen ">
    <div class="bg-[#1A3D64] p-8 rounded-2xl shadow-lg w-full max-w-md">
        <h2 class="text-3xl font-bold text-white mb-6 text-center">Create New Colocation</h2>

        <form action="{{ route('colocations.save') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Colocation Name -->
            <div>
                <label for="name" class="block text-gray-200 mb-1">Colocation Name</label>
                <input type="text" id="name" name="name" placeholder="My Awesome Colocation"
                    class="w-full px-4 py-3 rounded-lg bg-[#1D546C] text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#473472]" required>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-gray-200 mb-1">Description (optional)</label>
                <textarea id="description" name="description" placeholder="Add a description..."
                    class="w-full px-4 py-3 rounded-lg bg-[#1D546C] text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#473472]" rows="4"></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full py-3 bg-[#473472] hover:bg-purple-700 rounded-lg text-white font-semibold transition-all duration-300">
                Create Colocation
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

        <!-- Back Link -->
        <p class="text-gray-400 mt-6 text-center">
            <a href="{{ route('colocations.index') }}" class="text-purple-400 hover:underline">Back to Colocations</a>
        </p>
    </div>
</div>


@endsection