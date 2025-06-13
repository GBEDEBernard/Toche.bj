@extends('layouts.app')

@section('content')
<div class="content-wrapper mt-4 p-4">
    <!-- Section d'annonce -->
    <section class="content-header">
        <h1 class="text-center mb-2 font-serif font-bold">Liste des Sites Touristiques</h1>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="text-end mb-3 mr-2">
                    <a class="shadow  text-xl text-white  italic py-2 px-1 rounded bg-blue-600 border-2 border-solid font-bold mb-2 h-2/3  " style="text-decoration: none;" href="{{ route('create') }}">
                        Créer un site</a>
                </div>
              
                <table class="table  table-striped-columns"   >
                    <thead class=" table-dark">
                        <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Catégorie</th>
                            <th scope="col">Pays</th>
                            <th scope="col">Département</th>
                            <th scope="col">Commune</th>
                            <th scope="col">Email</th>
                            <th scope="col">Photos</th>
                            <th scope="col">Contacts</th>
                            <th scope="col">Descriptions</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datas as $data)
                            <tr>
                                <td scope="row">{{$data->id}}</td>
                                <td>{{$data->nom}}</td>
                                <td>{{$data->categorie->types}}</td>
                                <td>{{$data->pays}}</td>
                                <td>{{$data->departement}}</td>
                                <td>{{$data->commune}}</td>
                                <td>{{$data->email}}</td>
                                <td><img src="{{ asset ($data->photo) }}" alt="Photo du site"   style="width: 100px; height: 60px;"></td>
                                <td>{{$data->contact}}</td>
                                <td>{{$data->description}}</td>
                                <td>
                                    <a href="{{ route('site.modifier', $data->id) }}" class="flex fond-bold text-xl text-decoration-none ">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                      </svg>
                                        Modifier</a>
                                        <button type="button"  class="font-bold text-red-600 flex text-decoration-none"     
                                        data-bs-toggle="modal"
                                        data-bs-target="#confirmDeleteVisiteModal"
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<!-- Modal de confirmation -->
<div class="modal fade" id="confirmDeleteVisiteModal" tabindex="-1"
    aria-labelledby="confirmDeleteSite_touristiqueModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form  method="POST" id="deleteSite_touristiqueForm">
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
        const deleteModal = document.getElementById('confirmDeleteSite_touristiqueModal');

        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const Site_touristiqueId = button.getAttribute('data-id');

            if (Site_touristiqueId) {
                const form = document.getElementById('deleteSite_touristiqueForm');
                form.action = '/Admin/Site_touristique/' + Site_touristiqueId;
            }
        });
    });
</script>
@endpush