@extends('layouts.app')

@section('title', 'Liste des Utilisateurs')

@section('content')

<div class="container mt-4">
    <h1 class="text-center font-bold text-2xl mb-4">Liste des utilisateurs</h1>

    <!-- Bouton d'ajout -->
    <div class="text-end mb-4">
         <a href="{{ route('welcome') }}"
                            class="inline-block px-5 py-2 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition">
                                ← Retour
                            </a>
        <a href="{{ route('users') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow font-bold hover:bg-blue-700 transition">
            + Créer un utilisateur
        </a>
    </div>

    <!-- Messages de succès / erreur -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Rôle</th>
                    <th>Photo</th>
                    <th>Email</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->role ? $data->role->name : 'Aucun rôle' }}</td>
                        <td>
                            @if($data->photo)
                                <img src="{{ asset($data->photo) }}" alt="Photo de {{ $data->name }}" style="width: 80px; height: 80px; object-fit: cover;">
                            @else
                                <span class="text-muted">Aucune</span>
                            @endif
                        </td>
                        <td>{{ $data->email }}</td>
                        <td>
                            <span class="badge {{ $data->status === 'actif' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($data->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <!-- Modifier -->
                                <a href="{{ route('users.modifier', $data->id) }}" class="btn btn-sm btn-warning d-flex align-items-center">
                                    ✏️ Modifier
                                </a>

                                <!-- Supprimer -->
                                <button class="btn btn-sm btn-danger d-flex align-items-center" data-bs-toggle="modal"
                                        data-bs-target="#confirmDeleteUserModal"
                                        data-id="{{ $data->id }}">
                                    🗑 Supprimer
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal de confirmation suppression -->
<div class="modal fade" id="confirmDeleteUserModal" tabindex="-1" aria-labelledby="confirmDeleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="deleteUserForm">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer cet utilisateur ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger">Oui, supprimer</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteModal = document.getElementById('confirmDeleteUserModal');

        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const userID = button.getAttribute('data-id');
            const form = document.getElementById('deleteUserForm');
            form.action = `/Admin/Users/${userID}`;
        });
    });
</script>
@endpush
