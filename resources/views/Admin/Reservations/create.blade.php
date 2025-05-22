@extends('layouts.app')

@section('title', 'Reservations')

@section('content')
<!-- Page Content -->
<div class="content-wrapper">
    <div class="annonce mb-4">
        <h1>Reservations</h1>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card ml-4">
                <div class="card-header">
                    <h3 class="card-title">Formulaire de Réservation</h3>
                </div>

                <div class="card-body p-4">
                    <p>
                        Le siège de la plateforme de gestion des tourisriques & évènements du Bénin est situé en face de l'église des
                        Assemblées de Dieu d'Alègléta, en quittant le Carrefour TOGOUDO(GODOMEY), juste après l'école primaire EPP TOGOUDO.
                    </p>

                    <p><strong>NB:</strong> Toutes les cages comportant les étoiles <strong class="text-danger">*</strong> sont obligatoires.</p>

                    <form action="{{ route('reservations.traitement') }}" method="post" class="forma p-4">
                        @csrf

                        <div class="mb-2">
                            <label for="evenement_id" class="block font-semibold text-gray-700 font-bold">Événement</label>
                            <select name="evenement_id" id="evenement_id" class="w-full border border-gray-300 rounded-lg p-2 " required>
                                <option value="">-- Sélectionnez un événement --</option>
                                @foreach ($evenements as $evenement)
                                    <option value="{{ $evenement->id }}">{{ $evenement->nom }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-2">
                            <label for="users_id" class="block font-semibold text-gray-700 font-bold">Utilisateur</label>
                            <select name="users_id" id="users_id" class="w-full border border-gray-300 rounded-lg p-2" required>
                                <option value="">-- Sélectionnez un utilisateur --</option>
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                      
                        <div class="form-group mb-2">
                            <label for="nombre" class="font-bold">Nombres <strong class="text-danger">*</strong></label>
                            <input type="number" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}">
                            @error('nombre')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="prix" class="font-bold">Prix <strong class="text-danger">*</strong></label>
                            <input type="number" name="prix" id="prix" class="form-control" value="{{ old('prix') }}">
                            @error('prix')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="date" class="font-bold">Date <strong class="text-danger">*</strong></label>
                            <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}">
                            @error('date')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-4">

                            <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded text-xl font-extrabold">Créer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
