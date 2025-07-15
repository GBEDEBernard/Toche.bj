@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-xl font-bold mb-4">Liste de mes agences de voyage</h1>

    <div class="text-end mb-4">
        <a href="{{ route('agence.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            + Ajouter une agence
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-200 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full table-auto border-top shadow border-gray-600 rounded overflow-hidden border-collapse">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2 border">N°</th>
                <th class="p-2 border">Nom</th>
                <th class="p-2 border">Contact</th>
                <th class="p-2 border">Adresse</th>
                <th class="p-2 border">Description</th>
                <th class="p-2 border">Photo</th>
                <th class="p-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($agences as $agence)
                <tr>
                    <td class="p-2 border border-gray-400">{{ $loop->iteration }}</td>
                    <td class="p-2 border border-gray-400"">{{ $agence->nom }}</td>
                    <td class="p-2 border border-gray-400"">{{ $agence->contact }}</td>
                    <td class="p-2 border border-gray-400"">{{ $agence->adresse }}</td>
                    <td class="p-2 border border-gray-400"">{{ $agence->description }}</td>
                    <td class="p-2 border border-gray-400"">
                        @if($agence->photo)
                            <img src="{{ asset('storage/' . $agence->photo) }}" alt="Photo agence" style="max-width: 90px;" class="rounded">
                        @else
                            <span class="text-gray-400 italic">Pas de photo</span>
                        @endif
                    </td>
                    <td class="p-2 border border-gray-400"">
                        <a href="{{ route('agence.edit', $agence->id) }}" class="text-blue-600 hover:underline">Modifier</a>
                        <form action="{{ route('agence.delete', $agence->id) }}" method="POST" class="inline" >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline ml-2">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-gray-500 italic">
                        Aucune agence de voyage trouvée.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
