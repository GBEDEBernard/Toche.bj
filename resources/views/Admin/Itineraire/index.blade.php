@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-7xl">
    <!-- Message Flash -->
    @if (session('success'))
        <div id="flash-message" class="fixed top-6 right-6 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg opacity-90 cursor-pointer transition-opacity duration-500 z-50" role="alert" aria-live="assertive">
            {{ session('success') }}
        </div>
    @endif

    <!-- Titre et Bouton Création -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Liste des itinéraires</h1>
        <a href="{{ route('itineraire.create') }}" class="inline-flex items-center bg-blue-600 text-white px-5 py-2.5 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 transition duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Créer un itinéraire
        </a>
    </div>

    <!-- Formulaire de Filtre et Recherche -->
    <form method="GET" action="{{ route('itineraire.index') }}" class="mb-8 bg-white p-6 rounded-lg shadow-sm">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
            <div>
                <label for="search" class="block mb-1 text-sm font-medium text-gray-700">Recherche</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Titre ou description" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label for="agence_id" class="block mb-1 text-sm font-medium text-gray-700">Agence</label>
                <select name="agence_id" id="agence_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Toutes les agences</option>
                    @foreach($agences as $agence)
                        <option value="{{ $agence->id }}" {{ request('agence_id') == $agence->id ? 'selected' : '' }}>{{ $agence->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="niveau_difficulte" class="block mb-1 text-sm font-medium text-gray-700">Niveau de difficulté</label>
                <select name="niveau_difficulte" id="niveau_difficulte" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Tous les niveaux</option>
                    <option value="facile" {{ request('niveau_difficulte') == 'facile' ? 'selected' : '' }}>Facile</option>
                    <option value="modéré" {{ request('niveau_difficulte') == 'modéré' ? 'selected' : '' }}>Modéré</option>
                    <option value="avancé" {{ request('niveau_difficulte') == 'avancé' ? 'selected' : '' }}>Avancé</option>
                </select>
            </div>
            <div>
                <label for="date_depart" class="block mb-1 text-sm font-medium text-gray-700">Date de départ min.</label>
                <input type="date" name="date_depart" id="date_depart" value="{{ request('date_depart') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label for="date_retour" class="block mb-1 text-sm font-medium text-gray-700">Date de retour max.</label>
                <input type="date" name="date_retour" id="date_retour" value="{{ request('date_retour') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>
        <div class="mt-4 flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-5 py-2.5 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 transition duration-200">Filtrer</button>
        </div>
    </form>

    <!-- Tableau des itinéraires -->
    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-700">Titre</th>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-700">Agence</th>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-700">Description</th>
                    <th scope="col" class="px-6 py-3 text-center text-sm font-medium text-gray-700">Durée (jours)</th>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-700">Prix estimé</th>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-700">Niveau</th>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-700">Dates</th>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-700">Sites associés</th>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($itineraires as $itineraire)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-3 whitespace-nowrap">{{ $itineraire->titre }}</td>
                        <td class="px-6 py-3 whitespace-nowrap">{{ $itineraire->agence->nom ?? 'Non défini' }}</td>
                        <td class="px-6 py-3 max-w-xs">
                            <div class="line-clamp-4" title="{{ $itineraire->description }}">{{ $itineraire->description }}</div>
                        </td>
                        <td class="px-6 py-3 text-center">{{ $itineraire->duree }}</td>
                        <td class="px-6 py-3 whitespace-nowrap">{{ number_format($itineraire->prix_estime, 2, ',', ' ') }} €</td>
                        <td class="px-6 py-3 whitespace-nowrap capitalize">{{ $itineraire->niveau_difficulte }}</td>
                        <td class="px-2 py-3 whitespace-nowrap ">
                            {{ $itineraire->date_depart->format('d/m/Y') }} au {{ $itineraire->date_retour->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-3">
                            @forelse($itineraire->site_touristiques as $site)
                                <span class="inline-block bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs mr-1 mb-1">{{ $site->nom }}</span>
                            @empty
                                <span class="text-gray-500 text-xs">Aucun site</span>
                            @endforelse
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap space-x-2">
                            <a href="{{ route('itineraire.edit', $itineraire->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">Modifier</a>
                            <form action="{{ route('itineraire.delete', $itineraire->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet itinéraire ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-6 py-3 text-center text-gray-500">Aucun itinéraire trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
   <!-- Liste des demandes de participation -->
<div class="mt-16">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">📩 Demandes de participation</h2>

    @forelse($demandes as $demande)
        <div class="p-4 bg-white rounded-lg shadow mb-4">
            <p><strong>Nom:</strong> {{ $demande->nom }}</p>
            <p><strong>Téléphone:</strong> {{ $demande->telephone }}</p>
            <p><strong>Email:</strong> {{ $demande->email }}</p>
            <p><strong>Message:</strong> {{ $demande->message }}</p>
            <p class="text-sm text-gray-500">Itinéraire : {{ $demande->itineraire->titre ?? 'Inconnu' }}</p>
        
            @if ($demande->reponse)
            <div class="mt-4 bg-gray-50 border-l-4 border-blue-500 p-4">
                <p class="text-sm text-gray-600">✉️ Réponse déjà envoyée :</p>
                <blockquote class="text-gray-700 mt-1 italic">{{ $demande->reponse }}</blockquote>
            </div>
        @else
            <form action="{{ route('demande.repondre', $demande->id) }}" method="POST" class="mt-2">
                @csrf
                <textarea name="message" placeholder="Votre réponse..." class="w-full border border-gray-300 rounded px-3 py-2 mb-2" required></textarea>
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Envoyer la réponse</button>
            </form>
        @endif
        
            
        </div>
    @empty
        <p class="text-gray-500 italic">Aucune demande pour les itinéraires affichés.</p>
    @endforelse

</div>


    <!-- Pagination -->
    <div class="mt-6">
        {{ $itineraires->links('vendor.pagination.tailwind') }}
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