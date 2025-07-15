@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-lg">
    <h1 class="text-2xl font-bold mb-6">Modifier l'agence : {{ $agence->nom }}</h1>

    {{-- Affichage des erreurs --}}
    @if ($errors->any())
        <div class="mb-4 text-red-600">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('agence.update', $agence->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Nom de l'agence</label>
            <input type="text" name="nom" value="{{ old('nom', $agence->nom) }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Contact</label>
            <input type="text" name="contact" value="{{ old('contact', $agence->contact) }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Adresse</label>
            <input type="text" name="adresse" value="{{ old('adresse', $agence->adresse) }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Description</label>
            <textarea name="description" class="w-full border rounded px-3 py-2">{{ old('description', $agence->description) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Photo actuelle</label>
            @if($agence->photo)
                <img src="{{ asset('storage/' . $agence->photo) }}" alt="Photo agence" class="mb-2 rounded" style="max-width: 150px;">
            @else
                <p class="italic text-gray-500">Pas de photo</p>
            @endif
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Changer la photo</label>
            <input type="file" name="photo" class="w-full border rounded px-3 py-2" accept="image/*">
            <p class="text-sm text-gray-500 mt-1">Laisser vide pour garder la photo actuelle.</p>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Mettre à jour</button>
        <a href="{{ route('agence.index') }}" class="ml-4 text-gray-600 hover:underline">Annuler</a>
    </form>
</div>
@endsection
