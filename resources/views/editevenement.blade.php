@extends('layouts.app')

@section('title', 'Modifier un Événement')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Card for editing event -->
        <div class="row">
            <div class="col-md-12">
                <!-- Card -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Modifier l'Événement</h3>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <!-- Form -->
                        <form action="{{ route('evenements.modification', $data->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Nom -->
                            <div class="form-group">
                                <label for="nom">Nom de l'événement</label>
                                <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom', $data->nom) }}" required>
                                @error('nom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Site Touristique -->
                            <div class="form-group">
                                <label for="site_touristique_id">Site Touristique</label>
                                <select name="site_touristique_id" id="site_touristique_id" class="form-control @error('site_touristique_id') is-invalid @enderror" required>
                                    @foreach($sites as $site)
                                        <option value="{{ $site->id }}" {{ $data->site_touristique_id == $site->id ? 'selected' : '' }}>{{ $site->nom }}</option>
                                    @endforeach
                                </select>
                                @error('site_touristique_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Lieu -->
                            <div class="form-group">
                                <label for="lieu">Lieu</label>
                                <input type="text" name="lieu" id="lieu" class="form-control @error('lieu') is-invalid @enderror" value="{{ old('lieu', $data->lieu) }}" required>
                                @error('lieu')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Date -->
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', $data->date) }}" required>
                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Programme -->
                            <div class="form-group">
                                <label for="programme">Programme</label>
                                <textarea name="programme" id="programme" class="form-control @error('programme') is-invalid @enderror" rows="5">{{ old('programme', $data->programme) }}</textarea>
                                @error('programme')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Programme Détails -->
                            <div class="form-group">
                                <label for="programme_details">Détails du Programme</label>
                                <textarea name="programme_details" id="programme_details" class="form-control @error('programme_details') is-invalid @enderror" rows="5">{{ old('programme_details', $data->programme_details) }}</textarea>
                                @error('programme_details')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Infos Pratiques -->
                            <div class="form-group">
                                <label for="infos_pratiques">Infos Pratiques</label>
                                <textarea name="infos_pratiques" id="infos_pratiques" class="form-control @error('infos_pratiques') is-invalid @enderror" rows="5">{{ old('infos_pratiques', $data->infos_pratiques) }}</textarea>
                                @error('infos_pratiques')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Photo -->
                            <div class="form-group">
                                <label for="photo">Photo</label>
                                <input type="file" name="photo" id="photo" class="form-control-file @error('photo') is-invalid @enderror">
                                @if($data->photo)
                                    <div class="mt-2">
                                        <img src="{{ asset($data->photo) }}" alt="Photo actuelle" style="width: 100px; height: 60px;">
                                    </div>
                                @endif
                                @error('photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Sponsor -->
                            <div class="form-group">
                                <label for="sponsor">Sponsor</label>
                                <input type="text" name="sponsor" id="sponsor" class="form-control @error('sponsor') is-invalid @enderror" value="{{ old('sponsor', $data->sponsor) }}">
                                @error('sponsor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="5">{{ old('description', $data->description) }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Buttons -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                <a href="{{ route('indexevenements') }}" class="btn btn-secondary">Annuler</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
@endsection