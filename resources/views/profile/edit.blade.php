@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Ajout de mt-4 pour espacer le formulaire -->
            <div class="card mt-4"> 
                <div class="card-header">{{ __('Modifier le Profil') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-8">
                                <label for="photo" class="col-sm-4 col-form-label">Photo</label>
                                <input type="file" name="photo" class="form-control" id="photo">
                                @error('photo')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> <br>
                        <button type="submit" class="btn btn-primary">Sauvegarder les changements</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
