@extends('bloglayout')

@section('contenu')
<div class="container mx-auto mt-8 px-4 md:px-8">
    <div class="bg-white shadow-md rounded-xl p-6 max-w-2xl mx-auto">
        <!-- Header -->
        <h3 class="text-2xl md:text-3xl font-serif font-bold text-gray-900 text-center uppercase tracking-tight mb-2">
            Formulaire de Contact
        </h3>
        <p class="text-center text-gray-600 font-serif text-base mb-6">
            Remplissez le formulaire ci-dessous pour nous contacter.
        </p>

        <!-- Form -->
        <form action="{{ route('contact.traitement') }}" method="POST">
            @csrf

            <!-- Success Message -->
            @if (session('contenu'))
                <div class="mb-4 p-4 bg-blue-100 text-blue-800 rounded-lg font-serif text-sm">
                    {{ session('contenu') }}
                </div>
            @endif

            <!-- Name Field -->
            <div class="mb-4">
                <label for="nom" class="block text-base font-serif font-medium text-gray-700">Nom</label>
                <input type="text" name="nom" id="nom"
                       class="mt-1 block w-full px-4 py-2 border border-gray-200 rounded-md font-serif text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all duration-300"
                       placeholder="Votre nom" value="{{ old('nom') }}">
                @error('nom')
                    <div class="text-red-500 font-serif text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- First Name Field -->
            <div class="mb-4">
                <label for="prenom" class="block text-base font-serif font-medium text-gray-700">Prénom</label>
                <input type="text" name="prenom" id="prenom"
                       class="mt-1 block w-full px-4 py-2 border border-gray-200 rounded-md font-serif text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all duration-300"
                       placeholder="Votre prénom" value="{{ old('prenom') }}">
                @error('prenom')
                    <div class="text-red-500 font-serif text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email Field -->
            <div class="mb-4">
                <label for="email" class="block text-base font-serif font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email"
                       class="mt-1 block w-full px-4 py-2 border border-gray-200 rounded-md font-serif text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all duration-300"
                       placeholder="Votre email" value="{{ old('email') }}">
                @error('email')
                    <div class="text-red-500 font-serif text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Subject Field -->
            <div class="mb-4">
                <label for="objet" class="block text-base font-serif font-medium text-gray-700">Sujet</label>
                <input type="text" name="objet" id="objet"
                       class="mt-1 block w-full px-4 py-2 border border-gray-200 rounded-md font-serif text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all duration-300"
                       placeholder="Sujet de votre message" value="{{ old('objet') }}">
                @error('objet')
                    <div class="text-red-500 font-serif text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Message Field -->
            <div class="mb-6">
                <label for="contenu" class="block text-base font-serif font-medium text-gray-700">Message</label>
                <textarea name="contenu" id="contenu"
                          class="mt-1 block w-full px-4 py-2 border border-gray-200 rounded-md font-serif text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all duration-300"
                          rows="5" placeholder="Votre message">{{ old('contenu') }}</textarea>
                @error('contenu')
                    <div class="text-red-500 font-serif text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit"
                        class="px-8 py-2 bg-blue-600 text-white font-serif text-sm uppercase tracking-wide rounded-full hover:bg-blue-700 transition-all duration-300 flex items-center justify-center gap-2">
                    <i class="bi bi-send"></i> Envoyer
                </button>
            </div>
            {{-- message de succes --}}
        @if(session('success'))
            <div class="mt-4 p-4 bg-green-100 text-green-800 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        </form>
    </div>
</div>
@endsection