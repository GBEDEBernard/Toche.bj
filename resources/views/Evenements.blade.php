@extends('bloglayout')

@section('contenu')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 sm:py-1 py-2 md:py-4">
    <!-- Message Flash -->
    @if (session('success'))
        <div id="flash-message" class="fixed top-6 right-6 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg opacity-90 cursor-pointer transition-opacity duration-500 z-50" role="alert" aria-live="assertive">
            {{ session('success') }}
        </div>
    @endif

    <!-- En-tête -->
    <header class="text-center mb-2">
        <h1 class="sm:text-xl md:text-2xl font-serif font-bold text-indigo-800 uppercase tracking-tight">Nos Événements Culturels</h1>
        <p class="mt-2 text-sm md:text-xl text-justify text-gray-600 font-serif md:max-w-3xl mx-auto leading-relaxed">
            Plongez au cœur de la richesse culturelle du Bénin à travers nos événements uniques, des festivals vodou vibrants aux célébrations historiques. Réservez votre place pour une expérience immersive au rythme des traditions béninoises.
        </p>
    </header>

   <!-- Barre de recherche -->
<div class="flex justify-center mb-4 md:mb-6 px-2">
    <div class="bg-white shadow-md rounded-lg p-1 w-full max-w-xl border border-gray-100">
        <form action="{{ route('evenements') }}" method="GET" class="flex flex-row gap-2">
            <!-- Input -->
            <input type="text" name="query" value="{{ request('query') }}"
                   placeholder="Rechercher un événement..."
                   class="flex-1 border border-gray-300 px-2 py-1 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-700 font-serif text-sm placeholder-gray-400"
                   aria-label="Rechercher un événement" />
            <!-- Bouton -->
            <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-2 py-1 rounded-lg font-serif text-sm uppercase tracking-wide transition-colors duration-300 flex items-center justify-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Rechercher
            </button>
        </form>
    </div>
</div>



 {{-- Grille des événements --}}
<section class="px-2 md:px-10 grid grid-cols-4 sm:grid-cols-4 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:mb-3 sm:mt-0 md:mt-4 md:mb-6 mb-3">
    @forelse ($evenements as $event)
        <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300 transform hover:-translate-y-1 flex flex-col
                    h-[180px] sm:h-[180px] md:h-96">

            {{-- Image (50% hauteur) --}}
            <a href="{{ route('admin.evenements.show', $event->id) }}" class="block h-1/2">
                @if($event->photo)
                    <img data-src="{{ asset($event->photo) }}" alt="{{ $event->nom }}"
                         class="w-full h-full object-cover lazy-img">
                @else
                    <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500 italic">
                        Aucune image
                    </div>
                @endif
            </a>

            {{-- Contenu (50% hauteur) --}}
            <div class="flex flex-col justify-between h-1/2 p-2 md:p-4">
                <div>
                    <h2 class="text-md sm:text-lg font-bold text-gray-800 truncate">{{ $event->nom }}</h2>
                    <p class="text-sm text-indigo-600 font-medium mt-1">{{ $event->lieu ?? 'Lieu non précisé' }}</p>
                </div>

                {{-- Bouton détails seulement md+ --}}
                <a href="{{ route('admin.evenements.show', $event->id) }}"
                   class="mt-2 md:mt-4 text-sm bg-indigo-600 text-white px-3 py-2 rounded-full hover:bg-indigo-700 transition self-start hidden md:inline-block">
                    Voir détails
                </a>
            </div>
        </div>
    @empty
        <div class="col-span-4 text-center py-12 bg-white rounded-xl shadow-md">
            <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <p class="font-serif text-lg text-gray-600">Aucun événement trouvé. Essayez un autre mot-clé.</p>
        </div>
    @endforelse
</section>
    <!-- Pagination -->
    <div class="mt-8 mb-4 flex justify-center">
        {{ $evenements->links('pagination::tailwind') }}
    </div>

    <!-- Section vers les itinéraires -->
    <section class="text-center max-w-3xl mx-auto md:mb-12 md:p-4 sm:p-1 p-1 bg-gray-100 text-bold shadow sm:text-base text-base md:text-2xl">
        <h2 class="sm:text-sm text-sm md:text-2xl font-serif font-bold text-indigo-800 sm:mb-2 md:mb-6">Explorez davantage le Bénin</h2>
        <p class="sm:text-base text-base md:text-2xl text-gray-600 text-justify font-serif leading-relaxed msm:mb-2 md:mb-6">
            Nos événements vous ont captivé ? Poursuivez l’aventure avec nos itinéraires touristiques soigneusement conçus. Que vous voyagiez en solo, en famille ou entre amis, découvrez des parcours riches en histoire, culture et nature, pour une immersion totale au cœur du Bénin. 🌍✨
        </p>
        <p class="sm:text-sm text-sm md:text-2xl text-gray-600 text-justify font-serif leading-relaxed sm:mb-2 md:mb-6">
            Pour le faire, des sociétés ont créé ces itinéraires pour vous. Si vous désirez voyager sur certains lieux touristiques, veuillez cliquer sur ce lien pour voir les itinéraires que vous pouvez suivre.
        </p>
        <a href="{{ route('itineraire.offres') }}"
           class="inline-flex items-center bg-emerald-600 text-white p-2 sm:p-1 md:px-6 md:py-3 rounded-lg font-serif text-sm  md:uppercase tracking-wide hover:bg-emerald-700 focus:ring-4 focus:ring-emerald-200 transition duration-300 shadow-md hover:scale-105">
            <svg class="w-2 h-2 md:w-5 md:h-5 sm:w-2 sm:h-2 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg> 
            Découvrir les itinéraires
        </a>
    </section>
</div>

<!-- Script pour le message flash -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const flash = document.getElementById('flash-message');
        if (flash) {
            setTimeout(() => {
                flash.style.opacity = '0';
                setTimeout(() => flash.remove(), 500);
            }, 3000);

            flash.addEventListener('click', () => {
                flash.remove();
            });
        }

        // Lazy load avec effet blur + fade-in
        const lazyImages = document.querySelectorAll("img.lazy-img");

        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.addEventListener('load', () => img.classList.add('loaded'));
                        observer.unobserve(img);
                    }
                });
            });

            lazyImages.forEach(img => observer.observe(img));
        } else {
            lazyImages.forEach(img => {
                img.src = img.dataset.src;
                img.classList.add('loaded');
            });
        }
    });
</script>

<style>
.lazy-img {
    filter: blur(8px);
    opacity: 0.6;
    transition: filter 0.4s ease, opacity 0.4s ease;
}

.lazy-img.loaded {
    filter: blur(0);
    opacity: 1;
}
</style>
@endsection
