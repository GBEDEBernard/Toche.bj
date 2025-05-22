@extends('layouts.app')

@section('title', 'Modifier galerie')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary mt-4">
            <div class="card-header">
                <h3 class="card-title">Modifier une photo de la galerie</h3>
            </div>

            <form action="{{ route('galerie.update', $galerie->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="evenement_id">Événement</label>
                        <select name="evenement_id" id="evenement_id" class="form-control">
                            @foreach ($evenements as $event)
                                <option value="{{ $event->id }}" {{ $galerie->evenement_id == $event->id ? 'selected' : '' }}>
                                    {{ $event->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="site_touristique_id">Site Touristique</label>
                        <select name="site_touristique_id" id="site_touristique_id" class="form-control">
                            @foreach ($sites as $site)
                                <option value="{{ $site->id }}" {{ $galerie->site_touristique_id == $site->id ? 'selected' : '' }}>
                                    {{ $site->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nom">Nom de la photo</label>
                        <input type="text" name="nom" id="nom" value="{{ $galerie->nom }}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Image actuelle</label><br>
                        <img src="{{ asset('storage/' . $galerie->photo) }}" alt="Image actuelle" class="img-thumbnail" style="max-width: 200px;">
                    </div>

                    <div class="form-group">
                        <label for="photo">Nouvelle Image (optionnel)</label>
                        <input type="file" name="photo" id="photo" class="form-control-file">
                    </div>
                </div>

                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-success">Mettre à jour</button>
                    <a href="{{ route('galeries.index') }}" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
