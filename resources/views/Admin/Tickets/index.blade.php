@extends('layouts.app')

@section('title', 'Liste des Tickets')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Card for listing tickets -->
        <div class="row">
            <div class="col-md-12">
                <!-- Card -->
                <div class="card card-primary bg-dark mt-4">
                    <div class="card-header">
                        <h3 class="card-title">Liste des Tickets</h3>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <!-- Table -->
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">Evenement ID</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Nombres</th>
                                    <th scope="col">Prix</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($datas as $data)
                                    <tr>
                                        <td>{{$data->id}}</td>
                                        <td>{{$data->evenement_id}}</td>
                                        <td>{{$data->type}}</td>
                                        <td>{{$data->nombres}}</td>
                                        <td>{{$data->prix}}</td>
                                        <td>
                                            <!-- Action Buttons -->
                                            <a href="{{ route('tickets') }}" class="btn btn-success btn-sm ">Ajouter un ticket</a>
                                            
                                            <a href="{{ route('tickets.modifier', $data->id) }}" class="btn btn-warning btn-sm ">Modifier</a>
                                            
                                            <form action="{{ route('tickets.supression', $data->id) }}" method="POST" style="display:inline;">
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
