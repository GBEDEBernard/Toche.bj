@extends('layouts.app')

@section('content')
<div class="content-wrapper mt-4 p-4">
    <!-- Titre principal -->
    <section class="content-header">
        <h1 class="text-center mb-4 font-serif font-bold text-2xl text-blue-800">
            Liste des Sites Touristiques
        </h1>
    </section>

    <!-- Contenu principal -->
    <section class="content">

        <!-- Formulaire de recherche et filtrage -->
        <form method="GET" action="{{ route('index') }}" class="mb-4 flex gap-2 flex-wrap w-2/4">
            <input type="text" name="query" placeholder="Rechercher…" value="{{ request('query') }}"
                   class="border rounded px-2 py-1 flex-grow">
            <select name="categorie" class="border rounded px-2 py-1">
                <option value="all">Toutes les catégories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('categorie') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->types }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700 transition">
                Filtrer
            </button>
        </form>

        <!-- Boutons d'action -->
        <div class="text-end mb-4">
            <a href="{{ route('welcome') }}"
               class="inline-block px-5 py-2 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition">
                ← Retour
            </a>
            <a href="{{ route('create') }}"
               class="bg-blue-600 text-white font-bold py-2 px-4 rounded shadow hover:bg-blue-700 transition">
                + Ajouter un Site
            </a>
        </div>

        <!-- Tableau responsive -->
        <div class="box box-primary shadow rounded-lg p-3 bg-white overflow-x-auto">
            <table class="table table-bordered table-striped text-sm text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Catégorie</th>
                        <th>Pays</th>
                        <th>Département</th>
                        <th>Commune</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Email</th>
                        <th>Photo</th>
                        <th>Contact</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($datas as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->nom }}</td>
                            <td>{{ $data->categorie->types ?? '—' }}</td>
                            <td>{{ $data->pays }}</td>
                            <td>{{ $data->departement }}</td>
                            <td>{{ $data->commune }}</td>
                            <td>{{ $data->latitude }}</td>
                            <td>{{ $data->longitude }}</td>
                            <td>{{ $data->email }}</td>
                            <td>
                                <img src="{{ asset($data->photo) }}" alt="Photo du site"
                                     class="img-thumbnail" style="width: 80px; height: 60px;">
                            </td>
                            <td>{{ $data->contact }}</td>
                            <td>{{ Str::limit($data->description, 50) }}</td>
                            <td class="d-flex flex-column gap-1">
                                <a href="{{ route('site.modifier', $data->id) }}"
                                   class="btn btn-sm btn-warning w-100">Modifier</a>
                                <button type="button"
                                        class="btn btn-sm btn-danger w-100"
                                        data-bs-toggle="modal"
                                        data-bs-target="#confirmDeleteSiteModal"
                                        data-id="{{ $data->id }}">
                                    Supprimer
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="13" class="text-center text-muted">
                                Aucun site enregistré.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination si nécessaire -->
        @if(method_exists($datas, 'links'))
            <div class="mt-3">
                {{ $datas->links() }}
            </div>
        @endif

    </section>
</div>

<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="confirmDeleteSiteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="deleteSiteForm">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="confirmDeleteLabel">Confirmer la suppression</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Es-tu sûr(e) de vouloir supprimer ce site touristique ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger">Oui, supprimer</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Messages flash -->
@if(session('success'))
    <div class="alert alert-success mt-3 text-center">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger mt-3 text-center">{{ session('error') }}</div>
@endif
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteModal = document.getElementById('confirmDeleteSiteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const siteId = button.getAttribute('data-id');
        if (siteId) {
            document.getElementById('deleteSiteForm').action = '/Site_touristique/delete/' + siteId;
        }
    });
});
</script>
@endpush
