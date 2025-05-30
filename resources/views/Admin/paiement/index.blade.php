@extends('layouts.app')

@section('content')
<div class="p-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Liste des paiements</h1>
        <a href="{{ route('paiement.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Nouveau Paiement</a>
    </div>

    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead class="bg-gray-100 text-gray-600 uppercase text-sm">
            <tr>
                <th class="py-3 px-6 text-left">#</th>
                <th class="py-3 px-6 text-left">Réservation</th>
                <th class="py-3 px-6 text-left">Mode</th>
                <th class="py-3 px-6 text-left">Référence</th>
                <th class="py-3 px-6 text-left">Date</th>
                <th class="py-3 px-6 text-left">Statut</th>
                <th class="py-3 px-6 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            @foreach ($paiements as $paiement)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-6">{{ $paiement->id }}</td>
                    <td class="py-3 px-6">{{ $paiement->reservation->id ?? 'N/A' }}</td>
                    <td class="py-3 px-6">{{ $paiement->mode }}</td>
                    <td class="py-3 px-6">{{ $paiement->reference }}</td>
                    <td class="py-3 px-6">{{ $paiement->date_paiement }}</td>
                    <td class="py-3 px-6">{{ $paiement->statut }}</td>
                    <td class="py-3 px-6 space-x-2">
                        <a href="{{ route('paiement.edit', $paiement) }}" class="text-blue-500 hover:underline">Modifier</a>
                        <form action="{{ route('paiement.destroy', $paiement) }}" method="POST" class="inline-block" onsubmit="return confirm('Supprimer ce paiement ?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
