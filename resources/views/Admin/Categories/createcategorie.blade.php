@extends('layouts.app')

@section('title', 'Categorie')

@section('content')
<!-- Page Content -->
<section class="content">
    <div class="container-fluid mt-4 w-80">
        <!-- Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Catégorie de site touristique</h3>
            </div>
            <div class="card-body">
                <p>Le siège de la plateforme de gestion des sites touristiques & évènements du Bénin est situé en face de l'église des Assemblées de Dieu d'Alègléta, en quittant le Carrefour TOGOUDO (Godomey), juste après l'école primaire EPP TOGOUDO.</p>
                
                <div class="alert alert-info">
                    <h4>NB : Toutes les cases comportant les étoiles <strong class="text-danger">*</strong> sont obligatoires.</h4>
                </div>
                
                <!-- Formulaire -->
                <form action="{{ route('categorie.traitement') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="types">Types de site touristique <strong class="text-danger">*</strong></label>
                        <input type="text" name="types" id="types" class="form-control" required>
                    </div>
                    
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mt-2">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
