@extends('bloglayout')

@section('contenu')
<div class="container mx-auto px-6 py-8">
    <!-- Titre de la page -->
    <div class="text-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Modifier votre Ticket</h1>
    </div>

    <!-- Description -->
    <div class="bg-gray-100 p-4 rounded-lg mb-6">
        <p class="text-gray-700">
            Le siège de la plateforme de gestion des touristiques & événements du Bénin 
            est situé en face de l'église des Assemblées de Dieu d'Alègléta, 
            en quittant le Carrefour TOGOUDO (GODOMEY), juste après l'école primaire EPP TOGOUDO.
        </p>
        <h4 class="text-red-500 mt-4">NB : Toutes les cases comportant les étoiles <strong>*</strong> sont obligatoires.</h4>
    </div>

    <!-- Formulaire de modification -->
    <form action="{{ route('tickets.modification', $data->id) }}" method="post" class="space-y-6">
        @csrf
        @method('put')

        <!-- Type -->
        <div class="form-group">
            <label for="type" class="block text-sm font-medium text-gray-700">Type <span class="text-red-500">*</span></label>
            <input type="text" name="type" id="type" class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('type', $data->type) }}" required>
            @error('type')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Nombres -->
        <div class="form-group">
            <label for="nombres" class="block text-sm font-medium text-gray-700">Nombre <span class="text-red-500">*</span></label>
            <input type="number" name="nombres" id="nombres" class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('nombres', $data->nombres) }}" required>
            @error('nombres')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Prix -->
        <div class="form-group">
            <label for="prix" class="block text-sm font-medium text-gray-700">Prix <span class="text-red-500">*</span></label>
            <input type="number" name="prix" id="prix" class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('prix', $data->prix) }}" required>
            @error('prix')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Bouton d'envoi -->
        <div class="form-group text-center">
            <button type="submit" class="w-full py-3 px-4 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Modifier le Ticket
            </button>
        </div>
    </form>
</div>
@endsection
