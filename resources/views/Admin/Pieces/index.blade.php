@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold">Liste des Pièces d'identité</h2>
        <a href="{{ route('piece.create') }}" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded">
            + Nouvelle Pièce
        </a>
    </div>

    <div class="bg-white shadow overflow-hidden rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600">Utilisateur</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600">Numéro</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600">Expiration</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600">Scan</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($pieces as $piece)
                <tr>
                    <td class="px-6 py-4">{{ $piece->user->name ?? 'Utilisateur supprimé' }}</td>
                    <td class="px-6 py-4">{{ $piece->type }}</td>
                    <td class="px-6 py-4">{{ $piece->numero }}</td>
                    <td class="px-6 py-4">{{ $piece->date_expiration }}</td>
                    <td class="px-6 py-4">
                        @if($piece->scan)
                            <a href="{{ asset('storage/' . $piece->scan) }}" target="_blank" class="text-blue-600 underline">Voir</a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('piece.edit', $piece) }}" class="text-blue-600 hover:underline">Modifier</a> |
                        <form action="{{ route('piece.destroy', $piece) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Supprimer cette pièce ?')" class="text-red-600 hover:underline">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
