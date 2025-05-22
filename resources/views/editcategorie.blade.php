@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="max-w-xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold text-center text-blue-700 mb-4">Modifier la Catégorie</h2>

        <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-800 p-3 mb-6">
            Merci, vous êtes sur la page de modification. Veuillez remplir ce formulaire.
        </div>

        @if (session('contenu'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('contenu') }}
            </div>
        @endif

        <form action="{{ route('categorie.modification', $data->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Champ Type de Catégorie -->
            <div>
                <label for="types" class="block text-gray-700 font-medium">Type de Catégorie <span class="text-red-600">*</span></label>
                <input type="text" name="types" id="types" value="{{ $data->types }}" required
                    class="w-full mt-1 border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- Boutons -->
            <div class="flex justify-between items-center mt-6">
                <a href="{{ route('indexcategorie') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition duration-150">
                    ← Retour
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-150">
                    💾 Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
