@extends('layouts.app')

@section('title', 'Liste des Événements')

@section('content')
<section class="py-6">
    <div class="container mx-auto">

        <!-- Barre d'action + recherche -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <!-- Boutons -->
            <div class="flex gap-3">
                <a href="{{ route('welcome') }}" class="px-5 py-2 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition">
                    ← Retour
                </a>
                <a href="{{ route('evenement.create') }}" class="px-6 py-2 bg-blue-600 text-white font-bold rounded-lg shadow hover:bg-blue-700 transition">
                    Ajouter un Événement
                </a>
            </div>

            <!-- Barre de recherche -->
            <form method="GET" action="{{ route('indexevenements') }}" class="flex gap-2 w-full md:w-auto">
                <input type="text" name="query" value="{{ request('query') }}" placeholder="Rechercher par nom, lieu ou description" class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                
                <select name="site" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="all">Tous les sites</option>
                    @foreach($sites as $site)
                        <option value="{{ $site->id }}" {{ request('site') == $site->id ? 'selected' : '' }}>{{ $site->nom }}</option>
                    @endforeach
                </select>

                <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">Rechercher</button>
            </form>
        </div>

        <!-- Table des événements -->
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium">#</th>
                        <th class="px-4 py-2 text-left text-sm font-medium">Nom</th>
                        <th class="px-4 py-2 text-left text-sm font-medium">Site</th>
                        <th class="px-4 py-2 text-left text-sm font-medium">Lieu</th>
                        <th class="px-4 py-2 text-left text-sm font-medium">Date</th>
                        <th class="px-4 py-2 text-left text-sm font-medium">Programme</th>
                        <th class="px-4 py-2 text-left text-sm font-medium">Détails</th>
                        <th class="px-4 py-2 text-left text-sm font-medium">Infos pratiques</th>
                        <th class="px-4 py-2 text-left text-sm font-medium">Photo</th>
                        <th class="px-4 py-2 text-left text-sm font-medium">Sponsor</th>
                        <th class="px-4 py-2 text-left text-sm font-medium">Description</th>
                        <th class="px-4 py-2 text-left text-sm font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($datas as $data)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-sm">{{ $data->id }}</td>
                            <td class="px-4 py-2 text-sm font-semibold">{{ $data->nom }}</td>
                            <td class="px-4 py-2 text-sm">{{ $data->site_touristique->nom }}</td>
                            <td class="px-4 py-2 text-sm">{{ $data->lieu }}</td>
                            <td class="px-4 py-2 text-sm">{{ \Carbon\Carbon::parse($data->date)->format('d/m/Y') }}</td>
                            <td class="px-4 py-2 text-sm">{{ Str::limit($data->programme, 50) }}</td>
                            <td class="px-4 py-2 text-sm">
                                <ul class="list-disc ml-4 text-xs text-gray-700">
                                    @foreach(explode("\n", $data->programme_details) as $item)
                                        @if(trim($item))
                                            <li>{{ trim($item) }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </td>
                            <td class="px-4 py-2 text-sm">{{ Str::limit($data->infos_pratiques, 50) }}</td>
                            <td class="px-4 py-2">
                                <img src="{{ asset($data->photo) }}" alt="Photo" class="w-24 h-16 object-cover rounded">
                            </td>
                            <td class="px-4 py-2 text-sm">{{ $data->sponsor }}</td>
                            <td class="px-4 py-2 text-sm">{{ Str::limit($data->description, 50) }}</td>
                            <td class="px-4 py-2 text-sm flex flex-col gap-1">
                                <a href="{{ route('evenements.modifier', $data->id) }}" class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition text-center">Modifier</a>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#confirmDeleteEvenementModal" data-id="{{ $data->id }}" class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition text-center">Supprimer</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="px-4 py-6 text-center text-gray-500">Aucun événement trouvé</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $datas->appends(request()->query())->links() }}
        </div>
    </div>
</section>

<!-- Modal de suppression -->
<div class="modal fade" id="confirmDeleteEvenementModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="deleteEvenementForm">
            @csrf
            @method('DELETE')
            <div class="modal-content rounded-lg shadow-lg">
                <div class="modal-header bg-red-600 text-white">
                    <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-gray-800">
                    Voulez-vous vraiment supprimer cet événement ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">Supprimer</button>
                </div>
            </div>
        </form>
    </div>
</div>

@if (session('success'))
    <div class="mt-4 p-4 bg-green-500 text-white rounded">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="mt-4 p-4 bg-red-500 text-white rounded">{{ session('error') }}</div>
@endif
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteModal = document.getElementById('confirmDeleteEvenementModal');

    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const evenementID = button.getAttribute('data-id');
        if (evenementID) {
            const form = document.getElementById('deleteEvenementForm');
            form.action = '/Admin/Evenements/' + evenementID;
        }
    });
});
</script>
@endpush
