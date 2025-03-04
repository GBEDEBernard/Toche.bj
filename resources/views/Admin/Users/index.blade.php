@extends('layouts.app')

@section('title', 'Liste des Utilisateurs')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Card for listing users -->
        <div class="row">
            <div class="col-md-12">
                <!-- Card -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Liste des Utilisateurs</h3>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <!-- Table -->
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">Noms</th>
                                    <th scope="col">Prénoms</th>
                                    <th scope="col">Téléphones</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Emails</th>
                                    <th scope="col">Photos</th>
                                    <th scope="col">Email Vérifié</th>
                                    <th scope="col">Mot de passe</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($datas as $data)
                                    <tr>
                                        <td>{{ $data->id }}</td>
                                        <td>{{ $data->nom }}</td>
                                        <td>{{ $data->prenom }}</td>
                                        <td>{{ $data->telephone }}</td>
                                        <td>{{ $data->status }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->photo }}</td>
                                        <td>{{ $data->email_verified_at }}</td>
                                        <td>{{ $data->password }}</td>
                                        <td>
                                            <!-- Action Buttons -->
                                            <a href="{{ route('users') }}" class="btn btn-success btn-sm">Ajouter un utilisateur</a>
                                            <br><br>
                                            <a href="{{ route('users.modifier', $data->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                            <br><br>
                                            <form action="{{ route('users.supression', $data->id) }}" method="POST" style="display:inline;">
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
