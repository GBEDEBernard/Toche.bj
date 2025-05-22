@extends('bloglayout')

@section('contenu')
<div class="w-full">

    {{-- Banner / Header --}}
    <div class="relative h-96 md:h-[500px]">
        <img src="{{ asset($evenement->photo) }}" alt="{{ $evenement->nom }}" class="w-full h-full object-cover hover:opacity-80 transition-all duration-300 ">
        
        {{-- Overlay sombre pour améliorer la lisibilité --}}
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        
        {{-- Texte superposé fixé en haut --}}
        <div class="absolute bottom-8 left-8 text-white z-10 fixed-header">
            <h2 class="text-3xl md:text-5xl font-bold tracking-wide">{{ $evenement->nom }}</h2>
            <h3 class="text-xl md:text-2xl font-semibold mt-2">{{ $evenement->lieu }}</h3>
            <p class="text-sm mt-2">Date : {{ $evenement->date }}</p>
        </div>
    </div>

    {{-- Description & Détails --}}
    <section class="px-4 md:px-20 py-10 bg-gray-50 mt-36"> <!-- Ajouté 'mt-36' pour laisser de la place au header fixe -->
        <h1 class="text-2xl md:text-4xl font-bold mb-6">À propos de l'événement</h1>
        <div class="text-gray-800 space-y-4 text-justify">
            <p>{{ $evenement->description }}</p>
            <p><strong>Sponsor :</strong> {{ $evenement->sponsor }}</p>
            <p><strong>Site Touristique associé :</strong> {{ $evenement->site_touristique->nom ?? 'Non défini' }}</p>
        </div>
    </section>

    {{-- Galerie --}}
    @if($evenement->galeries && $evenement->galeries->count() > 0)
    <section class="px-4 md:px-20 py-10">
        <h2 class="text-2xl font-bold mb-4">Galeries</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($evenement->galeries as $galerie)
                <div>
                    <img src="{{ asset('storage/' . $galerie->photo) }}" alt="{{ $galerie->nom }}" class="w-full h-64 object-cover rounded-lg shadow-md  hover:opacity-80">
                    <p class="text-center mt-2 font-semibold text-gray-700">{{ $galerie->nom }}</p>
                </div>
            @endforeach
        </div>
    </section>
    @else
        <p class="text-center text-gray-500">Aucune photo disponible pour cet événement.</p>
    @endif

    {{-- CTA (facultatif ou à activer plus tard) --}}
    <section class="text-center py-10 bg-blue-100">
        {{-- <a href="{{ route('Connexions') }}" class="px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Réserver maintenant</a> --}}
    </section>

</div>
@endsection

@push('styles')
    <style>
        /* Style pour rendre l'en-tête fixé au top */
        .fixed-header {
            position: sticky;
            top: 0;
            z-index: 100;
            background-color: rgba(0, 0, 0, 0.5); /* Pour améliorer la lisibilité */
            padding: 20px;
            width: 100%;
        }
    </style>
@endpush
