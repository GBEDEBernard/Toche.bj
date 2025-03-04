@extends('layouts.app')

@section('content')
<!-- Page Content -->
<div class="content-wrapper">
    <div class="annonce mb-4">
        <h1>Modifier la Réservation</h1>
    </div>

    <div class="nb mb-4">
        <h4>NB: Toutes les cases comportant les étoiles <strong class="text-danger">*</strong> sont obligatoires.</h4>
    </div>

    <!-- Formulaire de modification -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Modifier la Réservation</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('reservations.modification', $data->id) }}" method="post" class="forma">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="nombre">Nombre de Réservations <strong class="text-danger">*</strong></label>
                    <input type="number" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $data->nombre) }}">
                    @error('nombre')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="prix">Prix <strong class="text-danger">*</strong></label>
                    <input type="number" name="prix" id="prix" class="form-control" value="{{ old('prix', $data->prix) }}">
                    @error('prix')
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

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
