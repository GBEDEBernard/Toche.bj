@extends('layouts.app')

@section('content')
<div class="content-wrapper mt-4">
    <section class="content-header">
        <h1 class="text-center">Modifier le Rôle</h1>
    </section>

    <section class="content">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Modification du rôle</h3>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('roles.modification', $data->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="nom">Nom du rôle <strong class="text-danger">*</strong></label>
                                <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom', $data->nom) }}" required>
                                
                                @error('nom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group text-center mt-4">
                                <button type="submit" class="btn btn-primary">Modifier</button>
                                <a href="{{ route('indexroles') }}" class="btn btn-secondary">Annuler</a>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
@endsection
