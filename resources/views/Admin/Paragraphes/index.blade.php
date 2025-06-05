@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Paragraphes d'evenement : {{ $evenement->nom ?? 'Evenement inconnu' }}</h1>

<div class="text-end px-4">

    <a href="{{ route('admin.paragraphes.create') }}?evenement_id={{ $evenement->id }}" class="mb-4 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700  text-end">
        + Ajouter un paragraphe
    </a>
</div>

@if(session('success'))
    <div class="mb-4 p-2 bg-green-200 text-green-800 rounded">{{ session('success') }}</div>
@endif

<table class="min-w-full bg-white border border-gray-200 rounded p-4">
    <thead >
        <tr>
            <th class="border px-4 py-2">Ordre</th>
            <th class="border px-4 py-2">Titre</th>
            <th class="border px-4 py-2">Contenu</th>
            <th class="border px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody class="p-4">
        @forelse($paragraphes as $paragraphe)
            <tr>
                <td class="border px-4 py-2 text-center">{{ $paragraphe->ordre }}</td>
                <td class="border px-4 py-2">{{ $paragraphe->titre ?? '-' }}</td>
                <td class="border px-4 py-2 max-w-xl overflow-hidden text-ellipsis">{{ Str::limit(strip_tags($paragraphe->contenu), 100) }}</td>
                <td class="border px-4 py-2 text-center space-x-2">
                    <a href="{{ route('admin.paragraphes.edit', $paragraphe) }}?evenement_id={{ $evenement->id }}" class="text-blue-600 hover:underline">Modifier</a>

                    <form action="{{ route('admin.paragraphes.destroy', $paragraphe) }}?evenement_id={{ $evenement->id }}" method="POST" class="inline-block" onsubmit="return confirm('Supprimer ce paragraphe ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="4" class="text-center py-4">Aucun paragraphe trouvé.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
