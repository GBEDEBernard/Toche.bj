@extends('layouts.app')

@section('title', 'Liste des Rôles')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Card for listing roles -->
        <div class="row">
            <div class="col-md-12">
                <!-- Card -->
                <div class="card card-primary w-75  mt-4 mx-auto ">
                    <div class="card-header">
                        <h3 class="card-title">Liste des Rôles</h3>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <!-- Table -->
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="text-center" >
                                    <th scope="col">N°</th>
                                    <th scope="col">User ID</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach($datas as $data)
                                    <tr>
                                        <td>{{$data->id}}</td>
                                        <td>{{$data->user_id}}</td>
                                        <td>{{$data->nom}}</td>
                                        <td>
                                            <!-- Action Buttons -->
                                            <a href="{{ route('roles') }}" class="btn btn-success btn-sm ">Ajouter un rôle</a>
                                          
                                            <a href="{{ route('roles.modifier', $data->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                           
                                            <form action="{{ route('roles.supression', $data->id) }}" method="POST" style="display:inline;">
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
