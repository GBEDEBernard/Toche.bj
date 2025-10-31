@extends('layouts.app')

@section('title', 'Modifier un Événement')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title mb-0">📝 Modifier l'Événement</h3>
                    </div>

                    <div class="card-body bg-light">
                        <form action="{{ route('evenements.modification', $data->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Nom -->
                            <div class="form-group mb-3">
                                <label for="nom" class="font-weight-bold">Nom de l'événement</label>
                                <input type="text" name="nom" id="nom"
                                    class="form-control @error('nom') is-invalid @enderror"
                                    value="{{ old('nom', $data->nom) }}" required>
                                @error('nom')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Site Touristique -->
                            <div class="form-group mb-3">
                                <label for="site_touristique_id" class="font-weight-bold">Site Touristique</label>
                                <select name="site_touristique_id" id="site_touristique_id"
                                    class="form-control @error('site_touristique_id') is-invalid @enderror" required>
                                    @foreach($tousLesSites as $site)
                                        <option value="{{ $site->id }}"
                                            {{ $siteActuel && $siteActuel->id == $site->id ? 'selected' : '' }}>
                                            {{ $site->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('site_touristique_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Lieu -->
                            <div class="form-group mb-3">
                                <label for="lieu" class="font-weight-bold">Lieu</label>
                                <input type="text" name="lieu" id="lieu"
                                    class="form-control @error('lieu') is-invalid @enderror"
                                    value="{{ old('lieu', $data->lieu) }}" required>
                                @error('lieu')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Date -->
                            <div class="form-group mb-3">
                                <label for="date" class="font-weight-bold">Date</label>
                                <input type="date" name="date" id="date"
                                    class="form-control @error('date') is-invalid @enderror"
                                    value="{{ old('date', $data->date) }}" required>
                                @error('date')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Programme -->
                            <div class="form-group mb-3">
                                <label for="programme" class="font-weight-bold">Programme</label>
                                <textarea name="programme" id="programme" rows="4"
                                    class="form-control @error('programme') is-invalid @enderror">{{ old('programme', $data->programme) }}</textarea>
                                @error('programme')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Programme Détails -->
                            <div class="form-group mb-3">
                                <label for="programme_details" class="font-weight-bold">Détails du Programme</label>
                                <textarea name="programme_details" id="programme_details" rows="4"
                                    class="form-control @error('programme_details') is-invalid @enderror">{{ old('programme_details', $data->programme_details) }}</textarea>
                                @error('programme_details')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Infos Pratiques -->
                            <div class="form-group mb-3">
                                <label for="infos_pratiques" class="font-weight-bold">Infos Pratiques</label>
                                <textarea name="infos_pratiques" id="infos_pratiques" rows="4"
                                    class="form-control @error('infos_pratiques') is-invalid @enderror">{{ old('infos_pratiques', $data->infos_pratiques) }}</textarea>
                                @error('infos_pratiques')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Photo -->
                            <div class="form-group mb-3">
                                <label for="photo" class="font-weight-bold">Photo</label>
                                <input type="file" name="photo" id="photo" class="form-control-file @error('photo') is-invalid @enderror">
                                @if($data->photo)
                                    <div class="mt-3">
                                        <p class="text-muted mb-1">Photo actuelle :</p>
                                        <img src="{{ asset($data->photo) }}" alt="Photo actuelle" class="img-thumbnail" style="width: 150px; height: 100px; object-fit: cover;">
                                    </div>
                                @endif
                                @error('photo')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Sponsor -->
                            <div class="form-group mb-3">
                                <label for="sponsor" class="font-weight-bold">Sponsor</label>
                                <input type="text" name="sponsor" id="sponsor"
                                    class="form-control @error('sponsor') is-invalid @enderror"
                                    value="{{ old('sponsor', $data->sponsor) }}">
                                @error('sponsor')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="form-group mb-3">
                                <label for="description" class="font-weight-bold">Description</label>
                                <textarea name="description" id="description" rows="4"
                                    class="form-control @error('description') is-invalid @enderror">{{ old('description', $data->description) }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Boutons -->
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-success px-4">
                                    <i class="fas fa-save mr-2"></i> Mettre à jour
                                </button>
                                <a href="{{ route('indexevenements') }}" class="btn btn-secondary px-4">
                                    <i class="fas fa-times mr-2"></i> Annuler
                                </a>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>

@if (session('success'))
    <div class="alert alert-success mt-3 text-center">{{ session('success') }}</div>
@endif

@if (session('error'))
    <div class="alert alert-danger mt-3 text-center">{{ session('error') }}</div>
@endif
@endsection
