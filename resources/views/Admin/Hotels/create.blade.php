@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10">
    <h2 class="text-2xl font-bold mb-6">Ajouter un Hôtel</h2>
    <form action="{{ route('admin.hotels.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div>
            <label class="block font-semibold mb-1">Nom de l'hôtel</label>
            <input type="text" name="nom" class="w-full border border-gray-300 px-4 py-2 rounded" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Ville</label>
            <input type="text" name="ville" class="w-full border border-gray-300 px-4 py-2 rounded" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Image</label>
            <input type="file" name="image" class="w-full">
        </div>

        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Enregistrer</button>
            <a href="{{ route('admin.hotels.index') }}" class="ml-4 text-gray-600 hover:underline">Annuler</a>
        </div>
    </form>
</div>
@endsection
