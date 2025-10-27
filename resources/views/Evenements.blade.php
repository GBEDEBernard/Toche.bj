@extends('bloglayout')

@section('contenu')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">

    <!-- Message Flash -->
    @if (session('success'))
        <div id="flash-message" class="fixed top-6 right-6 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg opacity-90 cursor-pointer transition-opacity duration-500 z-50" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- En-tête -->
    <header class="text-center my-4 md:my-6">
        <h1 class="text-2xl sm:text-3xl md:text-4xl font-serif font-extrabold text-indigo-800 uppercase tracking-tight hover:text-indigo-600 transition duration-300">
            Nos Événements Culturels
        </h1>
        <div class="w-20 h-1 bg-indigo-600 mx-auto mt-2 rounded"></div>
        <p class="mt-3 text-sm md:text-lg text-justify text-gray-600 font-serif md:max-w-3xl mx-auto leading-relaxed">
            Plongez au cœur de la richesse culturelle du Bénin à travers nos événements uniques — des festivals vodou vibrants aux célébrations historiques. Réservez votre place pour une expérience immersive au rythme des traditions béninoises.
        </p>
    </header>

    <!-- Barre de recherche -->
    <div class="flex justify-center mb-6">
        <div class="bg-white shadow-md rounded-lg p-1 w-full max-w-xl border border-gray-100">
            <form action="{{ route('evenements') }}" method="GET" class="flex flex-row gap-2">
                <input type="text" name="query" value="{{ request('query') }}"
                       placeholder="🔍 Rechercher un événement..."
                       class="flex-1 border border-gray-300 px-2 py-[6px] rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-700 font-serif text-sm placeholder-gray-400" />
                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-[6px] rounded-lg font-serif text-sm uppercase tracking-wide transition-colors duration-300 flex items-center justify-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Rechercher
                </button>
            </form>
        </div>
    </div>

    <!-- Grille des événements -->
    <section class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8 px-3 sm:px-6 md:px-10 mb-10">
        @forelse ($evenements as $event)
            <div class="bg-white border border-gray-200 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                <a href="{{ route('admin.evenements.show', $event->id) }}" class="block">
                    @if($event->photo)
                        <img data-src="{{ asset($event->photo) }}" alt="{{ $event->nom }}"
                             class="w-full h-40 sm:h-48 md:h-56 object-cover lazy-img rounded-t-2xl">
                    @else
                        <div class="w-full h-40 sm:h-48 md:h-56 bg-gray-200 flex items-center justify-center text-gray-500 italic">
                            Aucune image
                        </div>
                    @endif
                </a>

                <div class="p-3 sm:p-4 text-center">
                    <h2 class="text-sm sm:text-base md:text-lg font-serif font-semibold text-gray-800 truncate">
                        {{ $event->nom }}
                    </h2>
                    <p class="text-[11px] sm:text-sm font-semibold text-indigo-500 mt-1">
                        {{ $event->lieu ?? 'Lieu non précisé' }}
                    </p>

                    <a href="{{ route('admin.evenements.show', $event->id) }}" 
                       class="mt-3 inline-block bg-indigo-600 hover:bg-indigo-700 text-white text-xs sm:text-sm px-3 py-1.5 rounded-full transition duration-300">
                        Voir détails
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-2 sm:col-span-3 lg:col-span-4 text-center text-gray-500 text-sm sm:text-lg py-8">
                Aucun événement trouvé. Essaie un autre mot-clé ?
            </div>
        @endforelse
    </section>

    <!-- Pagination -->
    <div class="mt-6 mb-6 flex justify-center">
        {{ $evenements->links('pagination::tailwind') }}
    </div>

    <!-- Section vers les itinéraires -->
    <section class="text-center max-w-3xl mx-auto md:mb-12 md:p-6 p-3 bg-gray-100 rounded-2xl shadow-md">
        <h2 class="text-lg sm:text-xl md:text-2xl font-serif font-bold text-indigo-800 mb-4">
            Explorez davantage le Bénin
        </h2>
        <p class="text-sm sm:text-base md:text-lg text-gray-600 text-justify font-serif leading-relaxed mb-4">
            Nos événements vous ont captivé ? Poursuivez l’aventure avec nos itinéraires touristiques soigneusement conçus. Que vous voyagiez en solo, en famille ou entre amis, découvrez des parcours riches en histoire, culture et nature — pour une immersion totale au cœur du Bénin. 🌍✨
        </p>
        <a href="{{ route('itineraire.offres') }}"
           class="inline-flex items-center bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 sm:px-5 sm:py-2.5 rounded-lg font-serif text-sm md:text-base uppercase tracking-wide transition duration-300 shadow-md hover:scale-105">
            <svg class="w-4 h-4 md:w-5 md:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            Découvrir les itinéraires
        </a>
    </section>
</div>

<!-- Lazy Loading -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const flash = document.getElementById('flash-message');
    if (flash) {
        setTimeout(() => {
            flash.style.opacity = '0';
            setTimeout(() => flash.remove(), 500);
        }, 3000);
        flash.addEventListener('click', () => flash.remove());
    }

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
        }, { rootMargin: "0px 0px 200px 0px", threshold: 0.1 });
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
