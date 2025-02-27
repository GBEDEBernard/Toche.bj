@extends('layouts.app')

@section('title', 'Formulaire')

@section('content')
<div class="container mt-5">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Formulaire d'inscription</h3>
        </div>
        <form action="{{ route('formulaire.submit') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez votre nom">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre email">
                    </div>
                </div>

                <div class="form-group">
                    <label for="motdepasse">Mot de passe</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control" id="motdepasse" name="motdepasse" placeholder="Entrez votre mot de passe">
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Envoyer</button>
            </div>
        </form>
    </div>
</div>
@endsection
