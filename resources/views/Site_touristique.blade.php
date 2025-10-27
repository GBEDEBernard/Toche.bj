@extends('bloglayout')

@section('contenu')

<!-- Titre principal -->
<div class="text-center my-4 md:my-6 px-4">
    <h1 class="text-2xl sm:text-3xl md:text-4xl font-serif font-extrabold text-gray-800 uppercase tracking-tight hover:text-blue-600 transition duration-300">
        🌍 Sites touristiques
    </h1>
    <div class="w-20 h-1 bg-blue-600 mx-auto mt-2 rounded"></div>
</div>

<!-- Barre de recherche -->
<div class="flex justify-center mb-4 md:mb-8 px-2">
    <div class="bg-white shadow-md rounded-lg p-1 w-full max-w-xl border border-gray-100">
        <form method="GET" action="{{ route('site_touristique') }}" class="flex flex-row gap-2">
            <input 
                type="text" 
                name="query" 
                value="{{ request('query') }}" 
                placeholder="🔍 Rechercher un site..."
                class="flex-1 sm:w-full w-full border border-gray-300 px-2 py-[3px] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 font-serif text-sm placeholder-gray-400" 
            />
            <button 
                type="submit"
                class="bg-blue-600  hover:bg-blue-700 text-white px-2 py-[2px] rounded-lg font-serif text-sm uppercase tracking-wide transition-colors duration-300 flex items-center justify-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Rechercher
            </button>
        </form>
    </div>
</div>

<!-- Paragraphe d'introduction -->
<div class="text-center max-w-3xl mx-auto mb-8 px-4">
    <p class="text-sm sm:text-base md:text-lg text-gray-600 font-serif leading-relaxed text-justify">
        Découvrez les trésors du Bénin à travers ses sites touristiques uniques, mêlant histoire, culture et beauté naturelle. Que vous soyez passionné par les traditions, les plages tropicales ou les monuments historiques, il y a un site pour chaque voyageur.
    </p>
</div>

<!-- Grille des sites -->
<section class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8 px-3 sm:px-6 md:px-10 mb-10">
    @forelse ($sites as $site)
        <div class="bg-white border border-gray-200 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 overflow-hidden">
            <a href="{{ route('sites.show', $site->id) }}" class="block">
                @if($site->photo)
                    <img 
                        data-src="{{ asset($site->photo) }}" 
                        alt="{{ $site->nom }}" 
                        class="w-full h-40 sm:h-48 md:h-56 object-cover lazy-img rounded-t-2xl">
                @else
                    <div class="w-full h-40 sm:h-48 md:h-56 bg-gray-200 flex items-center justify-center text-gray-500 italic">
                        Aucune image
                    </div>
                @endif
            </a>

            <div class="p-3 sm:p-4 text-center">
                <h2 class="text-sm sm:text-base md:text-lg font-serif font-semibold text-gray-800 truncate">
                    {{ $site->nom }}
                </h2>
                <p class="text-[11px] sm:text-sm font-semibold text-red-500 mt-1">
                    {{ $site->commune }}
                </p>

                <!-- Étoiles -->
                <div class="flex items-center justify-center mt-1">
                    @php
                        $moyenne = $site->moyenne_note ?? 0;
                        $etoilesPleine = floor($moyenne);
                        $demiEtoile = ($moyenne - $etoilesPleine) >= 0.5;
                        $etoilesVide = 5 - $etoilesPleine - ($demiEtoile ? 1 : 0);
                    @endphp

                    @for ($i = 0; $i < $etoilesPleine; $i++)
                        <span class="text-yellow-500">★</span>
                    @endfor
                    @if($demiEtoile)
                        <span class="text-yellow-300">★</span>
                    @endif
                    @for ($i = 0; $i < $etoilesVide; $i++)
                        <span class="text-gray-300">★</span>
                    @endfor
                    <span class="text-gray-600 text-xs ml-1">({{ number_format($moyenne, 1) }})</span>
                </div>

                <!-- Bouton -->
                <a href="{{ route('sites.show', $site->id) }}" 
                   class="mt-3 inline-block bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm px-3 py-1.5 rounded-full transition duration-300">
                    Voir détails
                </a>
            </div>
        </div>
    @empty
        <div class="col-span-2 text-center text-gray-500 text-sm sm:text-lg py-8">
            Aucun site trouvé. Essaie un autre mot-clé ?
        </div>
    @endforelse
</section>

<!-- Pagination -->
<div class="mt-6 mb-6 flex justify-center">
    {{ $sites->links('pagination::tailwind') }}
</div>

<!-- Lazy loading -->
<script>
document.addEventListener("DOMContentLoaded", () => {
  const lazyImages = document.querySelectorAll("img.lazy-img");

  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries, observer) => {
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

@endsection
