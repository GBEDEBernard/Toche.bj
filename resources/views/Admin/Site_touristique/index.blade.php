@extends('layouts.app')

@section('content')
<div class="content-wrapper mt-4">
    <!-- Section d'annonce -->
    <section class="content-header">
        <h1 class="text-center">Liste des Sites Touristiques</h1>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-dark table-striped-columns">
                    <thead>
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
                                <td>{{$data->categorie_id}}</td>
                                <td>{{$data->pays}}</td>
                                <td>{{$data->departement}}</td>
                                <td>{{$data->commune}}</td>
                                <td>{{$data->email}}</td>
                                <td><img src="{{ asset ($data->photo) }}" alt="Photo du site"   style="width: 100px; height: 60px;"></td>
                                <td>{{$data->contact}}</td>
                                <td>{{$data->description}}</td>
                                <td>
                                    <a href="{{ route('create') }}" class="btn btn-info btn-sm">Ajouter un site</a>
                                    <a href="{{ route('site.modifier', $data->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                    <form action="{{ route('Site.supression', $data->id) }}" method="post" style="display:inline;">
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
    </section>
</div>
@endsection
