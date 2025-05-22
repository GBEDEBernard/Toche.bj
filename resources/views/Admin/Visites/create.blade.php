@extends('layouts.app')

@section('title', 'Visites')

@section('content')
<!-- Page Content -->
<div class="content-wrapper p-3">
    <div class="annonce mb-4 ml-3">
        <h1>Visites</h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Formulaire de Visite</h3>
                </div>
                <div class="card-body p-4">
                    <p class="p-2">
                        Le siège de la plateforme de gestion des tourisriques & évènements du Bénin est situé en face de l'église des
                        Assemblées de Dieu d'Alègléta, en quittant le Carrefour TOGOUDO(GODOMEY), juste après l'école primaire EPP TOGOUDO.
                    </p>

                    <p class="p-2"><strong>NB:</strong> Toutes les cages comportant les étoiles <strong class="text-danger">*</strong> sont obligatoires.</p>

                    <form action="{{ route('visites.traitement') }}" method="post" class="forma p-4">
                        @csrf

                        <div class="form-group mt-3">
                            <label for="site_touristique_id" class="font-bold">Choisissez le site</label>
                            <select name="site_touristique_id" id="site_touristique_id" class="form-control">
                                @foreach($site_touristiques as $site_touristique)
                                    <option value="{{ $site_touristique->id }}">{{ $site_touristique->nom }}</option>
                                @endforeach
                            </select>
                            @error('site_touristique_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="user_id" class="font-bold">Choisissez l'utilisateur</label>
                            <select name="user_id" id="users_id" class="form-control">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('users_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="telephone" class="font-bold">Téléphone <strong class="text-danger">*</strong></label>
                            <input type="tel" name="telephone" id="telephone" class="form-control" value="{{ old('telephone') }}">
                            @error('telephone')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="nombre" class="font-bold">Nombres <strong class="text-danger">*</strong></label>
                            <input type="number" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}">
                            @error('nombre')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="prix" class="font-bold">Prix <strong class="text-danger">*</strong></label>
                            <input type="number" name="prix" id="prix" class="form-control" value="{{ old('prix') }}">
                            @error('prix')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="date" class="font-bold">Date <strong class="text-danger">*</strong></label>
                            <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}">
                            @error('date')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="chemin_ticket" class="font-bold">Chemin du Ticket <strong class="text-danger">*</strong></label>
                            <input type="text" name="chemin_ticket" id="chemin_ticket" class="form-control" value="{{ old('chemin_ticket') }}">
                            @error('chemin_ticket')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded text-xl font-extrabold">Envoyer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
