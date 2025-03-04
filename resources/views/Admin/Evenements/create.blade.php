@extends('layouts.app')

@section('title', 'Evenements')

@section('content')
<!-- Page Content -->
<div class="content-wrapper">
    <div class="annonce mb-4">
        <h1>Evenements</h1>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Formulaire d'Evenement</h3>
                </div>

                <div class="card-body">
                    <p>
                        Le siège de la plateforme de gestion des touristiques & évènements du Bénin est situé en face de l'église des
                        Assemblées de Dieu d'Alègléta, en quittant le Carrefour TOGOUDO(GODOMEY), juste après l'école primaire EPP TOGOUDO.
                    </p>

                    <p><strong>NB:</strong> Toutes les cages comportant les étoiles <strong class="text-danger">*</strong> sont obligatoires.</p>

                    <!-- Ajout de enctype pour gérer les fichiers -->
                    <form action="{{ route('evenements.traitement') }}" method="post" class="forma" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="nom">Nom d'Evenement <strong class="text-danger">*</strong></label>
                            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom') }}">
                            @error('nom')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="site_touristique_id">Choisissez le site</label>
                            <select name="site_touristique_id" id="site_touristique_id" class="form-control">
                                @foreach($site_touristiques as $site_touristique)
                                    <option value="{{ $site_touristique->id }}" 
                                        {{ old('site_touristique_id') == $site_touristique->id ? 'selected' : '' }}>
                                        {{ $site_touristique->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="lieu">Lieu <strong class="text-danger">*</strong></label>
                            <input type="text" name="lieu" id="lieu" class="form-control" value="{{ old('lieu') }}">
                            @error('lieu')
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

                        <!-- Correction de l'upload d'image -->
                        <div class="form-group">
                            <label for="photo">Photo <strong class="text-danger">*</strong></label>
                            <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
                            @error('photo')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="sponsor">Sponsors <strong class="text-danger">*</strong></label>
                            <input type="text" name="sponsor" id="sponsor" class="form-control" value="{{ old('sponsor') }}">
                            @error('sponsor')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description <strong class="text-danger">*</strong></label>
                            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                            @error('description')
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
