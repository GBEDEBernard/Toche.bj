@extends('layouts.app')

@section('title', 'Roles')

@section('content')
<!-- Page Content -->
<div class="content-wrapper">
    <div class="annonce mb-4">
        <h1>Gestion des Rôles</h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card w-75">
                <div class="card-header">
                    <h3 class="card-title">Assigner un rôle à un utilisateur</h3>
                </div>
                <div class="card-body">
                    <p>
                        Le siège de la plateforme de gestion des tourisriques & évènements du Bénin est situé en face de l'église des
                        Assemblées de Dieu d'Alègléta, en quittant le Carrefour TOGOUDO(GODOMEY), juste après l'école primaire EPP TOGOUDO.
                    </p>

                    <p><strong>NB:</strong> Toutes les cages comportant les étoiles <strong class="text-danger">*</strong> sont obligatoires.</p>

                    <form action="{{ route('roles.traitement') }}" method="post" class="forma">
                        @csrf

                        <div class="form-group">
                            <label for="user_id">Choisissez un utilisateur</label>
                            <select name="user_id" id="user_id" class="form-control">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->nom }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nom">Nom du rôle <strong class="text-danger">*</strong></label>
                            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom') }}">
                            @error('nom')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">Assigner le rôle</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
