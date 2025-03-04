@extends('layouts.app')

@section('title', 'Liste des Réservations')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Card for listing reservations -->
        <div class="row">
            <div class="col-md-12">
                <!-- Card -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Liste des Réservations</h3>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <!-- Table -->
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">Evenement ID</th>
                                    <th scope="col">User ID</th>
                                    <th scope="col">Nombres</th>
                                    <th scope="col">Prix</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($datas as $data)
                                    <tr>
                                        <td>{{$data->id}}</td>
                                        <td>{{$data->evenement_id}}</td>
                                        <td>{{$data->users_id}}</td>
                                        <td>{{$data->nombre}}</td>
                                        <td>{{$data->prix}}</td>
                                        <td>{{$data->date}}</td>
                                        <td>
                                            <!-- Action Buttons -->
                                            <a href="{{ route('reservations') }}" class="btn btn-success btn-sm">Ajouter une Réservation</a>
                                           
                                            <a href="{{ route('reservations.modifier', $data->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                           
                                            <form action="{{ route('reservations.supression', $data->id) }}" method="POST" style="display:inline;">
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
