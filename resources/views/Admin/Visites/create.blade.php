@extends('layouts.app')

@section('title', 'Visites')

@section('content')
<!-- Page Content -->
<div class="content-wrapper">
    <div class="annonce mb-4">
        <h1>Visites</h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Formulaire de Visite</h3>
                </div>
                <div class="card-body">
                    <p>
                        Le siège de la plateforme de gestion des tourisriques & évènements du Bénin est situé en face de l'église des
                        Assemblées de Dieu d'Alègléta, en quittant le Carrefour TOGOUDO(GODOMEY), juste après l'école primaire EPP TOGOUDO.
                    </p>

                    <p><strong>NB:</strong> Toutes les cages comportant les étoiles <strong class="text-danger">*</strong> sont obligatoires.</p>

                    <form action="{{ route('visites.traitement') }}" method="post" class="forma">
                        @csrf

                        <div class="form-group">
                            <label for="site_touristique_id">Choisissez le site</label>
                            <select name="site_touristique_id" id="site_touristique_id" class="form-control">
                                @foreach($site_touristiques as $site_touristique)
                                    <option value="{{ $site_touristique->id }}">{{ $site_touristique->nom }}</option>
                                @endforeach
                            </select>
                            @error('site_touristique_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="users_id">Choisissez l'utilisateur</label>
                            <select name="users_id" id="users_id" class="form-control">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->nom }}</option>
                                @endforeach
                            </select>
                            @error('users_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="telephone">Téléphone <strong class="text-danger">*</strong></label>
                            <input type="tel" name="telephone" id="telephone" class="form-control" value="{{ old('telephone') }}">
                            @error('telephone')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nombre">Nombres <strong class="text-danger">*</strong></label>
                            <input type="number" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}">
                            @error('nombre')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="prix">Prix <strong class="text-danger">*</strong></label>
                            <input type="number" name="prix" id="prix" class="form-control" value="{{ old('prix') }}">
                            @error('prix')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="date">Date <strong class="text-danger">*</strong></label>
                            <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}">
                            @error('date')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="chemin_ticket">Chemin du Ticket <strong class="text-danger">*</strong></label>
                            <input type="text" name="chemin_ticket" id="chemin_ticket" class="form-control" value="{{ old('chemin_ticket') }}">
                            @error('chemin_ticket')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
