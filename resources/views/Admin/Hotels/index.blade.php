@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Liste des Hôtels</h2>
        <a href="{{ route('admin.hotels.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Ajouter</a>
    </div>

    @if(session('success'))
        <div class="text-green-600 mb-4">{{ session('success') }}</div>
    @endif

    <table class="w-full table-auto">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2">Nom</th>
                <th class="px-4 py-2">Ville</th>
                <th class="px-4 py-2">Image</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hotels as $hotel)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $hotel->nom }}</td>
                    <td class="px-4 py-2">{{ $hotel->ville }}</td>
                    <td class="px-4 py-2">
                        @if($hotel->image)
                            <img src="{{ asset('storage/' . $hotel->image) }}" class="h-16 w-24 object-cover">
                        @else
                            Aucune
                        @endif
                    </td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('admin.hotels.edit', $hotel) }}" class="text-blue-600 hover:underline">Modifier</a>
                        <form action="{{ route('admin.hotels.destroy', $hotel) }}" method="POST" class="inline-block" onsubmit="return confirm('Supprimer cet hôtel ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
