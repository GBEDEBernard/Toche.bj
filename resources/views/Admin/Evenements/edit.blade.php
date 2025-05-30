@extends('layouts.app')

@section('title', 'Modifier Événement')

@section('content')
<!-- Page Content -->
<div class="content-wrapper">
    <div class="annonce mb-4 mt-3 ml-4">
        <h1>Modifier l'Événement</h1>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card ml-4">
                <div class="card-header">
                    <h3 class="card-title">Formulaire de Modification</h3>
                </div>

                <div class="card-body">
                    <p>
                        Modifiez les informations de l'événement pour le site touristique sélectionné.
                    </p>

                    <p><strong>NB:</strong> Toutes les cases comportant les étoiles <strong class="text-danger">*</strong> sont obligatoires.</p>

                    <form action="{{ route('evenements.modification', $data->id) }}" method="POST" enctype="multipart/form-data" class="forma">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-2">
                            <label for="nom">Nom d'Événement <strong class="text-danger">*</strong></label>
                            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $data->nom) }}" required>
                            @error('nom')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="site_touristique_id">Site Touristique <strong class="text-danger">*</strong></label>
                            <select name="site_touristique_id" id="site_touristique_id" class="form-control" required>
                                <option value="">-- Sélectionnez un site --</option>
                                @foreach($sites as $site)
                                    <option value="{{ $site->id }}" {{ $site->id == $data->site_touristique_id ? 'selected' : '' }}>
                                        {{ $site->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('site_touristique_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="lieu">Lieu <strong class="text-danger">*</strong></label>
                            <input type="text" name="lieu" id="lieu" class="form-control" value="{{ old('lieu', $data->lieu) }}" required>
                            @error('lieu')
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
                    {{-- Champ programme --}}
                    <div class="form-group mb-2">
                        <label for="programme" class="block text-gray-700 font-bold mb-2">Programme</label>
                        <textarea name="programme" id="programme" rows="4"
                            class="w-full p-3 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            {{ old('programme', $data->programme ?? '') }}
                        </textarea>
                    </div>

                    {{-- Champ programme_details --}}
                    <div class="form-group mb-2">
                        <label for="programme_details" class="block text-gray-700 font-bold mb-2">Détails du Programme</label>
                        <textarea name="programme_details" id="programme_details" rows="5"
                            class="w-full p-3 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            {{ old('programme_details', $data->programme_details ?? '') }}
                        </textarea>
                        <p class="text-sm text-gray-500 mt-1">Sépare chaque point du programme par une ligne.</p>
                    </div>

                        @if($data->photo)
                        <div class="form-group mb-2">
                            <label class="font-bold">Photo actuelle :</label><br>
                            <img src="{{ asset($data->photo) }}" alt="Photo actuelle" style="max-height: 150px;">
                        </div>
                        @endif

                        <div class="form-group mb-2">
                            <label for="photo">Changer la photo</label>
                            <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
                            @error('photo')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="sponsor">Sponsor <strong class="text-danger">*</strong></label>
                            <input type="text" name="sponsor" id="sponsor" class="form-control" value="{{ old('sponsor', $data->sponsor) }}" required>
                            @error('sponsor')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="description">Description <strong class="text-danger">*</strong></label>
                            <textarea name="description" id="description" class="form-control" required>{{ old('description', $data->description) }}</textarea>
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @dd($user->roles, $user->getAllPermissions());

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
                            <a href="{{ route('indexevenements') }}" class="btn btn-secondary">Annuler</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
