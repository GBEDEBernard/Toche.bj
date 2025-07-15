@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-6xl">
    <!-- Message Flash -->
    @if (session('success'))
        <div id="flash-message" class="fixed top-6 right-6 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg opacity-90 cursor-pointer transition-opacity duration-500 z-50" role="alert" aria-live="assertive">
            {{ session('success') }}
        </div>
    @endif

    <!-- Titre et Bouton Création -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Associations Itinéraires - Sites</h1>
        <a href="{{ route('itineraire_site.create') }}" class="inline-flex items-center bg-blue-600 text-white px-5 py-2.5 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 transition duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Ajouter une association
        </a>
    </div>
<!-- Formulaire de recherche -->
<form method="GET" action="{{ route('itineraire_site.index') }}" class="mb-6 w-full max-w-md">
    <div class="flex items-center bg-white rounded-lg shadow-sm overflow-hidden border border-gray-300">
        <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}"
            placeholder="Rechercher un itinéraire ou un site..." 
            class="w-full px-4 py-2 text-gray-700 focus:outline-none"
        >
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 transition">
            Rechercher
        </button>
    </div>
</form>

    <!-- Tableau des associations -->
    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-700">Itinéraire</th>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-700">Site touristique</th>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-700">Ordre</th>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-700">Temps prévu</th>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-700">Commentaire</th>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($itineraireSites as $item)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-3 whitespace-nowrap">{{ $item->itineraire->titre ?? 'Non défini' }}</td>
                        <td class="px-6 py-3 whitespace-nowrap">{{ $item->site_touristique->nom ?? 'Non défini' }}</td>
                        <td class="px-6 py-3 whitespace-nowrap">{{ $item->ordre }}</td>
                        <td class="px-6 py-3 whitespace-nowrap">{{ $item->temps_prevu }}</td>
                        <td class="px-6 py-3 max-w-xs">
                            <div class="line-clamp-2" title="{{ $item->commentaire ?? '' }}">{{ $item->commentaire ?? 'Aucun commentaire' }}</div>
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap space-x-2">
                            <a href="{{ route('itineraire_site.edit', $item->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">Modifier</a>
                            <form action="{{ route('itineraire_site.delete', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette association ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-3 text-center text-gray-500">Aucune association trouvée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $itineraireSites->links('vendor.pagination.tailwind') }}
    </div>
</div>

<!-- Script pour le message flash -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const flash = document.getElementById('flash-message');
        if (flash) {
            setTimeout(() => {
                flash.style.opacity = '0';
                setTimeout(() => flash.remove(), 500);
            }, 3000);

            flash.addEventListener('click', () => {
                flash.remove();
            });
        }
    });
</script>
@endsection