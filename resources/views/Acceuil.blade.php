@extends('bloglayout')

@section('contenu')
   <!-- Bannière principale avec formulaire de recherche -->
<div class="relative h-[40vh] md:h-[70vh] bg-cover bg-contain bg-bottom bg-no-repeat  flex items-center justify-center 
            sm:h-[30vh] xs:h-[40vh]" 
     style="background-image: url('{{ asset('/image/amazone2.jpg') }}');">
    <!-- Overlay sombre pour lisibilité -->
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
</div>

    <!-- Slogan -->
    <div class="text-center  my-4 mb-2 lg:my-12">
        <h1 class="text-xm m-1 md:text-xl lg:text-4xl font-serif font-bold text-gray-800  transition-colors duration-300 tracking-tight uppercase">
             Programmez vos vacances en 1 clic
        </h1>
        <div class="w-24 h-1 bg-blue-600 mx-auto mt-2 md:mt-4 rounded"></div>
          <div class="flex justify-center">
               <h3 class="text-sm justify-center  w-2/3 ml-10  p-2 lg:text-lg md:text-2xl font-serif font-semibold text-red-700 mt-2 lg:mt-6 hover:text-red-500 transition-colors duration-300">
                   Faites vos réservations depuis votre canapé et évitez les foules dans les billetteries.
              </h3>
         </div>
    </div>

    <!-- Section des cartes de navigation -->
    <div class="flex justify-center gap-4 flex-row md:flex-row md:gap-4 mb-2 md:mb-12 mx-auto max-w-6xl px-2">
                    <!-- Carte Site Touristique -->
            <div class="flex flex-col md:flex-row w-[120px] md:w-1/3 h-36 border-2 rounded-lg md:shadow-lg overflow-hidden hover:scale-105 transition-transform duration-300 bg-white">
                <a href="{{ route('site_touristique') }}" class="flex flex-col md:flex-row w-full h-full" aria-label="Voir les sites touristiques">
                    
                    <!-- Image -->
                    <img 
                        src="{{ asset('/image/site6-enhanced.png') }}" 
                        alt="Site touristique Amazone"
                        class="w-full md:w-1/2 h-1/2 md:h-full object-cover rounded-t-lg md:rounded-t-none md:rounded-l-lg"
                    >

                    <!-- Titre -->
                    <h3 class="flex items-center justify-center text-center 
                            w-full md:w-1/2 h-1/2 md:h-full 
                            font-serif font-semibold text-sm md:text-base text-gray-800 p-3">
                        Sites touristiques
                    </h3>
                </a>
            </div>
                <!-- Carte Événements -->
            <div class="flex flex-col md:flex-row w-[120px] md:w-1/3 h-36 border-2 rounded-lg md:shadow-lg bg-black text-white overflow-hidden hover:scale-105 transition-transform duration-300">
                <a href="{{ route('evenements') }}" class="flex flex-col md:flex-row w-full h-full" aria-label="Voir les événements">

                    <!-- Image -->
                    <img 
                        src="{{ asset('/image/eveement1.jpg') }}" 
                        alt="Événement Vodou Days"
                        class="w-full md:w-1/2 h-1/2 md:h-full object-cover rounded-t-lg md:rounded-t-none md:rounded-l-lg"
                    >

                    <!-- Titre -->
                    <h3 class="flex items-center justify-center text-center 
                            w-full md:w-1/2 h-1/2 md:h-full 
                            font-serif font-semibold text-sm md:text-base p-3">
                        Événements
                    </h3>
                </a>
            </div>
          <!-- Carte Hôtels & Restaurants -->
            <div class="flex flex-col md:flex-row w-[120px] md:w-1/3 h-36 border-2 rounded-lg md:shadow-lg overflow-hidden hover:scale-105 transition-transform duration-300 bg-white">
                <a href="#" class="flex flex-col md:flex-row w-full h-full" aria-label="Voir les hôtels et restaurants">

                    <!-- Image -->
                    <img 
                        src="{{ asset('/image/novotel2.jpg') }}" 
                        alt="Hôtel Novotel"
                        class="w-full md:w-1/2 h-1/2 md:h-full object-cover rounded-t-lg md:rounded-t-none md:rounded-l-lg"
                    >

                    <!-- Titre -->
                    <h3 class="flex items-center justify-center text-center 
                            w-full md:w-1/2 h-1/2 md:h-full 
                            font-serif font-semibold text-sm md:text-base 
                            text-gray-800 p-3">
                        Hôtels & Restaurants
                    </h3>
                </a>
            </div>
    </div>

    <!-- Section des sites touristiques -->
    <div class="text-center my-2 md:my-12">
        <h1 class="text-sm md:text-2xl lg:text-4xl font-serif font-bold text-gray-800 hover:text-blue-600 transition-colors duration-300 tracking-tight uppercase">
            Nos sites touristiques
        </h1>
        <div class="w-24 h-1 bg-blue-600 mx-auto mt-2 md:mt-4 rounded"></div>
    </div>
   <div class="container mx-auto py-6 sm:px-6 lg:px-8 mb-8">
    <!-- Wrapper scrollable sur mobile -->
    <div class="mx-3 flex overflow-x-auto md:grid md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8 justify-items-center scrollbar-hide snap-x snap-mandatory scroll-smooth">
        @forelse ($topSites as $index => $site)
            <article 
                class="flex-none snap-center bg-white border border-gray-200 rounded-2xl md:shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1
                       w-[170px] sm:w-[190px] md:w-full max-w-[25rem] sm:max-w-[25rem] lg:max-w-[22rem]">
                
                <a href="{{ route('sites.show', $site->id) }}" class="block h-[230px] sm:h-[260px] md:h-[400px]">
                    <img class="w-full h-[120px] sm:h-[140px] md:h-[160px] object-cover rounded-t-2xl"
                         src="{{ asset($site->photo) }}" 
                         alt="{{ $site->nom }}"
                         loading="lazy">

                    <div class="p-2 sm:p-4 text-center flex flex-col justify-center h-[110px] sm:h-[120px] md:h-[140px]">
                        <h3 class="text-[11px] sm:text-base md:text-lg lg:text-xl font-serif font-bold text-blue-600 truncate">
                            {{ $site->nom }}
                        </h3>
                        <h4 class="text-[9px] sm:text-sm md:text-base font-serif font-semibold text-blue-600 mt-1">
                            {{ $site->commune }}
                        </h4>
                        
                        <div class="flex justify-center items-center space-x-[2px] sm:space-x-1 mt-2">
                            @php
                                $moyenne = round($site->moyenne_note ?? 0, 1);
                                $etoilesPleine = floor($moyenne);
                                $demiEtoile = ($moyenne - $etoilesPleine) >= 0.5;
                                $etoilesVide = 5 - $etoilesPleine - ($demiEtoile ? 1 : 0);
                            @endphp
                            @for ($i = 0; $i < $etoilesPleine; $i++)
                                <span class="text-yellow-400 text-[12px] sm:text-base">★</span>
                            @endfor
                            @if($demiEtoile)
                                <span class="text-yellow-400 text-[12px] sm:text-base">☆</span>
                            @endif
                            @for ($i = 0; $i < $etoilesVide; $i++)
                                <span class="text-gray-300 text-[12px] sm:text-base">★</span>
                            @endfor
                        </div>
                    </div>
                </a>
            </article>
        @empty
            <div class="text-center text-gray-500 text-sm sm:text-lg py-8 w-full">
                Aucun site touristique trouvé pour le moment.
            </div>
        @endforelse
    </div>
</div>


    <div class="text-center mb-4 mt-4 md:mb-10">
        <a href="{{ route('site_touristique') }}" class="text-blue-500 font-serif font-semibold hover:underline transition-colors duration-300">
            Voir plus
        </a>
    </div>

   <!-- Bannière promotionnelle -->
<div class="bg-black p-2 md:p-6 mt-2 sm:w-full md:w-full md:mt-6 rounded-lg md:shadow-lg text-center md:flex md:items-center md:justify-between">
    <div class="max-w-4xl mx-auto text-white">
        <p class="text-sm sm:text-base md:text-lg font-serif text-justify leading-relaxed md:mr-6 px-2 sm:px-4">
            Chers amis de <strong class="text-yellow-500 font-serif">Toché, le miroir du pays (Bénin)</strong>, 
            nous serons ravis de vous compter parmi nous lors de nos différents événements touristiques au Bénin, 
            qu'ils soient annuels ou exclusifs. Ces événements seront mis à l'honneur à travers divers programmes et démonstrations.
        </p>
    </div>
    <img src="{{ asset('/image/evenement3.jpg') }}" 
         alt="Événement touristique au Bénin" 
         class="w-full mt-2 md:mt-0 md:w-1/2 h-28 sm:h-36 md:h-72 rounded-lg md:shadow-md hover:scale-105 transition-transform duration-300 object-cover" >
</div>

   <!-- Section des événements -->
<div class="text-center my-2 md:my-12">
    <h1 class="text-sm md:text-4xl lg:text-5xl font-serif font-bold text-gray-800 hover:text-blue-600 transition-colors duration-300 tracking-tight uppercase">
        Nos Événements
    </h1>
    <div class="w-24 h-1 bg-blue-600 mx-auto mt-2 md:mt-4 rounded"></div>
</div>

<div class="container mx-auto py-4 md:py-6 sm:px-6 lg:px-8 mb-8">
    <!-- Wrapper scrollable sur mobile -->
    <div class="mx-3 flex overflow-x-auto md:grid md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8 justify-items-center scrollbar-hide snap-x snap-mandatory scroll-smooth">
        @forelse ($topEvenements as $index => $evenement)
            <article 
                class="flex-none snap-center bg-white border border-gray-200 rounded-2xl md:shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1
                       w-[170px] sm:w-[190px] md:w-full max-w-[25rem] sm:max-w-[25rem] lg:max-w-[22rem]">

                <a href="{{ route('admin.evenements.show', $evenement->id) }}" 
                   class="block h-[230px] sm:h-[260px] md:h-[400px]" 
                   aria-label="Voir l'événement {{ $evenement->nom }}">
                    
                    <img class="w-full h-[120px] sm:h-[140px] md:h-[160px] object-cover rounded-t-2xl" 
                         src="{{ asset($evenement->photo) }}" 
                         alt="{{ $evenement->nom }}"
                         loading="lazy">

                    <div class="p-2 sm:p-4 text-center flex flex-col justify-center h-[110px] sm:h-[120px] md:h-[140px]">
                        <h3 class="text-[11px] sm:text-base md:text-lg lg:text-xl font-serif font-bold text-blue-600 truncate">
                            {{ $evenement->nom }}
                        </h3>
                        <h4 class="text-[9px] sm:text-sm md:text-base font-serif font-semibold text-blue-600 mt-1">
                            {{ $evenement->lieu ?? 'Lieu non précisé' }}
                        </h4>

                        @if ($evenement->date)
                            <p class="text-[9px] sm:text-sm font-serif text-gray-500 mt-1">
                                {{ \Carbon\Carbon::parse($evenement->date)->translatedFormat('d M Y') }}
                            </p>
                        @endif

                        <div class="flex justify-center items-center space-x-[2px] sm:space-x-1 mt-2">
                            @php
                                $moyenne = round($evenement->moyenne_note ?? 0, 1);
                                $etoilesPleine = floor($moyenne);
                                $demiEtoile = ($moyenne - $etoilesPleine) >= 0.5;
                                $etoilesVide = 5 - $etoilesPleine - ($demiEtoile ? 1 : 0);
                            @endphp
                            @for ($i = 0; $i < $etoilesPleine; $i++)
                                <span class="text-yellow-400 text-[12px] sm:text-base">★</span>
                            @endfor
                            @if($demiEtoile)
                                <span class="text-yellow-400 text-[12px] sm:text-base">☆</span>
                            @endif
                            @for ($i = 0; $i < $etoilesVide; $i++)
                                <span class="text-gray-300 text-[12px] sm:text-base">★</span>
                            @endfor
                            <span class="text-gray-600 ml-1 sm:ml-2 text-[9px] sm:text-sm">({{ $moyenne }})</span>
                        </div>
                    </div>
                </a>
            </article>
        @empty
            <div class="text-center text-gray-500 text-sm sm:text-lg py-8 w-full">
                Aucun événement à venir pour le moment.
            </div>
        @endforelse
    </div>
</div>

<div class="text-center mb-2 md:mb-10">
    <a href="{{ route('evenements') }}" class="text-blue-500 font-serif font-semibold hover:underline transition-colors duration-300">
        Voir plus
    </a>
</div>

<div class="bg-gray-100 py-4 md:py-8 sm:px-6">
    <!-- Titre -->
    <div class="text-center my-4 px-6">
        <h1 class="text-xl sm:text-2xl md:text-4xl lg:text-5xl font-serif font-bold text-gray-800 hover:text-blue-600 transition-colors duration-300 tracking-tight uppercase">
            Hôtels & Restaurants
        </h1>
        <div class="w-16 sm:w-24 h-1 bg-blue-600 mx-auto mt-2 rounded"></div>
    </div>

    <!-- Section cartes scrollable sur mobile -->
    <div class="mx-3 flex overflow-x-auto md:grid md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8 justify-items-center scrollbar-hide snap-x snap-mandatory scroll-smooth px-2 sm:px-4">
        @forelse ($hotels as $index => $hotel)
            <article 
                class="flex-none snap-center bg-white border border-gray-200 rounded-2xl md:shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1
                       w-[175px] sm:w-[190px] md:w-full max-w-[25rem] sm:max-w-[25rem] lg:max-w-[22rem]">
                
                <a href="#" class="block h-[230px] sm:h-[260px] md:h-[400px]" aria-label="Voir l'hôtel {{ $hotel->nom }}">
                    @if($hotel->image)
                        <img src="{{ asset('storage/' . $hotel->image) }}" 
                             alt="{{ $hotel->nom }}" 
                             class="w-full h-[120px] sm:h-[140px] md:h-[160px] object-cover rounded-t-2xl">
                    @else
                        <div class="w-full h-[120px] sm:h-[140px] md:h-[160px] bg-gray-200 flex items-center justify-center text-gray-500 italic rounded-t-2xl">
                            Aucune image
                        </div>
                    @endif

                    <div class="p-2 sm:p-4 text-center flex flex-col justify-center h-[110px] sm:h-[120px] md:h-[140px]">
                        <h3 class="text-[11px] sm:text-base md:text-lg lg:text-xl font-serif font-bold text-gray-800 truncate">
                            {{ $hotel->nom }}
                        </h3>
                        <h4 class="text-[9px] sm:text-sm md:text-base font-serif font-semibold text-red-500 mt-1">
                            {{ $hotel->ville }}
                        </h4>
                    </div>
                </a>
            </article>
        @empty
            <div class="text-center text-gray-500 text-sm sm:text-lg py-8 w-full">
                Aucun hôtel ou restaurant disponible pour le moment.
            </div>
        @endforelse
    </div>
</div>
   <!-- Image d'objet d'art -->
<div class="flex justify-center my-8 sm:my-12 px-4">
    <img 
        src="{{ asset('/image/objet d\'art.jpg') }}" 
        alt="Objet d'art traditionnel" 
        class="w-3/4 sm:w-full max-w-xs sm:max-w-md md:max-w-lg lg:max-w-xl rounded-lg shadow-lg transition duration-500 ease-in-out transform hover:scale-105 hover:opacity-80"
    >
</div>


<!-- Annonce événement dynamique -->
<div class="flex flex-row items-center justify-center gap-2 md:gap-6 p-3 md:p-4 bg-blue-100 rounded-2xl shadow-lg flex-wrap">

    @if ($prochainEvenement)
        <!-- Première image -->
        <img 
            src="{{ asset('storage/' . ($prochainEvenement->galeries[0]->photo ?? $prochainEvenement->photo)) }}"
            alt="{{ $prochainEvenement->nom }}" 
            class="w-20 h-20 sm:w-24 sm:h-24 md:w-1/3 md:h-64 lg:w-1/3 lg:h-64 object-cover rounded-xl md:shadow-md transition-transform duration-500 ease-in-out hover:scale-105 hover:opacity-90"
        />

        <!-- Bloc texte centré verticalement -->
        <div class="flex-1 flex flex-col justify-center px-2 md:px-4 text-left">
            <h2 class="text-sm sm:text-base md:text-xl lg:text-4xl font-semibold text-red-600 tracking-tight leading-snug mb-1 md:mb-2">
                📢 {{ $prochainEvenement->nom }} évènements
            </h2>
            <p class="text-xs sm:text-sm md:text-base lg:text-lg text-gray-700 leading-tight mt-1 md:mt-2">
                {{ Str::limit($prochainEvenement->description, 100, '...') }}
            </p>
            <p class="text-xs md:text-sm lg:text-base text-gray-600 mt-1 leading-tight">
                {{ \Carbon\Carbon::parse($prochainEvenement->date)->format('d-m-Y') }} | 📍 {{ $prochainEvenement->lieu }}
            </p>
            <p class="text-xs md:text-sm lg:text-base text-blue-600 mt-1 leading-tight">
                Sponsorisé par {{ $prochainEvenement->sponsor }}
            </p>
        </div>

        <!-- Deuxième image -->
        <img 
            src="{{ asset('storage/' . ($prochainEvenement->galeries[1]->photo ?? $prochainEvenement->photo)) }}"
            alt="{{ $prochainEvenement->nom }}" 
            class="w-20 h-20 sm:w-24 sm:h-24 md:w-1/3 md:h-64 lg:w-1/3 lg:h-64 object-cover rounded-xl md:shadow-md transition-transform duration-500 ease-in-out hover:scale-105 hover:opacity-90"
        />

    @else
        <div class="text-center w-full text-gray-500 text-sm py-4">
            Aucun événement à venir pour le moment.
        </div>
    @endif
</div>

<!-- SECTION : Itinéraires en vedette -->
<div 
    x-data="{
        activeSlide: 0,
        total: {{ count($topItineraires) }},
        interval: null,
        start() {
            this.interval = setInterval(() => {
                this.activeSlide = (this.activeSlide + 1) % this.total;
            }, 8000);
        }
    }" 
    x-init="start()" 
    class="w-full max-w-7xl mx-auto px-4 md:px-8 mt-4 font-serif"
>
    <!-- Titre principal -->
    <h2 class="text-center text-sm md:text-3xl lg:text-4xl font-extrabold font-serif text-gray-800 mb-2 md:mb-10 uppercase tracking-wider">
                Les ittineraires que vous pouvez participer 
    </h2>

    <!-- SLIDER PRINCIPAL -->
    <div class="relative overflow-hidden rounded-xl shadow-lg ">
        <div class="flex transition-transform duration-700 ease-in-out"
             :style="'transform: translateX(-' + (activeSlide * 100) + '%)'">
            
            @foreach($topItineraires as $itineraire)
                @php
                    $photos = $itineraire->site_touristiques->pluck('photo')->filter()->map(fn($p) => asset($p))->values();
                    if ($photos->isEmpty()) {
                        $photos = [asset('/image/itineraire.jpg')];
                    }
                @endphp

                <!-- Slide individuel -->
                <div class="w-full flex-shrink-0">
                    <div class="relative w-full h-[150px] md:h-[420px] lg:h-[520px] overflow-hidden rounded-xl">
                        
                        <!-- Slider interne pour les images -->
                        <div 
                            x-data="{
                                images: {{ json_encode($photos) }},
                                current: 0,
                                init() {
                                    setInterval(() => {
                                        this.current = (this.current + 1) % this.images.length;
                                    }, 3000);
                                }
                            }" 
                            x-init="init()" 
                            class="absolute inset-0 bg-black"
                        >
                            <template x-for="(img, idx) in images" :key="idx">
                                <img 
                                    :src="img"
                                    x-show="current === idx"
                                    x-transition
                                    class="absolute inset-0 w-full h-full object-cover object-center bg-black" />
                            </template>
                        </div>

                        <!-- Overlay texte et boutons -->
                        <div class="absolute inset-0 bg-black bg-opacity-60 flex flex-col justify-end p-4 md:p-6 lg:p-8 z-10">
                            <h3 class="text-white flex justify-center text-xm md:text-2xl lg:text-3xl font-bold font-serif drop-shadow">
                                {{ $itineraire->titre }}
                            </h3>
                            <p class="text-white mt-2 md:mt-2 text-xs md:text-sm lg:text-base line-clamp-1 md:line-clamp-1">
                                {{ $itineraire->description }}
                            </p>

                            <!-- Liste des lieux -->
                            <div class="flex flex-wrap gap-1 justify-center md:gap-2 mt-2 md:mt-3">
                                @foreach ($itineraire->site_touristiques as $site)
                                    <span class="bg-white/80 text-blue-800 text-[9px] md:text-xs lg:text-sm px-2 py-1 rounded shadow">
                                        📍 {{ $site->nom }}
                                    </span>
                                @endforeach
                            </div>

                            <!-- Bouton détails -->
                            <a href="{{ route('itineraire.showpublic', $itineraire->id) }}"
                               class=" flex justify-center  mt-2 md:mt-4 inline-block bg-indigo-600 text-white px-4 md:px-6 py-1 md:py-2 rounded-lg shadow hover:bg-indigo-700 transition text-xs md:text-sm lg:text-base">
                                Voir les détails
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- BOUTONS DE CONTRÔLE -->
        <div class="absolute inset-y-0 left-0 flex items-center">
            <button 
                @click="activeSlide = activeSlide > 0 ? activeSlide - 1 : total - 1"
                class=" hover:bg-white text-gray-800 rounded-full p-1 shadow-lg m-0"
                aria-label="Précédent">
                ⬅️
            </button>
        </div>
        <div class="absolute inset-y-0 right-0 flex items-center">
            <button 
                @click="activeSlide = (activeSlide + 1) % total"
                class="hover:bg-white text-gray-800 rounded-full p-1 shadow-lg m-0"
                aria-label="Suivant">
                ➡️
            </button>
        </div>
    </div>

    <!-- INDICATEURS -->
    <div class="flex justify-center mt-4 md:mt-6 space-x-2">
        @foreach ($topItineraires as $i => $itineraire)
            <div 
                @click="activeSlide = {{ $i }}"
                :class="{ 'bg-indigo-600': activeSlide === {{ $i }}, 'bg-gray-300': activeSlide !== {{ $i }} }"
                class="w-3 h-3 md:w-4 md:h-4 rounded-full cursor-pointer transition duration-300">
            </div>
        @endforeach
    </div>
</div>

<!-- Section FAQ -->
<div class="w-full  md:w-4/5 mx-auto my-2 md:my-12 p-2 md:p-6 bg-gray-50 rounded-2xl shadow-lg">
    <h1 class="text-sm md:text-3xl lg:text-4xl font-serif font-bold font-bold mb-2 md:mb-6 tracking-tight uppercase text-center">
        FAQ
    </h1>

    @foreach ($faqs as $faq)
    <div class="mb-3 md:mb-4">
        <div class="group">
            <button class="w-full text-left text-sm md:text-base lg:text-lg font-serif  bg-white p-3 md:p-4 rounded-xl md:shadow-md hover:bg-gray-100 flex justify-between items-center transition"
                    aria-expanded="false" onclick="toggleFaq(this)">
                <span>{{ $faq->question }}</span>
                <svg class="w-5 h-5 md:w-6 md:h-6 transform transition-transform duration-300 group-aria-expanded:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            
            <div class="hidden p-3 md:p-4 bg-white md:shadow-md rounded-xl mt-2 faq-answer transition">
                <p class="font-serif text-xs md:text-sm lg:text-base text-gray-800 leading-relaxed">
                    {{ $faq->answer }}
                </p>
            </div>
        </div>
    </div>
    @endforeach
</div>

<script>
function toggleFaq(button) {
    const answer = button.nextElementSibling;
    const expanded = button.getAttribute('aria-expanded') === 'true';
    button.setAttribute('aria-expanded', !expanded);
    answer.classList.toggle('hidden');
}
</script>


  <!-- Section Newsletter Responsive -->
@if (session('contenu'))
<div class="mb-3 md:mb-4 p-2 md:p-4 bg-blue-100 text-blue-800 rounded-xl font-serif text-xs md:text-sm lg:text-base">
    {{ session('contenu') }}
</div>
@endif

<div class="w-11/12 md:w-4/5 mx-auto my-6 md:my-12 p-3 md:p-6 bg-gray-100 rounded-2xl shadow-lg text-center
            h-40 sm:h-36 md:h-auto">
    <!-- Titre -->
    <h1 class="text-sm md:text-3xl lg:text-4xl font-serif font-bold text-gray-800 mb-2 md:mb-4 tracking-tight uppercase">
        Abonnez-vous à notre Newsletter 
    </h1>

    <!-- Ligne -->
    <div class="w-16 md:w-24 h-1 bg-blue-600 mx-auto mt-1 mb-2 md:mt-2 md:mb-4 rounded"></div>

    <!-- Texte -->
    <p class="text-xs sm:text-sm md:text-base lg:text-lg font-serif text-gray-600 mb-2 md:mb-6">
        Recevez en exclusivité nos annonces d'événements et bien plus encore !
    </p>

    <!-- Formulaire -->
    <form action="{{ route('newsletter.store') }}" method="POST"
          class="flex  md:flex-row items-center justify-center pb-0">
        @csrf
        <input type="email" name="email"
               class="w-2/3 sm:w-2/3 md:w-2/3 lg:w-2/3 p-2 md:p-4 border border-gray-300 rounded-l-xl
                      focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 text-xs sm:text-sm md:text-base"
               placeholder="Votre adresse email" required aria-label="Adresse email pour la newsletter">

        <button type="submit"
                class="w-1/3 sm:w-1/3 md:w-auto bg-blue-600 text-white px-4 md:px-6 py-2 md:py-3
                       rounded-r-xl hover:bg-blue-700 transition duration-300 text-xs sm:text-sm md:text-base font-semibold">
            S'abonner
        </button>
    </form>
</div>
<script> 
function toggleFaq(button) { const answer = button.parentElement.querySelector(".faq-answer");
 const icon = button.querySelector("svg"); 
 answer.classList.toggle("hidden"); icon.classList.toggle("rotate-180"); }
 </script>

<!-- Masquer la barre de scroll sur mobile -->
<style>
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }

</style>


@endsection