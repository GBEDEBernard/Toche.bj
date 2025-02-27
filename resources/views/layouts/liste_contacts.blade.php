@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Liste des Contacts</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title"><i class="fas fa-address-book"></i> Contacts</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>N°</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Objet</th>
                                <th>Email</th>
                                <th>Contenu</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datas as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->nom }}</td>
                                <td>{{ $data->prenom }}</td>
                                <td>{{ $data->objet }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->contenu }}</td>
                                <td>
                                <a href="{{ route('contact.modifier', $data->id) }}" class="btn btn-success btn-sm">Modifier</a>

                                <form action="{{ route('contact.supression', $data->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                     @method('DELETE')
                                     <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer ce contact ?');">
                                     <i class="fas fa-trash-alt"></i> Supprimer
                                     </button>
                                   </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
