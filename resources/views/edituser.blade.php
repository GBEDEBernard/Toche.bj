@extends('layouts.app')

@section('title', 'Modification d\'Utilisateur')

@section('content')
<div class="container mx-auto py-8 px-4">
    <!-- Annonce -->
    <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-800 p-2 w-3/5 text-center ml-[250px] rounded mb-6">
        <h2 class="text-xl font-bold text-center">Modification d'Utilisateur</h2>
        <p class="text-sm mt-2 text-center">
            Le siège de la plateforme de gestion des touristiques & événements du Bénin est situé en face de l'église des
            Assemblées de Dieu d'Alègléta, en quittant le Carrefour TOGOUDO (GODOMEY), juste après l'école primaire EPP TOGOUDO.
        </p>
    </div>

    <!-- NB -->
    <div class="  text-yellow-700 p-4 rounded mb-6">
        <p class="font-semibold text-center" >NB : Toutes les cases comportant une étoile <span class="text-red-600">*</span> sont obligatoires.</p>
    </div>

    <!-- Formulaire -->
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-3xl mx-auto">
        <h3 class="text-lg font-semibold text-blue-700 mb-4">Modifier un Utilisateur</h3>

        <form action="{{ route('users.modification', $data->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nom -->
            <div>
                <label for="name" class="block text-gray-700 font-medium">Nom <span class="text-red-600">*</span></label>
                <input type="text" name="name" id="name" required
                    value="{{ old('name', $data->name) }}"
                    class="w-full mt-1 border border-gray-300 rounded-md p-2 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Photo -->
            <div>
                <label for="photo" class="block text-gray-700 font-medium">Photo <span class="text-red-600">*</span></label>
                @if($data->photo)
                    <div class="my-2">
                        <img src="{{ asset('storage/'.$data->photo) }}" alt="Photo actuelle" class="max-w-[150px] rounded shadow">
                    </div>
                @endif
                <input type="file" name="photo" id="photo"
                    class="w-full border border-gray-300 rounded-md p-2 mt-1">
                @error('photo')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-gray-700 font-medium">Email <span class="text-red-600">*</span></label>
                <input type="email" name="email" id="email" required
                    value="{{ old('email', $data->email) }}"
                    class="w-full mt-1 border border-gray-300 rounded-md p-2 @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

           
            <div>
                <label for="status" class="block text-gray-700 font-medium">Statut <span class="text-red-600">*</span></label>
                <select name="status" id="status" class="w-full mt-1 border border-gray-300 rounded-md p-2" required>
                    <option value="actif" {{ old('status', $data->status) === 'actif' ? 'selected' : '' }}>Actif</option>
                    <option value="inactif" {{ old('status', $data->status) === 'inactif' ? 'selected' : '' }}>Inactif</option>
                </select>
                @error('status')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bouton -->
            <div class="text-right">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">
                    💾 Modifier
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
