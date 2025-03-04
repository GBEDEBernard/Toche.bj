@extends('layouts.app')

@section('title', 'Liste des Événements')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Card for listing events -->
        <div class="row">
            <div class="col-md-12">
                <!-- Card -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Liste des Événements</h3>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <!-- Table -->
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Site-touristique</th>
                                    <th scope="col">Lieu</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Photo</th>
                                    <th scope="col">Sponsor</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($datas as $data)
                                    <tr>
                                        <td>{{$data->id}}</td>
                                        <td>{{$data->nom}}</td>
                                        <td>{{$data->site_touristique_id}}</td>
                                        <td>{{$data->lieu}}</td>
                                        <td>{{$data->date}}</td>
                                        <td><img src="{{ asset ($data->photo) }}" alt="Photo du d'evenement"   style="width: 100px; height: 60px;"></td>
                                        <td>{{$data->sponsor}}</td>
                                        <td>{{$data->description}}</td>
                                        <td>
                                            <!-- Action Buttons -->
                                            <a href="{{ route('evenement.create') }}" class="btn btn-success btn-sm">Ajouter un Événement</a>
                                          
                                            <a href="{{ route('evenements.modifier', $data->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                            
                                            <form action="{{ route('evenements.supression', $data->id) }}" method="POST" style="display:inline;">
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
