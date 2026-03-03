@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#0B0F1A] text-white px-6 py-16">

  @if($colocation)
  <div class="bg-[#111827] border border-[#1F2937] rounded-3xl p-10 space-y-8">

    <!-- Colocation Header -->
    <div class="flex flex-col md:flex-row md:justify-between gap-4 items-start md:items-center">
      <div>
        <h1 class="text-4xl font-bold text-[#D4AF37]">{{ $colocation->name }}</h1>
        <p class="text-gray-400 mt-2 max-w-md">{{ $colocation->description }}</p>
      </div>
      <span class="px-5 py-2 text-sm rounded-full font-semibold
                    {{ $colocation->status === 'active'
                        ? 'bg-emerald-500/20 text-emerald-400'
                        : 'bg-red-500/20 text-red-400' }}">
        {{ ucfirst($colocation->status) }}
      </span>
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-wrap gap-4">
      <a href="{{ route('invite.invitation', $colocation) }}" class="px-6 py-3 rounded-xl bg-[#1E3A8A] hover:bg-[#1D4ED8] font-semibold text-sm text-white transition">
        Invite Member
      </a>

      <button onclick="toggleForm('categoryForm')" class="px-6 py-3 rounded-xl bg-[#D4AF37] hover:bg-[#bfa133] font-semibold text-sm text-black transition">
        Add Category
      </button>

      <a href="{{ route('expenses.index', $colocation) }}" class="px-6 py-3 rounded-xl bg-[#111827] border border-[#D4AF37] hover:bg-[#1F2937] font-semibold text-sm text-[#D4AF37] transition">
        Manage Expenses
      </a>

      <a href="{{ route('settlements.index', $colocation) }}" class="px-6 py-3 rounded-xl bg-[#111827] border border-[#C9A84C] hover:bg-[#1F172A] font-semibold text-sm text-[#C9A84C] transition">
        View Settlements
      </a>
    </div>
    
    <!-- Members Table -->
    <div class="mt-6 bg-[#1E1E2A] rounded-2xl p-6">
      <h2 class="text-2xl font-semibold text-[#D4AF37] mb-4">Members</h2>
      <div class="overflow-x-auto">
        <table class="min-w-full table-auto text-left">
          <thead>
            <tr class="text-gray-400 uppercase text-sm border-b border-gray-700">
              <th class="px-4 py-2">#</th>
              <th class="px-4 py-2">Name</th>
              <th class="px-4 py-2">Email</th>
              <th class="px-4 py-2">Role</th>
            </tr>
          </thead>
          <tbody>
            @foreach($colocation->users as $index => $member)
            <tr class="border-b border-gray-700 hover:bg-gray-800 transition">
              <td class="px-4 py-3">{{ $index + 1 }}</td>
              <td class="px-4 py-3 font-medium">{{ $member->name }}</td>
              <td class="px-4 py-3 text-gray-300">{{ $member->email }}</td>
              <td class="px-4 py-3 text-gray-300">{{ $member->pivot->role ?? 'Member' }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    
    <form action="{{ route('colocation.exit') }}" method="POST"
      onsubmit="return confirm('Are you sure you want to exit this colocation?')">
      @csrf
      <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
        Exit Colocation
      </button>
    </form>
    <!-- Categories -->
    <div class="mt-6 bg-[#1E1E2A] rounded-2xl p-6">
      <h2 class="text-2xl font-semibold text-[#D4AF37] mb-4">Categories</h2>
      <div class="flex flex-wrap gap-3">
        @foreach($colocation->categories as $category)
        <div class="px-4 py-2 rounded-full bg-[#2C2F48] text-white font-medium hover:bg-[#3A3F5C] transition">
          {{ $category->name }}
        </div>
        @endforeach
        @if($colocation->categories->isEmpty())
        <p class="text-gray-400">No categories yet.</p>
        @endif
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

  @else
  <div class="text-center py-20">
    <p class="text-gray-400 mb-4">You don’t have any colocation yet.</p>
    <a href="{{ route('colocations.create') }}" class="px-6 py-3 rounded-xl bg-[#D4AF37] text-black font-semibold">Create Colocation</a>
  </div>
  @endif

  @if($colocation && Auth::id() === $colocation->owner_id && $colocation->status !== 'cancelled')
  <form action="{{ route('cancel', $colocation->id) }}" method="GET"
    onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette colocation ?');">
    <button type="submit"
      class="px-4 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition-colors">
      Annuler la colocation
    </button>
  </form>
  @endif

  @if($colocation && $colocation->status === 'cancelled')
  <span class="px-3 py-1 text-sm font-semibold text-red-700 bg-red-100 rounded-full">
    Colocation annulée
  </span>
  @endif

</div>

<script>
  function toggleForm(formId) {
    document.getElementById(formId).classList.toggle('hidden');
  }
</script>
@endsection