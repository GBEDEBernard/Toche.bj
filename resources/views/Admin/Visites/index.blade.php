@extends('layouts.app')

@section('title', 'Liste des Visites')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Card for listing visites -->
        <div class="row">
            <div class="col-md-12">
                <!-- Card -->
                <div class="card card-primary mt-4">
                    <div class="card-header ">
                        <h3 class="card-title">Liste des Visites</h3>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <!-- Table -->
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">Site Touristique</th>
                                    <th scope="col">Utilisateur</th>
                                    <th scope="col">Téléphone</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Prix</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Chemin des Tickets</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($datas as $data)
                                    <tr>
                                        <td>{{ $data->id }}</td>
                                        <td>{{ $data->site_touristique_id }}</td>
                                        <td>{{ $data->users_id }}</td>
                                        <td>{{ $data->telephone }}</td>
                                        <td>{{ $data->nombre }}</td>
                                        <td>{{ $data->prix }}</td>
                                        <td>{{ $data->date }}</td>
                                        <td>{{ $data->chemin_ticket }}</td>
                                        <td>
                                            <!-- Action Buttons -->
                                            <a href="{{ route('visites') }}" class="btn btn-success btn-sm">Ajouter une visite</a>
                                           
                                            <a href="{{ route('visites.modifier', $data->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                           
                                            <form action="{{ route('visites.supression', $data->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
