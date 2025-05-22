@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold text-blue-700 text-center mb-4">Modifier la Visite</h2>

        <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-800 p-3 mb-6">
            NB : Toutes les cases comportant des étoiles <span class="text-red-600 font-bold">*</span> sont obligatoires.
        </div>

        <form action="{{ route('visites.modification', $data->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Téléphone -->
            <div>
                <label for="telephone" class="block text-gray-700 font-medium">Téléphone <span class="text-red-600">*</span></label>
                <input type="tel" name="telephone" id="telephone" value="{{ old('telephone', $data->telephone) }}" required
                       class="w-full mt-1 border border-gray-300 rounded-md p-2">
                @error('telephone')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nombre -->
            <div>
                <label for="nombre" class="block text-gray-700 font-medium">Nombres <span class="text-red-600">*</span></label>
                <input type="number" name="nombre" id="nombre" value="{{ old('nombre', $data->nombre) }}" required
                       class="w-full mt-1 border border-gray-300 rounded-md p-2">
                @error('nombre')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Prix -->
            <div>
                <label for="prix" class="block text-gray-700 font-medium">Prix <span class="text-red-600">*</span></label>
                <input type="number" name="prix" id="prix" value="{{ old('prix', $data->prix) }}" required
                       class="w-full mt-1 border border-gray-300 rounded-md p-2">
                @error('prix')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date -->
            <div>
                <label for="date" class="block text-gray-700 font-medium">Date <span class="text-red-600">*</span></label>
                <input type="date" name="date" id="date" value="{{ old('date', $data->date) }}" required
                       class="w-full mt-1 border border-gray-300 rounded-md p-2">
                @error('date')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex justify-center gap-4 mt-6">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                    Enregistrer
                </button>
                <a href="{{ route('indexvisites') }}" class="bg-pink-600 text-white px-6 py-2 rounded hover:bg-pink-700 transition">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
