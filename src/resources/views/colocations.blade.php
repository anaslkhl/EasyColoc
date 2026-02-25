@extends('layouts.app')
@section('content')

<main class="bg-gray-900 text-gray-200 min-h-screen py-10">
  <div class="container mx-auto px-4">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-gray-400 mb-6">
      <a href="{{ route('home') }}" class="hover:text-indigo-400 transition">Mes colocations</a>
      <span>/</span>
      <span class="text-gray-500">{{ $colocation->name }}</span>
    </nav>

    {{-- Page header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8 bg-gray-800 rounded-2xl p-6 shadow-md">
      <div>
        <h1 class="text-3xl font-extrabold">{{ $colocation->name }}</h1>
        <p class="text-gray-400 mt-1">
          Propriétaire : <strong class="text-gray-200">{{ $colocation->owner->name }}</strong>
          · <span class="text-teal-400 font-semibold">{{ $colocation->activeMembers->count() }} membres</span>
        </p>
      </div>
      <div class="flex flex-wrap gap-2">
        @if($isOwner)
        <a href="{{ route('invite.invitation', $colocation) }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 rounded-lg text-sm font-semibold transition">
          Inviter un membre
        </a>
        <form method="POST" action="{{ route('cancel', $colocation) }}" onsubmit="return confirm('Annuler définitivement cette colocation ?')">
          @csrf
          <button type="submit" class="px-4 py-2 bg-red-700 hover:bg-red-600 rounded-lg text-sm font-semibold transition">
            Annuler la colocation
          </button>
        </form>
        @else
        <form method="POST" action="{{ route('leave', $colocation) }}" onsubmit="return confirm('Quitter cette colocation ?')">
          @csrf
          <button type="submit" class="px-4 py-2 bg-red-700 hover:bg-red-600 rounded-lg text-sm font-semibold transition">
            Quitter la colocation
          </button>
        </form>
        @endif
      </div>
    </div>

    {{-- Main layout --}}
    <div class="flex flex-col lg:flex-row gap-6">

      {{-- LEFT: Members --}}
      @if($isOwner)
      <aside class="w-full lg:w-72">
        <div class="bg-gray-800 rounded-2xl shadow-md overflow-hidden">
          <div class="px-5 py-4 flex items-center justify-between border-b border-gray-700">
            <h3 class="uppercase tracking-widest font-semibold text-gray-300 text-sm">Membres</h3>
            <span class="bg-indigo-900/50 text-indigo-300 px-2 py-0.5 rounded-full text-xs font-semibold">{{ $colocation->activeMembers->count() }}</span>
          </div>
          <ul class="divide-y divide-gray-700">
            @foreach($colocation->activeMembers as $member)
            <li class="flex items-center justify-between px-5 py-3 hover:bg-gray-700 transition">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-xs font-bold">
                  {{ strtoupper(substr($member->name, 0, 2)) }}
                </div>
                <div>
                  <p class="text-sm font-medium">{{ $member->name }}
                    @if($member->id === auth()->id())
                    <em class="text-gray-400 text-xs">(vous)</em>
                    @endif
                  </p>
                  <p class="text-xs text-gray-400">{{ $member->id === $colocation->owner_id ? 'Owner' : 'Membre' }}</p>
                </div>
              </div>
              @if($isOwner && $member->id !== $colocation->owner_id)
              <form method="POST" action="" onsubmit="return confirm('Retirer ce membre ?')">
                @csrf
                <button type="submit" class="text-red-400 hover:text-red-500 transition text-sm font-semibold">Retirer</button>
              </form>
              @endif
            </li>
            @endforeach
          </ul>
        </div>
      </aside>
      @endif

      {{-- RIGHT: Categories + Expenses --}}
      <div class="flex-1 flex flex-col gap-6">

        {{-- Section header --}}
        <div class="flex items-center justify-between">
          <h2 class="text-lg font-bold">Catégories & Dépenses</h2>

          {{-- Button to show the form --}}
          @if($isOwner)
          <button data-toggle="category-form" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-sm font-semibold rounded-lg transition">
            + Ajouter une catégorie
          </button>
          @endif

          {{-- Create Category Form (hidden by default) --}}
          <div data-section="category-form" class="toggle-section hidden mt-4 bg-gray-800 p-6 rounded-lg shadow-md">
            <form method="POST" action="{{ route('categories.store', $colocation) }}"> @csrf
              <div class="mb-4">
                <label class="block text-sm font-medium text-gray-300 mb-1" for="name">Nom de la catégorie</label>
                <input type="text" name="name" id="name" required
                  class="w-full px-3 py-2 rounded-lg bg-gray-700 text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 border border-gray-600">
              </div>
              <div class="flex justify-end gap-2">
                <button type="button" class="close-section px-4 py-2 bg-gray-600 hover:bg-gray-500 text-sm font-semibold rounded-lg transition">
                  Annuler
                </button>
                <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-sm font-semibold rounded-lg transition">
                  Créer
                </button>
              </div>
            </form>
          </div>



          @forelse($colocation->categories as $category)
          <div class="bg-gray-800 rounded-2xl shadow-md overflow-hidden">

            {{-- Category Header --}}
            <div class="px-5 py-4 flex items-center justify-between border-b border-gray-700">
              <h3 class="font-bold">{{ $category->name }}</h3>
              <div class="flex gap-2">
                <a href="{{ route('create.exponse', $category) }}" class="px-3 py-1 bg-indigo-600 hover:bg-indigo-500 text-xs font-semibold rounded-lg transition">+ Dépense</a>
                @if($isOwner)
                <form method="POST" action="" onsubmit="return confirm('Supprimer cette catégorie et ses dépenses ?')">
                  @csrf @method('DELETE')
                  <button type="submit" class="px-3 py-1 text-red-400 hover:text-red-500 text-xs font-semibold transition rounded-lg">Supprimer</button>
                </form>
                @endif
              </div>
            </div>


            {{-- Expenses Table --}}
           

          </div>
          @empty
          <div class="bg-gray-800 rounded-2xl p-10 text-center text-gray-400">
            <p>Aucune catégorie pour l'instant.</p>
            @if($isOwner)
            <a href="{{ route('create.category', $colocation) }}" class="text-indigo-400 hover:text-indigo-300 font-semibold mt-2 inline-block">Créer la première catégorie →</a>
            @endif
          </div>
          @endforelse

        </div>

      </div>

    </div>
</main>















<script>
  document.addEventListener('DOMContentLoaded', () => {

    document.querySelectorAll('[data-toggle]').forEach(btn => {
      const targetAttr = btn.getAttribute('data-toggle');
      btn.addEventListener('click', () => {
        document.querySelectorAll(`[data-section="${targetAttr}"]`).forEach(section => {
          section.classList.toggle('hidden');
        });
      });
    });

    document.querySelectorAll('.close-section').forEach(btn => {
      btn.addEventListener('click', () => {
        const parentSection = btn.closest('.toggle-section');
        if (parentSection) parentSection.classList.add('hidden');
      });
    });

  });
</script>

@endsection