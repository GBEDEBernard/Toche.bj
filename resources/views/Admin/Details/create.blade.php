@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold m-4">Ajouter un paragraphe au site : {{ $site->nom ?? 'Site inconnu' }}</h1>

<form action="{{ route('admin.details.store') }}?site_id={{ $site->id }}" method="POST" class="p-4">
    @csrf

    <div class="mb-4">
        <label for="titre" class="block font-semibold mb-1">Titre (optionnel)</label>
        <input type="text" name="titre" id="titre" value="{{ old('titre') }}" class="w-full border px-3 py-2 rounded" />
        @error('titre')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="contenu" class="block font-semibold mb-1">Contenu</label>
        <textarea name="contenu" id="contenu" class="w-full border rounded px-3 py-2" rows="5">{{ old('contenu') }}</textarea>
        @error('contenu')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    
   

    <div class="mb-4">
        <label for="ordre" class="block font-semibold mb-1">Ordre</label>
        <input type="number" name="ordre" id="ordre" value="{{ old('ordre', 0) }}" min="0" class="w-24 border px-3 py-2 rounded" />
        @error('ordre')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700">Créer</button>
    <a href="{{ route('admin.details.index') }}?site_id={{ $site->id }}" class="ml-4 text-gray-700 hover:underline">Annuler</a>
</form>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const textarea = document.getElementById('contenu');
        if (textarea) {
            console.log('Textarea found:', textarea);
            console.log('Textarea styles:', window.getComputedStyle(textarea));
            // Détecte les changements
            new MutationObserver((mutations) => {
                mutations.forEach((mutation) => {
                    console.log('Textarea mutation:', mutation);
                });
            }).observe(textarea, { attributes: true, childList: true, subtree: true });
        } else {
            console.log('Textarea not found!');
        }
    });
</script>
@endpush
@endsection
