@extends('bloglayout')

@section('contenu')

{{-- Titre principal --}}
<div class="text-center my-8">
    <h1 class="text-3xl md:text-5xl font-extrabold text-gray-800 hover:opacity-80 transition duration-300">🌍 Sites touristiques</h1>
</div>

{{-- Barre de recherche --}}
<div class="flex justify-center mb-10 px-4">
    <div class="bg-gray-100 shadow-md p-4 rounded-lg w-full md:w-2/3 lg:w-1/2">
        <form method="GET" action="{{ route('site_touristique') }}" class="flex flex-col md:flex-row gap-4">
            <input type="text" name="query" value="{{ request('query') }}" placeholder="🔍 Rechercher un site..."
                class="border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 w-full text-gray-700" />
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 transition-all duration-300 text-white px-5 py-2 rounded-md shadow-md hover:scale-105">
                Rechercher
            </button>
        </form>
    </div>
</div>

{{-- Grille des sites touristiques --}}
<section class="px-4 md:px-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mb-20">
    @forelse ($sites as $site)
        <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300 transform hover:-translate-y-1">
            <img src="{{ asset($site->photo) }}" alt="{{ $site->nom }}" class="w-full h-48 object-cover hover:opacity-80">
            <div class="p-4">
                <h2 class="text-lg font-bold text-gray-800 mb-1 truncate">{{ $site->nom }}</h2>
                <p class="text-sm text-blue-600 font-medium">{{ $site->commune }}</p>
                <p class="text-sm text-gray-600 mt-1">
                    Catégorie : {{ $site->categorie->types ?? 'Non définie' }}
                </p>
                <a href="{{ route('sites.show', $site->id) }}"
                   class="inline-block mt-4 text-sm bg-blue-600 text-white px-4 py-1 rounded-full hover:bg-blue-700 transition">
                    Voir détails
                </a>
            </div>
        </div>
    @empty
        <div class="col-span-4 text-center text-gray-500 text-lg">
            Aucun site trouvé. Essaie un autre mot-clé ?
        </div>
    @endforelse
</section>

@endsection
