@extends('layouts.app')

@section('title', 'Formulaire d\'Inscription')

@section('content')
<div class="container mt-5">
    <!-- Section Annonce -->
    <div class="alert alert-info">
        <h1 class="text-center">Utilisateurs</h1>
        <p class="text-center">
            Le siège de la plateforme de gestion des touristiques & événements du Bénin est situé en face de l'église des
            Assemblées de Dieu d'Alègléta, en quittant le Carrefour TOGOUDO (GODOMEY), juste après l'école primaire EPP TOGOUDO.
        </p>
    </div>

    <!-- Message NB -->
    <div class="alert alert-warning">
        <h4>NB : Toutes les cases comportant une étoile <strong class="text-danger">*</strong> sont obligatoires.</h4>
    </div>

    <!-- Formulaire -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Formulaire d'Inscription</h3>
        </div>

        <form action="{{ route('users.traitement') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
            @csrf
            <div class="card-body">
                <!-- Champ Nom -->
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Nom <strong class="text-danger">*</strong></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Entrez votre nom" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

              
                <!-- Correction de l'upload d'image -->
                <div class="form-group mt-3">
                            <label for="photo">Photo <strong class="text-danger">*</strong></label>
                            <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
                            @error('photo')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                <!-- Champ Email -->
                <div class="form-group row mt-3">
                    <label for="email" class="col-sm-2 col-form-label">Email <strong class="text-danger">*</strong></label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Entrez votre email" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Champ Statut -->
                <div class="form-group row mt-3">
                    <label for="status" class="col-sm-2 col-form-label">Statut <strong class="text-danger">*</strong></label>
                    <div class="col-sm-10">
                        <select class="form-control @error('status') is-invalid @enderror" name="status" id="status" required>
                            <option value="actif">Actif</option>
                            <option value="inactif">Inactif</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Champ Mot de Passe -->
                <div class="form-group row mt-3">
                    <label for="password" class="col-sm-2 col-form-label">Mot de passe</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Entrez votre mot de passe" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Champ Confirmation Mot de Passe -->
                <div class="form-group row mt-3">
                    <label for="password_confirmation" class="col-sm-2 col-form-label">Confirmez le mot de passe</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
                    </div>
                </div>

            </div>

            <!-- Card Footer -->
            <div class="card-footer">
                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
