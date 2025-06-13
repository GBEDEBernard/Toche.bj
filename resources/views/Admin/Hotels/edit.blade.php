@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10">
    <h2 class="text-2xl font-bold mb-6">Modifier l'Hôtel</h2>
    <form action="{{ route('admin.hotels.update', $hotel->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold mb-1">Nom de l'hôtel</label>
            <input type="text" name="nom" value="{{ $hotel->nom }}" class="w-full border border-gray-300 px-4 py-2 rounded" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Ville</label>
            <input type="text" name="ville" value="{{ $hotel->ville }}" class="w-full border border-gray-300 px-4 py-2 rounded" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Image</label>
            @if($hotel->image)
                <img src="{{ asset('storage/' . $hotel->image) }}" class="h-20 w-32 object-cover mb-2">
            @endif
            <input type="file" name="image" class="w-full">
        </div>

        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Mettre à jour</button>
            <a href="{{ route('admin.hotels.index') }}" class="ml-4 text-gray-600 hover:underline">Annuler</a>
        </div>
    </form>
</div>
@endsection
