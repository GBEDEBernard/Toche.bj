@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-4xl font-serif">
    <h1 class="text-2xl font-bold mb-6">Créer un itinéraire</h1>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('itineraire.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="agence_id" class="block font-semibold mb-1">Agence</label>
            <select name="agence_id" id="agence_id" required class="w-full border px-3 py-2 rounded">
                <option value="">-- Choisir une agence --</option>
                @foreach ($agences as $agence)
                    <option value="{{ $agence->id }}" {{ old('agence_id') == $agence->id ? 'selected' : '' }}>
                        {{ $agence->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="titre" class="block font-semibold mb-1">Titre</label>
            <input type="text" name="titre" id="titre" value="{{ old('titre') }}" required class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label for="description" class="block font-semibold mb-1">Description (optionnel)</label>
            <textarea name="description" id="description" rows="4" class="w-full border px-3 py-2 rounded">{{ old('description') }}</textarea>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div>
                <label for="duree" class="block font-semibold mb-1">Durée (jours)</label>
                <input type="number" name="duree" id="duree" min="1" value="{{ old('duree') }}" required class="w-full border px-3 py-2 rounded">
            </div>
            <div>
                <label for="prix_estime" class="block font-semibold mb-1">Prix estimé (€)</label>
                <input type="number" step="0.01" name="prix_estime" id="prix_estime" min="0" value="{{ old('prix_estime') }}" required class="w-full border px-3 py-2 rounded">
            </div>
            <div>
                <label for="niveau_difficulte" class="block font-semibold mb-1">Niveau de difficulté</label>
                <select name="niveau_difficulte" id="niveau_difficulte" required class="w-full border px-3 py-2 rounded">
                    <option value="">-- Choisir --</option>
                    <option value="facile" {{ old('niveau_difficulte') == 'facile' ? 'selected' : '' }}>Facile</option>
                    <option value="modéré" {{ old('niveau_difficulte') == 'modéré' ? 'selected' : '' }}>Modéré</option>
                    <option value="avancé" {{ old('niveau_difficulte') == 'avancé' ? 'selected' : '' }}>Avancé</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mt-4">
            <div>
                <label for="date_depart" class="block font-semibold mb-1">Date de départ</label>
                <input type="date" name="date_depart" id="date_depart" value="{{ old('date_depart') }}" required class="w-full border px-3 py-2 rounded">
            </div>
            <div>
                <label for="date_retour" class="block font-semibold mb-1">Date de retour</label>
                <input type="date" name="date_retour" id="date_retour" value="{{ old('date_retour') }}" required class="w-full border px-3 py-2 rounded">
            </div>
        </div>

        <hr class="my-6">

        <h2 class="text-xl font-semibold mb-3">Sites touristiques associés</h2>
        <p class="mb-4 text-gray-600">Sélectionne les sites et précise leur ordre, temps prévu et commentaires (optionnels)</p>

        <div id="sites-container">
            {{-- Si erreurs et old data, on peut recharger ici --}}
            @if(old('sites'))
                @foreach(old('sites') as $index => $siteId)
                <div class="site-item mb-4 p-4 border rounded relative">
                    <select name="sites[]" required class="w-full border px-3 py-2 rounded mb-2">
                        <option value="">-- Choisir un site --</option>
                        @foreach($sites as $site)
                            <option value="{{ $site->id }}" {{ $site->id == $siteId ? 'selected' : '' }}>{{ $site->nom }}</option>
                        @endforeach
                    </select>

                    <div class="grid grid-cols-3 gap-4">
                        <input type="number" name="ordre[]" min="1" placeholder="Ordre" value="{{ old('ordre')[$index] ?? '' }}" class="border px-3 py-2 rounded">
                        <input type="text" name="temps_prevu[]" placeholder="Temps prévu (ex: 2h)" value="{{ old('temps_prevu')[$index] ?? '' }}" class="border px-3 py-2 rounded">
                        <input type="text" name="commentaire[]" placeholder="Commentaire" value="{{ old('commentaire')[$index] ?? '' }}" class="border px-3 py-2 rounded">
                    </div>

                    <button type="button" class="absolute top-2 right-2 text-red-500 hover:text-red-700 remove-site">Supprimer</button>
                </div>
                @endforeach
            @else
            {{-- 1 ligne vide par défaut --}}
            <div class="site-item mb-4 p-4 border rounded relative">
                <select name="sites[]" required class="w-full border px-3 py-2 rounded mb-2">
                    <option value="">-- Choisir un site --</option>
                    @foreach($sites as $site)
                        <option value="{{ $site->id }}">{{ $site->nom }}</option>
                    @endforeach
                </select>

                <div class="grid grid-cols-3 gap-4">
                    <input type="number" name="ordre[]" min="1" placeholder="Ordre" class="border px-3 py-2 rounded">
                    <input type="text" name="temps_prevu[]" placeholder="Temps prévu (ex: 2h)" class="border px-3 py-2 rounded">
                    <input type="text" name="commentaire[]" placeholder="Commentaire" class="border px-3 py-2 rounded">
                </div>

                <button type="button" class="absolute top-2 right-2 text-red-500 hover:text-red-700 remove-site">Supprimer</button>
            </div>
            @endif
        </div>

        <button type="button" id="add-site" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">+ Ajouter un site</button>

        <div class="mt-6">
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700">Créer l'itinéraire</button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('sites-container');
    const addBtn = document.getElementById('add-site');

    addBtn.addEventListener('click', () => {
        const siteItem = document.createElement('div');
        siteItem.classList.add('site-item', 'mb-4', 'p-4', 'border', 'rounded', 'relative');

        siteItem.innerHTML = `
            <select name="sites[]" required class="w-full border px-3 py-2 rounded mb-2">
                <option value="">-- Choisir un site --</option>
                @foreach($sites as $site)
                    <option value="{{ $site->id }}">{{ $site->nom }}</option>
                @endforeach
            </select>
            <div class="grid grid-cols-3 gap-4">
                <input type="number" name="ordre[]" min="1" placeholder="Ordre" class="border px-3 py-2 rounded">
                <input type="text" name="temps_prevu[]" placeholder="Temps prévu (ex: 2h)" class="border px-3 py-2 rounded">
                <input type="text" name="commentaire[]" placeholder="Commentaire" class="border px-3 py-2 rounded">
            </div>
            <button type="button" class="absolute top-2 right-2 text-red-500 hover:text-red-700 remove-site">Supprimer</button>
        `;

        container.appendChild(siteItem);
        addRemoveListeners();
    });

    function addRemoveListeners() {
        document.querySelectorAll('.remove-site').forEach(button => {
            button.onclick = (e) => {
                e.target.closest('.site-item').remove();
            };
        });
    }

    addRemoveListeners();
});
</script>
@endsection
