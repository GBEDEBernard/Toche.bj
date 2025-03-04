@extends('layouts.app') <!-- Ton layout principal -->

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-4"> <!-- Correction ici -->
                <div class="card-header">{{ __('Mon Profil') }}</div>

                <div class="card-body">
                    <h3>{{ $user->name }}</h3>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Date d'inscription:</strong> {{ $user->created_at->format('d-m-Y') }}</p>
                    <p><strong>Dernière connexion:</strong> {{ $user->last_login_at ? $user->last_login_at->format('d-m-Y H:i') : 'Jamais' }}</p>
                    
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Modifier le Profil</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
