@extends('layouts.app')

@section('title', 'Categorie')

@section('content')
<!-- Page Content -->
<section class="content">
    <div class="container-fluid">
        <!-- Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Liste des Catégories</h3>
            </div>
            <div class="card-body">
                <div class="text-end mb-3 mr-2">
                    <a class="shadow  text-xl text-white  italic py-2 px-1 rounded bg-blue-600 border-2 border-solid font-bold mb-2 h-2/3  " style="text-decoration: none;" href="{{ route('createcategorie') }}">
                        Créer la Catégorie</a>
                </div>
                <!-- Table -->
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Types de Catégorie</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($datas as $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td>{{$data->types}}</td>
                                <td>
                                   
                                    <!-- Modifier Catégorie -->
                                    <a href="{{ route('categorie.modifier', $data->id) }}"class=" text-decoration-none font-bold flex text-xl">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 mr-2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                          </svg>
                                            Modifier</a>
                                    <!-- Supprimer Catégorie -->
                                    <button type="button"  class="font-bold text-red-600 flex text-decoration-none"     
                                    data-bs-toggle="modal"
                                    data-bs-target="#confirmDeleteCategorieModal"
                                    data-id="{{ $data->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="size-5 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                    Supprimer
                                </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Aucune catégorie disponible.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
    </div>
</section>
<!-- Modal de confirmation -->
<div class="modal fade" id="confirmDeleteCategorieModal" tabindex="-1"
    aria-labelledby="confirmDeleteCaregorieModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form  method="POST" id="deleteCategorieForm">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Voulez-vous vraiment supprimer cette visite ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </div>
            </div>
        </form>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteModal = document.getElementById('confirmDeleteCategorieModal');

        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const CategorieId = button.getAttribute('data-id');

            if (CategorieId) {
                const form = document.getElementById('deleteCategorieForm');
                form.action = '/Admin/Categorie/' + CategorieId;
            }
        });
    });
</script>

