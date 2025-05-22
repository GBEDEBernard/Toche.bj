@extends('layouts.app')

@section('title', 'Modifier Réservation')

@section('content')
<!-- Page Content -->
<div class="content-wrapper">
    <div class="annonce mb-4 mt-3 ml-4">
        <h1 >Modifier la Réservation</h1>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card ml-4">
                <div class="card-header">
                    <h3 class="card-title">Formulaire de Modification</h3>
                </div>

                <div class="card-body">
                    <p>
                        Modifiez les informations de réservation pour l'événement et l'utilisateur sélectionnés.
                    </p>

                    <p><strong>NB:</strong> Toutes les cases comportant les étoiles <strong class="text-danger">*</strong> sont obligatoires.</p>

                    <form action="{{ route('reservations.modification', $data->id) }}" method="POST" class="forma">
                        @csrf
                        @method('PUT')

                        <div class="mb-2">
                            <label for="evenement_id" class="block font-semibold text-gray-700">Événement</label>
                            <select name="evenement_id" id="evenement_id" class="w-full border border-gray-300 rounded-lg p-2" required>
                                <option value="">-- Sélectionnez un événement --</option>
                                @foreach ($evenements as $evenement)
                                    <option value="{{ $evenement->id }}" {{ $evenement->id == $data->evenement_id ? 'selected' : '' }}>
                                        {{ $evenement->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-2">
                            <label for="users_id" class="block font-semibold text-gray-700">Utilisateur</label>
                            <select name="users_id" id="users_id" class="w-full border border-gray-300 rounded-lg p-2" required>
                                <option value="">-- Sélectionnez un utilisateur --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $user->id == $data->users_id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                      
                        <div class="form-group mb-2">
                            <label for="nombre">Nombres <strong class="text-danger">*</strong></label>
                            <input type="number" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $data->nombre) }}" required>
                            @error('nombre')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="prix">Prix <strong class="text-danger">*</strong></label>
                            <input type="number" name="prix" id="prix" class="form-control" value="{{ old('prix', $data->prix) }}" required>
                            @error('prix')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="date">Date <strong class="text-danger">*</strong></label>
                            <input type="date" name="date" id="date" class="form-control" value="{{ old('date', $data->date) }}" required>
                            @error('date')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                            <a href="{{ route('indexreservations') }}" class="btn btn-secondary">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
