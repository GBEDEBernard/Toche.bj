@extends('bloglayout')

@section('contenu')
<div class="w-full">
    {{-- Banner avec overlay --}}
    <div class="relative h-72 md:h-96">
        <img src="{{ asset($site->photo) }}" alt="{{ $site->nom }}" class="object-cover w-full h-full">
        
        {{-- Overlay sombre pour lisibilité --}}
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>

        <div class="absolute bottom-6 left-6 text-white z-10">
            <h2 class="text-3xl md:text-5xl font-bold">{{ $site->nom }}</h2>
            <h3 class="text-xl">{{ $site->commune }}</h3>
            <p class="text-sm">Tel : {{ $site->contact ?? 'Non renseigné' }}</p>
        </div>
    </div>

    {{-- Description --}}
    <section class="px-4 md:px-20 py-10 bg-gray-50">
        <h1 class="text-2xl md:text-4xl font-bold mb-6">À propos de {{ $site->nom }}</h1>
        <div class="text-gray-800 space-y-4 text-justify">
            <p>{{ $site->description }}</p>
        </div>
    </section>

    {{-- Galerie (si photos liées) --}}
   {{-- Galerie --}}
@if($site->galeries && count($site->galeries) > 0)
<section class="px-4 md:px-20 py-10">
    <h2 class="text-2xl font-bold mb-4">Galeries</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach ($site->galeries as $galerie)
            <div>
                <img src="{{ asset('storage/' . $galerie->photo) }}" alt="{{ $galerie->nom }}" class="w-full h-64 object-cover rounded-lg shadow-md hover:opacity-80">
                <p class="text-center mt-2 font-semibold text-gray-700">{{ $galerie->nom }}</p>
            </div>
        @endforeach
    </div>
</section>
@endif


    {{-- Réservation --}}
    <section class="text-center py-10 bg-blue-100">
        {{-- <a href="{{ route('Connexions') }}" class="px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Réserver maintenant</a> --}}
    </section>
</div>
@endsection
