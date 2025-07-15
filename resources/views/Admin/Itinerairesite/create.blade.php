@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-3xl">
    <h1 class="text-2xl font-bold mb-6">Créer une association itinéraire - site</h1>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('itineraire_site.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="itineraire_id" class="block font-semibold mb-1">Itinéraire</label>
            <select name="itineraire_id" id="itineraire_id" required class="w-full border px-3 py-2 rounded">
                <option value="">-- Choisir un itinéraire --</option>
                @foreach($itineraires as $itineraire)
                    <option value="{{ $itineraire->id }}" {{ old('itineraire_id') == $itineraire->id ? 'selected' : '' }}>
                        {{ $itineraire->titre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="site_touristique_id" class="block font-semibold mb-1">Site touristique</label>
            <select name="site_touristique_id" id="site_touristique_id" required class="w-full border px-3 py-2 rounded">
                <option value="">-- Choisir un site --</option>
                @foreach($sites as $site)
                    <option value="{{ $site->id }}" {{ old('site_touristique_id') == $site->id ? 'selected' : '' }}>
                        {{ $site->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="ordre" class="block font-semibold mb-1">Ordre</label>
            <input type="number" name="ordre" id="ordre" min="1" value="{{ old('ordre') }}" required class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <input type="time" name="temps_prevu[]" class="border px-3 py-2 rounded" value="{{ old('temps_prevu')[$index] ?? '' }}">
            <input type="text" name="temps_prevu" id="temps_prevu" value="{{ old('temps_prevu') }}" class="w-full border px-3 py-2 rounded" placeholder="ex: 2h 30min ou 20min">
        </div>

        <div>
            <label for="commentaire" class="block font-semibold mb-1">Commentaire (optionnel)</label>
            <textarea name="commentaire" id="commentaire" rows="3" class="w-full border px-3 py-2 rounded">{{ old('commentaire') }}</textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700">Créer</button>
    </form>
</div>
@endsection
