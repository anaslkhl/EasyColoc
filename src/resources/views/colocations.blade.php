@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-[#0B0F1A] text-white">
  <div class="max-w-6xl mx-auto px-6 py-16">

    <!-- HEADER -->
    <div class="bg-[#111827] border border-[#1F2937] rounded-3xl p-10 space-y-8">

      <!-- Top Row -->
      <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-6">
        <div class="space-y-4">
          <h1 class="text-4xl font-bold text-[#D4AF37]">
            {{ $colocation->name }}
          </h1>
          <p class="text-gray-400 max-w-2xl">
            {{ $colocation->description }}
          </p>
        </div>

        <span class="px-5 py-2 text-sm rounded-full font-semibold
                    {{ $colocation->status === 'active'
                        ? 'bg-emerald-500/20 text-emerald-400'
                        : 'bg-red-500/20 text-red-400' }}">
          {{ ucfirst($colocation->status) }}
        </span>
      </div>

      <!-- Owner -->
      <div class="border-t border-[#1F2937] pt-6">
        <p class="text-sm text-gray-500">Owner</p>
        <p class="text-lg font-semibold text-white mt-1">
          {{ $colocation->owner->name ?? 'N/A' }}
        </p>
      </div>

      <!-- ACTION BUTTONS -->
      <div class="flex flex-wrap gap-4 pt-6 border-t border-[#1F2937]">

        <!-- Invite Member -->
        <a href="{{ route('invite.invitation', $colocation) }}"
          class="px-6 py-3 rounded-xl bg-[#1E3A8A] hover:bg-[#1D4ED8] transition font-semibold text-sm text-white">
          Invite Member
        </a>

        <!-- Add Category -->
        <button onclick="toggleForm('categoryForm')"
          class="px-6 py-3 rounded-xl bg-[#D4AF37] hover:bg-[#bfa133] transition font-semibold text-sm text-black">
          Add Category
        </button>

        <!-- Add Expense -->
        <a href="{{ route('expenses.show') }}"
          class="px-6 py-3 rounded-xl bg-[#111827] border border-[#D4AF37] hover:bg-[#1F2937] transition font-semibold text-sm text-[#D4AF37]">
          Add Expense
        </a>

      </div>

    </div>

    <!-- GRID SECTION -->
    <div class="grid md:grid-cols-2 gap-10 mt-12">

      <!-- CATEGORIES -->
      <div class="bg-[#111827] border border-[#1F2937] rounded-3xl p-8">
        <h2 class="text-xl font-bold text-[#D4AF37] mb-6">Categories</h2>
        <div class="space-y-4">
          @forelse($colocation->categories as $category)
          <div class="flex justify-between items-center p-4 rounded-xl bg-[#0F172A] border border-[#1F2937] hover:border-[#D4AF37]/50 transition">
            <span class="font-medium text-white">{{ $category->name }}</span>
          </div>
          @empty
          <p class="text-gray-500 text-sm">No categories added yet.</p>
          @endforelse
        </div>
      </div>

      <!-- MEMBERS -->
      <div class="bg-[#111827] border border-[#1F2937] rounded-3xl p-8">
        <h2 class="text-xl font-bold text-[#D4AF37] mb-6">Members</h2>
        <div class="space-y-4">
          @forelse($colocation->users as $user)
          <div class="flex justify-between items-center p-4 rounded-xl bg-[#0F172A] border border-[#1F2937] hover:border-[#1E3A8A] transition">
            <span class="font-medium text-white">{{ $user->name }}</span>
            <span class="text-xs px-3 py-1 rounded-full {{ $colocation->owner_id === $user->id ? 'bg-[#D4AF37]/20 text-[#D4AF37]' : 'bg-[#D4AF37]/20 text-[#D4AF37]' }}">
              {{ $colocation->owner_id === $user->id ? 'Owner' : 'Member' }}
            </span>
          </div>
          @empty
          <p class="text-gray-500 text-sm">No members yet.</p>
          @endforelse
        </div>
      </div>

    </div>

  </div>
</div>

<!-- CATEGORY FORM MODAL -->
<div id="categoryForm" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
  <div class="bg-[#111318] p-8 rounded-2xl w-96 shadow-xl relative">
    <h3 class="text-lg font-bold text-white mb-4">Add a Category</h3>
    <form action="{{ route('categories.store', $colocation) }}" method="POST" class="flex flex-col gap-4">
      @csrf
      <input type="text" name="name" placeholder="Category name" required
        class="w-full px-4 py-2 rounded-xl bg-gray-900 border border-gray-700 text-white outline-none">
      <div class="flex justify-end gap-2">
        <button type="button" onclick="toggleForm('categoryForm')"
          class="px-4 py-2 rounded-xl bg-gray-700 hover:bg-gray-600 text-white transition">Cancel</button>
        <button type="submit"
          class="px-4 py-2 rounded-xl bg-[#D4AF37] hover:bg-[#bfa133] text-black font-bold transition">Add</button>
      </div>
    </form>
    <button onclick="toggleForm('categoryForm')" class="absolute top-3 right-3 text-gray-400 hover:text-white">&times;</button>
  </div>
</div>

<script>
  function toggleForm(formId) {
    document.getElementById(formId).classList.toggle('hidden');
  }
</script>

@endsection