@extends('bloglayout')

@section('contenu')
<!-- Header Section -->
<div class="text-center my-6">
    <h1 class="text-3xl md:text-4xl lg:text-5xl font-serif font-bold text-gray-900 uppercase tracking-tight">
        Nos Événements
    </h1>
</div>

<!-- Search Bar -->
<div class="flex justify-center mb-8 px-4 md:px-8">
    <div class="bg-white shadow-md rounded-lg p-4 w-full max-w-lg border border-blue-100">
        <form action="{{ route('evenements') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
            <input type="text" name="query" value="{{ request('query') }}"
                   placeholder="Rechercher un événement..."
                   class="form-control border-gray-200 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 text-gray-700 font-serif text-sm w-full" />
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md font-serif text-sm uppercase tracking-wide transition-colors duration-300">
                Rechercher
            </button>
        </form>
    </div>
</div>

<!-- Introduction -->
<div class="text-center max-w-3xl mx-auto mb-8 px-4">
    <p class="text-lg text-gray-600 font-serif leading-relaxed">
        Plongez dans la richesse culturelle du Bénin à travers nos événements uniques, des festivals vodou aux célébrations historiques. Découvrez des expériences inoubliables et réservez votre place pour vibrer au rythme des traditions béninoises !
    </p>
</div>
<!-- Event Grid -->
<section class="px-4 md:px-8 lg:px-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-12">
    @forelse ($evenements as $event)
        <div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-all duration-300">
            <div class="relative">
                <img src="{{ asset($event->photo) }}" alt="{{ $event->nom }}"
                     class="w-full h-56 object-cover transition-opacity duration-300 hover:opacity-90">
            </div>
            <div class="p-5">
                <h2 class="text-lg font-serif font-semibold text-gray-800 mb-1 line-clamp-2">{{ $event->nom }}</h2>
                <p class="text-sm font-serif text-blue-600 mb-3">{{ $event->lieu }}</p>
                <a href="{{ route('admin.evenements.show', $event->id) }}"
                   class="inline-block bg-blue-600 text-white px-5 py-2 rounded-full font-serif text-sm uppercase tracking-wide hover:bg-blue-700 transition-colors duration-300">
                    Voir détails
                </a>
            </div>
        </div>
    @empty
        <div class="col-span-full text-center py-10 bg-white rounded-xl shadow-md">
            <i class="bi bi-calendar-x text-gray-400 text-4xl mb-3"></i>
            <p class="font-serif text-lg text-gray-600">Aucun événement trouvé. Essayez un autre mot-clé.</p>
        </div>
    @endforelse
</section>
@endsection