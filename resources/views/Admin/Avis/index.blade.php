@extends('layouts.app') {{-- Ou ton layout AdminLTE --}}

@section('content')
<div class="p-6 max-w-7xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Modération des Avis</h1>

    {{-- Filtres rapides --}}
    <div class="mb-6">
        <form method="GET" class="flex flex-wrap items-center gap-4">
            <select name="statut" class="border p-2 rounded">
                <option value="">-- Tous les statuts --</option>
                <option value="en_attente" {{ request('statut') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                <option value="approuvé" {{ request('statut') == 'approuvé' ? 'selected' : '' }}>Approuvés</option>
                <option value="refusé" {{ request('statut') == 'refusé' ? 'selected' : '' }}>Refusés</option>
            </select>
            <input type="text" name="search" class="border p-2 rounded" placeholder="Chercher par mot-clé..." value="{{ request('search') }}">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Filtrer</button>
        </form>
    </div>

    {{-- Tableau des avis --}}
    <div class="overflow-auto bg-white shadow rounded">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-3">Utilisateur</th>
                    <th class="p-3">Objet</th>
                    <th class="p-3">Commentaire</th>
                    <th class="p-3">Note</th>
                    <th class="p-3">Statut</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($avis as $a)
                <tr class="border-b">
                    <td class="p-3">{{ $a->user->name ?? 'Anonyme' }}</td>
                    <td class="p-3">{{ class_basename($a->avisable_type) }} #{{ $a->avisable_id }}</td>
                    <td class="p-3">
                        {{ Str::limit($a->commentaire, 60) }}
                        @if($a->reponse)
                            <div class="text-green-700 bg-green-100 p-2 rounded mt-2 text-sm">
                                <strong>Réponse admin :</strong> {{ $a->reponse }}
                            </div>
                        @endif
                    </td>
                    <td class="p-3 text-yellow-500">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $a->note)
                                &#9733;
                            @else
                                <span class="text-gray-300">&#9733;</span>
                            @endif
                        @endfor
                    </td>
                    <td class="p-3 capitalize">{{ $a->statut }}</td>
                    <td class="p-3 space-y-2">
                        @if($a->statut == 'en_attente')
                            <form action="{{ route('Admin.Avis.approuver', $a->id) }}" method="POST" class="inline">
                                @csrf @method('PATCH')
                                <button class="bg-green-500 text-white px-3 py-1 rounded">Approuver</button>
                            </form>
                            <form action="{{ route('Admin.Avis.refuser', $a->id) }}" method="POST" class="inline">
                                @csrf @method('PATCH')
                                <button class="bg-red-500 text-white px-3 py-1 rounded">Refuser</button>
                            </form>
                        @else
                            <span class="text-gray-500 text-sm italic">Déjà traité</span>

                            {{-- Formulaire de réponse --}}
                            <form action="{{ route('Admin.Avis.repondre', $a->id) }}" method="POST" class="mt-2">
                                @csrf
                                <textarea name="reponse" rows="2" class="w-full border rounded p-2 text-sm"
                                          placeholder="Répondre à cet avis..."></textarea>
                                <button type="submit"
                                        class="mt-1 bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-sm">
                                    Répondre à un avis
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-4 text-center text-gray-600">Aucun avis trouvé.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $avis->links() }}
    </div>
</div>
@endsection
