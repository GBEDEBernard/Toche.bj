@extends('layouts.app')

@section('title', 'Modifier un Ticket')

@section('content')
<div class="content-wrapper py-6">
    <!-- Header -->
    <section class="content-header mb-6 text-center">
        <h1 class="text-3xl font-bold text-blue-700">
            🎟️ Modifier le Ticket : <span class="text-gray-800">{{ $data->type }}</span>
        </h1>
        <div class="mt-2 inline-block bg-blue-100 text-blue-800 px-4 py-2 rounded-lg font-medium">
            🎉 Événement : {{ $data->evenement->nom ?? 'Aucun événement lié' }}
        </div>
    </section>

    <!-- Formulaire -->
    <section class="content">
        <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-lg border border-gray-200 p-4">
            <div class="flex justify-between items-center mb-2 border-b pb-3">
                <h3 class="text-xl font-semibold text-gray-700">Informations du Ticket</h3>
            </div>

            <!-- Affichage des erreurs -->
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 mb-5 rounded-lg">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>⚠️ {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('tickets.modifier', $data->id) }}" method="POST" class="space-y-2">
                @csrf
                @method('PUT')

                <!-- Type de Ticket -->
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">
                        Type de Ticket <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="type" name="type" 
                        value="{{ old('type', $data->type) }}" required
                        class="w-full border-gray-300 border-2 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Nombre -->
                <div>
                    <label for="nombres" class="block text-sm font-medium text-gray-700 mb-1">
                        Nombre total <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="nombres" name="nombres" 
                        value="{{ old('nombres', $data->nombres) }}" required
                        class="w-full border-gray-300 border-2 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Prix -->
                <div>
                    <label for="prix" class="block text-sm font-medium text-gray-700 mb-1">
                        Prix (FCFA) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="prix" name="prix" step="0.01" 
                        value="{{ old('prix', $data->prix) }}" required
                        class="w-full border-gray-300 border-2 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Boutons -->
                <div class="flex justify-between items-center mt-3">
                    <a href="{{ route('indextickets') }}" 
                       class="bg-gray-500 text-white px-5 py-2 rounded-lg hover:bg-gray-600 transition">
                        Annuler
                    </a>
                    <button type="submit" 
                        class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                        💾 Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
