@extends('bloglayout')

@section('contenu')
<div class="container mx-auto mt-10 px-4">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h3 class="text-2xl font-semibold text-center mb-6">Formulaire de Contact</h3>

        <form action="{{ route('contact.traitement') }}" method="POST">
            @csrf
            <p class="text-center text-lg mb-4">Merci, vous êtes sur la page de contact. Veuillez remplir ce formulaire.</p>

            @if (session('contenu'))
                <div class="alert alert-success mb-4 p-4 bg-green-200 text-green-800 rounded">
                    {{ session('contenu') }}
                </div>
            @endif

            <div class="mb-4">
                <label for="nom" class="block text-lg font-medium text-gray-700">Nom</label>
                <input type="text" name="nom" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Entrez votre nom">
                @error('nom')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="prenom" class="block text-lg font-medium text-gray-700">Prénom</label>
                <input type="text" name="prenom" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Entrez votre prénom">
                @error('prenom')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-lg font-medium text-gray-700">Email</label>
                <input type="email" name="email" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Entrez votre email">
                @error('email')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="objet" class="block text-lg font-medium text-gray-700">Sujet</label>
                <input type="text" name="objet" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Entrez le sujet">
                @error('objet')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="contenu" class="block text-lg font-medium text-gray-700">Message</label>
                <textarea name="contenu" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" rows="4" placeholder="Entrez votre message"></textarea>
                @error('contenu')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-300">
                    <i class="fas fa-paper-plane"></i> Envoyer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
