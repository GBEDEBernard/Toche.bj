@extends('layouts.app')

@section('title', 'Tickets')

@section('content')
<!-- Page Content -->
<div class="content-wrapper">
    <div class="annonce mb-4 ml-4">
        <h1>Tickets</h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Formulaire de Ticket</h3>
                </div>
                <div class="card-body p-4">
                    <p>
                        Le siège de la plateforme de gestion des tourisriques & évènements du Bénin est situé en face de l'église des
                        Assemblées de Dieu d'Alègléta, en quittant le Carrefour TOGOUDO(GODOMEY), juste après l'école primaire EPP TOGOUDO.
                    </p>

                    <p><strong>NB:</strong> Toutes les cages comportant les étoiles <strong class="text-danger">*</strong> sont obligatoires.</p>

                    <form action="{{ route('tickets.traitement') }}" method="post" class="forma">
                        @csrf

                        <div class="form-group mt-3">
                            <label for="evenement_id" class="font-bold">Choisissez l'événement</label>
                            <select name="evenement_id" id="evenement_id" class="form-control">
                                @foreach($evenements as $evenement)
                                    <option value="{{ $evenement->id }}">{{ $evenement->nom }}</option>
                                @endforeach
                            </select>
                            @error('evenement_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="type" class="font-bold">Types <strong class="text-danger">*</strong></label>
                            <input type="text" name="type" id="type" class="form-control" value="{{ old('type') }}">
                            @error('type')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="nombres" class="font-bold">Nombres <strong class="text-danger">*</strong></label>
                            <input type="number" name="nombres" id="nombres" class="form-control" value="{{ old('nombres') }}">
                            @error('nombres')
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
