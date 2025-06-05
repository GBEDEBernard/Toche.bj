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
        <textarea name="contenu" id="contenu" class="w-full border rounded px-3 py-2" rows="6">{{ old('contenu') }}</textarea>
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
<link rel="stylesheet" href="https://unpkg.com/trix/dist/trix.css">
<script src="https://unpkg.com/trix/dist/trix.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let textarea = document.getElementById('contenu');
        if(textarea){
            let trixEditor = document.createElement('trix-editor');
            trixEditor.setAttribute('input', 'contenu');
            textarea.insertAdjacentElement('afterend', trixEditor);
            textarea.style.display = 'none';
        }
    });
</script>
@endpush
@endsection
