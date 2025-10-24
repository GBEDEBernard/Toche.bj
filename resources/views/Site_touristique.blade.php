@extends('bloglayout')

@section('contenu')

{{-- Titre principal --}}
<div class="text-center my-8 px-4">
    <h1 class="text-3xl md:text-5xl font-extrabold text-gray-800 hover:opacity-80 transition duration-300">🌍 Sites touristiques</h1>
</div>

{{-- Barre de recherche --}}
<div class="flex justify-center mb-10 px-4">
    <div class="bg-gray-100 shadow-md p-4 rounded-lg w-full md:w-2/3 lg:w-1/2">
        <form method="GET" action="{{ route('site_touristique') }}" class="flex flex-row gap-2 md:gap-4">
            <input type="text" name="query" value="{{ request('query') }}" placeholder="🔍 Rechercher un site..."
                class="border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 w-full text-gray-700" />
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 transition-all duration-300 text-white px-4 py-2 rounded-md shadow-md hover:scale-105 flex-shrink-0">
                Rechercher
            </button>
        </form>
    </div>
</div>

{{-- Paragraphe d'introduction --}}
<div class="text-center max-w-3xl mx-auto mb-10 px-4">
    <p class="text-lg text-gray-600 font-serif leading-relaxed">
        Découvrez les trésors du Bénin à travers ses sites touristiques uniques, mêlant histoire, culture et beauté naturelle. Que vous soyez passionné par les traditions, les plages tropicales ou les monuments historiques, il y a un site pour chaque voyageur.
    </p>
</div>

{{-- Grille des sites touristiques --}}
<section class="px-2 md:px-10 grid grid-cols-4 sm:grid-cols-4 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:mb-3 sm:mt-0 md:mt-4 md:mb6 mb-3">
    @forelse ($sites as $site)
        <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300 transform hover:-translate-y-1 flex flex-col
                    h-[180px] sm:h-[180px] md:h-96">

            {{-- Image (50% hauteur) --}}
            <a href="{{ route('sites.show', $site->id) }}" class="block h-1/2">
                @if($site->photo)
                    <img data-src="{{ asset($site->photo) }}" alt="{{ $site->nom }}"
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
                    <h2 class="text-md sm:text-lg font-bold text-gray-800 truncate">{{ $site->nom }}</h2>
                    <p class="text-sm text-blue-600 mb-1 font-medium mt-1">{{ $site->commune }}</p>

                    {{-- Étoiles --}}
                    <div class="flex items-center mt-0 sm:w-3/5 sm:pr-1 pr-1 md:p-0 md:w-full md:mt-1">
                        @php
                            $moyenne = $site->moyenne_note ?? 0;
                            $etoilesPleine = floor($moyenne);
                            $demiEtoile = ($moyenne - $etoilesPleine) >= 0.5;
                            $etoilesVide = 5 - $etoilesPleine - ($demiEtoile ? 1 : 0);
                        @endphp
                    
                        @for ($i = 0; $i < $etoilesPleine; $i++)
                            <span class="text-yellow-600">★</span>
                        @endfor
                        @if($demiEtoile)
                            <span class="text-yellow-400">☆</span>
                        @endif
                        @for ($i = 0; $i < $etoilesVide; $i++)
                            <span class="text-gray-300">★</span>
                        @endfor
                        <span class="text-gray-600  text-sm">({{ $moyenne }})</span>
                    </div>
                </div>

                {{-- Bouton détails seulement md+ --}}
                <a href="{{ route('sites.show', $site->id) }}"
                   class="mt-2 md:mt-4 text-sm bg-blue-600 text-white px-3 py-2 rounded-full hover:bg-blue-700 transition self-start hidden md:inline-block">
                    Voir détails
                </a>
            </div>
        </div>
    @empty
        <div class="col-span-4 text-center text-gray-500 text-lg">
            Aucun site trouvé. Essaie un autre mot-clé ?
        </div>
    @endforelse
</section>


<!-- Pagination -->
<div class="mt-8 mb-4 flex justify-center">
    {{ $sites->links('pagination::tailwind') }}
</div>

{{-- Lazy load script --}}
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
