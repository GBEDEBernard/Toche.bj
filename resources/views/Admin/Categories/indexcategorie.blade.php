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
                                    <!-- Ajouter Catégorie -->
                                    <a href="{{ route('createcategorie') }}" class="btn btn-primary btn-sm">Ajouter</a>
                                    <br><br>

                                    <!-- Modifier Catégorie -->
                                    <a href="{{ route('categorie.modifier', $data->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                    <br><br>

                                    <!-- Supprimer Catégorie -->
                                    <form action="{{ route('categorie.supression', $data->id) }}" method="post" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                    </form>
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

@endsection
