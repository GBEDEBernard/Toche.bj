@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Modifier la visite</h3>
                </div>

                <div class="card-body">
                    <p><strong>NB : Toutes les cases comportant des étoiles <strong class="text-danger">*</strong> sont obligatoires.</strong></p>

                    <form action="{{ route('visites.modification', $data->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Téléphone -->
                        <div class="form-group">
                            <label for="telephone">Téléphone <strong class="text-danger">*</strong></label>
                            <input type="tel" name="telephone" id="telephone" class="form-control" value="{{ old('telephone', $data->telephone) }}" required>
                            @error('telephone')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nombre -->
                        <div class="form-group">
                            <label for="nombre">Nombres <strong class="text-danger">*</strong></label>
                            <input type="number" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $data->nombre) }}" required>
                            @error('nombre')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Prix -->
                        <div class="form-group">
                            <label for="prix">Prix <strong class="text-danger">*</strong></label>
                            <input type="number" name="prix" id="prix" class="form-control" value="{{ old('prix', $data->prix) }}" required>
                            @error('prix')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Date -->
                        <div class="form-group">
                            <label for="date">Date <strong class="text-danger">*</strong></label>
                            <input type="date" name="date" id="date" class="form-control" value="{{ old('date', $data->date) }}" required>
                            @error('date')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">ENVOYEZ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


