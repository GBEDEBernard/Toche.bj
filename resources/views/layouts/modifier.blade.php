@extends('layouts.app')

@section('title', 'Modifier Contact')

@section('content')

<div class="container mt-5">
    <div class="card shadow-lg p-4 rounded-lg">
        <h2 class="text-center mb-4">Modifier le Contact</h2>

        @if (session('contenu'))
            <div class="alert alert-success">
                {{ session('contenu') }}
            </div>
        @endif

        <form action="{{ route('contact.modification', $data->id) }}" method="post">
            @method('PUT')
            @csrf

            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" name="nom" value="{{ $data->nom }}" 
                    class="form-control" placeholder="Entrez votre nom" required>
                @error('nom')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" name="prenom" value="{{ $data->prenom }}" 
                    class="form-control" placeholder="Entrez votre prénom" required>
                @error('prenom')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" value="{{ $data->email }}" 
                    class="form-control" placeholder="Entrez votre email" required>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="objet" class="form-label">Sujet</label>
                <input type="text" name="objet" value="{{ $data->objet }}" 
                    class="form-control" placeholder="Entrez le sujet" required>
                @error('objet')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="contenu" class="form-label">Message</label>
                <textarea name="contenu" class="form-control" 
                    placeholder="Laissez un message" required>{{ $data->contenu }}</textarea>
                @error('contenu')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary w-100">Modifier le Contact</button>
            </div>
        </form>
    </div>
</div>

@endsection
