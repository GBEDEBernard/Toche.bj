@extends('layouts.app')

@section('content')
<!-- Page Content -->
<div class="content-wrapper">
    <div class="annonce mb-4">
        <h1>Modifier l'Événement</h1>
    </div>

    <div class="nb mb-4">
        <h4>NB: Toutes les cases comportant les étoiles <strong class="text-danger">*</strong> sont obligatoires.</h4>
    </div>

    <!-- Formulaire de modification -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Modifier l'Événement</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('evenements.modification', $data->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="nom">Nom d'Événement <strong class="text-danger">*</strong></label>
                    <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $data->nom) }}">
                    @error('nom')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="lieu">Lieu <strong class="text-danger">*</strong></label>
                    <input type="text" name="lieu" id="lieu" class="form-control" value="{{ old('lieu', $data->lieu) }}">
                    @error('lieu')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="date">Date <strong class="text-danger">*</strong></label>
                    <input type="date" name="date" id="date" class="form-control" value="{{ old('date', $data->date) }}">
                    @error('date')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="photo">Photo <strong class="text-danger">*</strong></label>
                    <input type="file" name="photo" id="photo" class="form-control">
                    @error('photo')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="sponsor">Sponsors <strong class="text-danger">*</strong></label>
                    <input type="text" name="sponsor" id="sponsor" class="form-control" value="{{ old('sponsor', $data->sponsor) }}">
                    @error('sponsor')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description <strong class="text-danger">*</strong></label>
                    <input type="text" name="description" id="description" class="form-control" value="{{ old('description', $data->description) }}">
                    @error('description')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Bouton de soumission -->
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
