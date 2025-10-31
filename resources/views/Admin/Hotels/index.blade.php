@extends('layouts.app')

@section('title', 'Liste des Hôtels')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
        <h2 class="text-3xl font-bold text-gray-800">🏨 Liste des Hôtels</h2>
        <div class="flex gap-3">
            <a href="{{ route('welcome') }}"
               class="inline-block px-5 py-2 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition">
               ← Retour
            </a>
            <a href="{{ route('admin.hotels.create') }}"
               class="px-5 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
               + Ajouter un hôtel
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-6 rounded-lg shadow">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded-lg  border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Nom</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Ville</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Image</th>
                    <th class="px-6 py-3 text-center text-sm font-medium text-gray-700 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($hotels as $hotel)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-gray-800 font-medium">{{ $hotel->nom }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $hotel->ville }}</td>
                        <td class="px-6 py-4">
                            @if($hotel->image)
                                <img src="{{ asset('storage/' . $hotel->image) }}" class="h-16 w-24 object-cover rounded-md border">
                            @else
                                <span class="text-gray-400 italic">Aucune</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center space-x-2">
                            <a href="{{ route('admin.hotels.edit', $hotel) }}"
                               class="px-3 py-1 bg-gray-500 text-white rounded-lg hover:bg-yellow-600 transition">
                               Modifier
                            </a>
                            <form action="{{ route('admin.hotels.destroy', $hotel) }}" method="POST" class="inline-block"
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet hôtel ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500 italic">
                            Aucun hôtel trouvé.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
