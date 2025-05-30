@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-xl font-semibold text-gray-800 mb-6">Ajouter une Pièce d'identité</h2>

    <form action="{{ route('piece.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="user_id" class="block text-sm font-medium">Utilisateur</label>
            <select name="user_id" id="user_id" class="w-full mt-1 border-gray-300 rounded">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="type" class="block text-sm font-medium">Type</label>
            <input type="text" name="type" class="w-full mt-1 border-gray-300 rounded" placeholder="ex: CNI, Passeport" required>
        </div>

        <div class="mb-4">
            <label for="numero" class="block text-sm font-medium">Numéro</label>
            <input type="text" name="numero" class="w-full mt-1 border-gray-300 rounded" required>
        </div>

        <div class="mb-4">
            <label for="date_expiration" class="block text-sm font-medium">Date d'expiration</label>
            <input type="date" name="date_expiration" class="w-full mt-1 border-gray-300 rounded">
        </div>

        <div class="mb-4">
            <label for="scan" class="block text-sm font-medium">Fichier Scan</label>
            <input type="file" name="scan" class="w-full mt-1 border-gray-300 rounded">
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">
            Enregistrer
        </button>
    </form>
</div>
@endsection
