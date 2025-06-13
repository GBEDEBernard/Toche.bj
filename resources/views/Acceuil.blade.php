@extends('bloglayout')

@section('contenu')
    <!-- Bannière principale avec formulaire de recherche -->
    <div class="relative h-[70vh] bg-cover bg-top flex items-center justify-center" style="background-image: url('{{ asset('/image/amazone2.jpg') }}');">
        <!-- Overlay sombre pour lisibilité -->
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    </div>

    <!-- Slogan -->
    <div class="text-center my-12">
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-serif font-bold text-gray-800 hover:text-blue-600 transition-colors duration-300 tracking-tight uppercase">
            Programmez vos vacances en 1 clic
        </h1>
        <div class="w-24 h-1 bg-blue-600 mx-auto mt-4 rounded"></div>
        <h3 class="text-lg md:text-2xl font-serif font-semibold text-red-700 mt-6 hover:text-red-500 transition-colors duration-300">
            Faites vos réservations depuis votre canapé et évitez les foules dans les billetteries.
        </h3>
    </div>

    <!-- Section des cartes de navigation -->
    <div class="flex flex-col md:flex-row gap-4 mb-12 mx-auto max-w-6xl px-4">
        <!-- Carte Site Touristique -->
        <div class="flex w-full md:w-1/3 h-36 border-2 rounded-lg shadow-lg overflow-hidden hover:scale-105 transition-transform duration-300">
            <a href="{{ route('site_touristique') }}" class="flex w-full" aria-label="Voir les sites touristiques">
                <img class="h-36 w-36 object-cover rounded-l-lg" 
                     src="{{ asset('/image/site6-enhanced.png') }}" 
                     alt="Site touristique Amazone">
                <h3 class="text-center w-full flex items-center justify-center font-serif font-semibold text-sm md:text-base text-gray-800">
                    Sites touristiques
                </h3>
            </a>
        </div>

        <!-- Carte Événements -->
        <div class="flex w-full md:w-1/3 h-36 border-2 rounded-lg shadow-lg bg-black text-white overflow-hidden hover:scale-105 transition-transform duration-300">
            <a href="{{ route('evenements') }}" class="flex w-full" aria-label="Voir les événements">
                <img class="h-36 w-36 object-cover rounded-l-lg" 
                     src="{{ asset('/image/eveement1.jpg') }}" 
                     alt="Événement Vodou Days">
                <h3 class="text-center w-full flex items-center justify-center font-serif font-semibold text-sm md:text-base">
                    Événements
                </h3>
            </a>
        </div>

        <!-- Carte Hôtels & Restaurants -->
        <div class="flex w-full md:w-1/3 h-36 border-2 rounded-lg shadow-lg overflow-hidden hover:scale-105 transition-transform duration-300">
            <a href="#" class="flex w-full" aria-label="Voir les hôtels et restaurants">
                <img class="h-36 w-36 object-cover rounded-l-lg" 
                     src="{{ asset('/image/novotel2.jpg') }}" 
                     alt="Hôtel Novotel">
                <h3 class="text-center w-full flex items-center justify-center font-serif font-semibold text-sm md:text-base text-gray-800">
                    Hôtels & Restaurants
                </h3>
            </a>
        </div>
    </div>

    <!-- Section des sites touristiques -->
    <div class="text-center my-12">
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-serif font-bold text-gray-800 hover:text-blue-600 transition-colors duration-300 tracking-tight uppercase">
            Nos sites touristiques
        </h1>
        <div class="w-24 h-1 bg-blue-600 mx-auto mt-4 rounded"></div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 mb-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8 justify-items-center">
            @forelse ($topSites as $site)
                <article class="bg-white border border-gray-200 rounded-lg shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 w-full max-w-[20rem] sm:max-w-[22rem] lg:max-w-[18rem]">
                    <a href="{{ route('sites.show', $site->id) }}" class="block" aria-label="Voir le site {{ $site->nom }}">
                        <img class="w-full h-36 sm:h-44 md:h-52 lg:h-48 object-cover rounded-t-lg" 
                             src="{{ asset($site->photo) }}" 
                             alt="{{ $site->nom }}"
                             loading="lazy">
                        <div class="p-4 text-center">
                            <h3 class="text-sm sm:text-base md:text-lg lg:text-xl font-serif font-bold text-blue-600 truncate">
                                {{ $site->nom }}
                            </h3>
                            <h4 class="text-xs sm:text-sm md:text-base font-serif font-semibold text-blue-600 mt-2">
                                {{ $site->commune }}
                            </h4>
                            <div class="flex justify-center items-center space-x-1 mt-1">
                                @php
                                    $moyenne = round($site->moyenne_note ?? 0, 1);
                                    $etoilesPleine = floor($moyenne);
                                    $demiEtoile = ($moyenne - $etoilesPleine) >= 0.5;
                                    $etoilesVide = 5 - $etoilesPleine - ($demiEtoile ? 1 : 0);
                                @endphp
                                @for ($i = 0; $i < $etoilesPleine; $i++)
                                    <span class="text-yellow-400">★</span>
                                @endfor
                                @if($demiEtoile)
                                    <span class="text-yellow-400">☆</span>
                                @endif
                                @for ($i = 0; $i < $etoilesVide; $i++)
                                    <span class="text-gray-300">★</span>
                                @endfor
                                <span class="text-gray-600 ml-2 text-sm">({{ $moyenne }})</span>
                            </div>
                        </div>
                    </a>
                </article>
            @empty
                <div class="col-span-1 sm:col-span-2 lg:col-span-4 text-center text-gray-500 text-base sm:text-lg py-8">
                    Aucun site touristique trouvé pour le moment.
                </div>
            @endforelse
        </div>
    </div>

    <div class="text-center mb-10">
        <a href="{{ route('site_touristique') }}" class="text-blue-500 font-serif font-semibold hover:underline transition-colors duration-300">
            Voir plus
        </a>
    </div>

    <!-- Bannière promotionnelle -->
    <div class="bg-black p-6 mt-6 rounded-lg shadow-lg text-center md:flex md:items-center md:justify-between">
        <div class="max-w-4xl mx-auto text-white">
            <p class="text-lg font-serif text-justify leading-relaxed md:mr-6">
                Chers amis de <strong class="text-yellow-500 font-serif">Toché, le miroir du pays (Bénin)</strong>, nous serons ravis de vous compter parmi nous lors de nos différents événements touristiques au Bénin, qu'ils soient annuels ou exclusifs. Ces événements seront mis à l'honneur à travers divers programmes et démonstrations.
            </p>
        </div>
        <img src="{{ asset('/image/evenement3.jpg') }}" 
             alt="Événement touristique au Bénin" 
             class="w-full mt-4 md:mt-0 md:w-1/2 h-48 md:h-72 rounded-lg shadow-md hover:scale-105 transition-transform duration-300">
    </div>

    <!-- Section des événements -->
    <div class="text-center my-12">
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-serif font-bold text-gray-800 hover:text-blue-600 transition-colors duration-300 tracking-tight uppercase">
            Nos Événements
        </h1>
        <div class="w-24 h-1 bg-blue-600 mx-auto mt-4 rounded"></div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 mb-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8 justify-items-center">
            @forelse ($topEvenements as $evenement)
                <div class="bg-white border border-gray-200 rounded-lg shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 w-full max-w-[20rem] sm:max-w-[22rem] lg:max-w-[18rem]">
                    <a href="{{ route('admin.evenements.show', $evenement->id) }}" class="block" aria-label="Voir l'événement {{ $evenement->nom }}">
                        <img class="w-full h-36 sm:h-44 md:h-52 lg:h-48 object-cover rounded-t-lg" 
                             src="{{ asset($evenement->photo) }}" 
                             alt="{{ $evenement->nom }}"
                             loading="lazy">
                        <div class="p-4 text-center">
                            <h1 class="text-sm sm:text-base md:text-lg lg:text-xl font-serif font-bold text-blue-600 truncate">
                                {{ $evenement->nom }}
                            </h1>
                            <h4 class="text-xs sm:text-sm md:text-base font-serif font-semibold text-blue-600 mt-2">
                                {{ $evenement->lieu }}
                            </h4>
                            @if ($evenement->date)
                                <p class="text-xs sm:text-sm font-serif text-gray-500 mt-1">
                                    {{ $evenement->date }}
                                </p>
                            @endif
                            <div class="flex justify-center items-center space-x-1 mt-1">
                                @php
                                    $moyenne = round($evenement->moyenne_note ?? 0, 1);
                                    $etoilesPleine = floor($moyenne);
                                    $demiEtoile = ($moyenne - $etoilesPleine) >= 0.5;
                                    $etoilesVide = 5 - $etoilesPleine - ($demiEtoile ? 1 : 0);
                                @endphp
                                @for ($i = 0; $i < $etoilesPleine; $i++)
                                    <span class="text-yellow-400">★</span>
                                @endfor
                                @if($demiEtoile)
                                    <span class="text-yellow-400">☆</span>
                                @endif
                                @for ($i = 0; $i < $etoilesVide; $i++)
                                    <span class="text-gray-300">★</span>
                                @endfor
                                <span class="text-gray-600 ml-2 text-sm">({{ $moyenne }})</span>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-span-1 sm:col-span-2 lg:col-span-4 text-center text-gray-500 text-base sm:text-lg py-8">
                    Aucun événement à venir pour le moment.
                </div>
            @endforelse
        </div>
    </div>

    <div class="text-center mb-10">
        <a href="{{ route('evenements') }}" class="text-blue-500 font-serif font-semibold hover:underline transition-colors duration-300">
            Voir plus
        </a>
    </div>

    <!-- Section Hôtels & Restaurants -->
<div class="bg-gray-100 py-12">
    <div class="text-center my-12">
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-serif font-bold text-gray-800 hover:text-blue-600 transition-colors duration-300 tracking-tight uppercase">
            Hôtels & Restaurants
        </h1>
        <div class="w-24 h-1 bg-blue-600 mx-auto mt-4 rounded"></div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 max-w-6xl mx-auto px-4">

        @foreach ($hotels as $hotel)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                @if($hotel->image)
                    <img src="{{ asset('storage/' . $hotel->image) }}" alt="{{ $hotel->nom }}" class="w-full h-48 object-cover">
                @endif
                <div class="p-4 text-center">
                    <h3 class="text-xl font-serif font-semibold text-gray-800">{{ $hotel->nom }}</h3>
                    <h4 class="text-base font-serif font-semibold text-red-500 mt-2">{{ $hotel->ville }}</h4>
                </div>
            </div>
        @endforeach

    </div>
</div>


    <!-- Image d'objet d'art -->
    <div class="flex justify-center my-12">
        <img src="{{ asset('/image/objet d\'art.jpg') }}" 
             alt="Objet d'art traditionnel" 
             class="w-full max-w-md md:max-w-lg lg:max-w-xl rounded-lg shadow-lg transition duration-500 ease-in-out transform hover:scale-105 hover:opacity-80">
    </div>

   <!-- Annonce événement dynamique -->
<div class="flex flex-col md:flex-row items-center justify-center gap-6 my-12 p-6 bg-blue-200 rounded-lg shadow-md">
    @if ($prochainEvenement)
        <!-- Première image de la galerie -->
        <img src="{{ asset('storage/' . ($prochainEvenement->galeries[0]->photo ?? $prochainEvenement->photo)) }}"
        alt="{{ $prochainEvenement->nom }}" 
        class="w-full md:w-1/3 h-64 object-cover rounded-lg shadow-lg transition duration-500 ease-in-out transform hover:scale-105 hover:opacity-80" />

        <!-- Informations de l'événement -->
        <div class="text-center md:w-1/2">
            <h1 class="text-2xl md:text-3xl lg:text-4xl font-serif font-bold text-red-600 mb-4 tracking-tight uppercase">
                Annonces des événements
            </h1>
            <h3 class="text-lg md:text-xl font-serif text-gray-800 leading-relaxed">
                <span class="font-semibold text-blue-700">{{ $prochainEvenement->nom }}</span><br>
                {{ $prochainEvenement->description }}<br><br>
                📅 <strong>Dates :</strong> {{ \Carbon\Carbon::parse($prochainEvenement->date)->format('d-m-Y') }}<br>
                📍 <strong>Lieu :</strong> {{ $prochainEvenement->lieu }}<br><br>
                Sponsorisé par <strong>{{ $prochainEvenement->sponsor }}</strong>. Ne manquez pas cet événement unique !
            </h3>
        </div>

        <!-- Deuxième image de la galerie -->
        <img src="{{ asset('storage/' . ($prochainEvenement->galeries[1]->photo ?? $prochainEvenement->photo)) }}"
        alt="{{ $prochainEvenement->nom }}" 
        class="w-full md:w-1/3 h-64 object-cover rounded-lg shadow-lg transition duration-500 ease-in-out transform hover:scale-105 hover:opacity-80" />        @else
                <div class="text-center w-full text-gray-500">
            Aucun événement à venir pour le moment.
        </div>
    @endif
</div>

    <!-- Section FAQ -->
<div class="w-4/5 mx-auto my-12 p-6 bg-gray-50 rounded-lg shadow-lg">
    <h1 class="text-2xl md:text-3xl lg:text-4xl font-serif font-bold text-red-600 mb-6 tracking-tight uppercase">
        FAQ
    </h1>

    @foreach ($faqs as $faq)
    <div class="mb-4">
        <div class="group">
            <button class="w-full text-left text-lg font-serif font-semibold bg-white p-4 rounded-lg shadow-md hover:bg-gray-100 flex justify-between items-center" aria-expanded="false" onclick="toggleFaq(this)">
                <span>{{ $faq->question }}</span>
                <svg class="w-6 h-6 transform transition duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div class="hidden p-4 bg-white shadow-md rounded-lg mt-2 faq-answer">
                <p class="font-serif text-gray-600">{{ $faq->answer }}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>

    <!-- Section Newsletter -->
    <div class="w-4/5 mx-auto my-12 p-6 bg-gray-100 rounded-lg shadow-lg text-center">
        <h1 class="text-2xl md:text-3xl lg:text-4xl font-serif font-bold text-gray-800 mb-4 tracking-tight uppercase">
            Abonnez-vous à notre Newsletter 📩
        </h1>
        <div class="w-24 h-1 bg-blue-600 mx-auto mt-4 mb-6 rounded"></div>
        <p class="text-lg font-serif text-gray-600 mb-6">
            Recevez en exclusivité nos annonces d'événements et bien plus encore !
        </p>
        <form action="{{ route('newsletter.store') }}" method="POST" class="flex flex-col md:flex-row items-center justify-center gap-4">
            @csrf
            <input type="email" name="email" class="w-full md:w-2/3 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Votre adresse email" required aria-label="Adresse email pour la newsletter">
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300">S'abonner</button>
        </form>

    </div>
@endsection