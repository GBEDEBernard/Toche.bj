<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Toché.bj</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet" />
    <style>
        .font-serif {
            font-family: 'Playfair Display', serif;
        }
    </style>
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
</head>
<body>
    <nav class="bg-gray-800 text-white p-4 flex flex-col md:flex-row items-center justify-between shadow-lg" x-data="{ itineraireOpen: false }">
        <div class="flex justify-center mb-4 md:mb-0">
            <a href="{{ route('accueil') }}">
                <img class="w-16 h-16 p-1 rounded-full hover:scale-105 transition-transform duration-300" src="{{ asset('image/logo3.jpg') }}" alt="Toché Logo" />
            </a>
        </div>

        <div class="flex flex-wrap justify-center md:justify-between items-center gap-x-6 relative">
            <a href="{{ route('accueil') }}" class="{{ request()->routeIs('accueil') ? 'text-blue-200 underline' : 'text-white' }} font-serif font-semibold text-sm md:text-base uppercase tracking-tight hover:text-blue-400 transition-colors duration-300">Accueil</a>

            <a href="{{ route('site_touristique') }}" class="{{ request()->routeIs('site_touristique') ? 'text-blue-200 underline' : 'text-white' }} font-serif font-semibold text-sm md:text-base uppercase tracking-tight hover:text-blue-400 transition-colors duration-300">Sites Touristiques</a>

            <div class="relative" @mouseenter="itineraireOpen = true" @mouseleave="itineraireOpen = false">
                <button @click="itineraireOpen = !itineraireOpen" class="{{ request()->routeIs('evenements') ? 'text-blue-200 underline' : 'text-white' }} font-serif font-semibold text-sm md:text-base uppercase tracking-tight hover:text-blue-400 transition duration-300 flex items-center gap-1">
                    Événements
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': itineraireOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="itineraireOpen" x-transition class="absolute left-2 z-50 mt-2 w-44 bg-white border rounded-md shadow-lg text-gray-800" @click.outside="itineraireOpen = false">
                    <a href="{{ route('evenements') }}" class="block px-4 py-3 hover:bg-gray-400 font-serif text-sm">Voir tous les événements</a>
                    <a href="{{ route('itineraire.offres') }}" class="block px-4 py-3 hover:bg-gray-400 font-serif text-sm border-t">Les offres d’itinéraires</a>
                </div>
            </div>

            <a href="{{ route('apropos') }}" class="{{ request()->routeIs('apropos') ? 'text-blue-200 underline' : 'text-white' }} font-serif font-semibold text-sm md:text-base uppercase tracking-tight hover:text-blue-400 transition-colors duration-300">À Propos</a>

            <a href="{{ route('Contacts') }}" class="{{ request()->routeIs('Contacts') ? 'text-blue-200 underline' : 'text-white' }} font-serif font-semibold text-sm md:text-base uppercase tracking-tight hover:text-blue-400 transition-colors duration-300">Contacts</a>

            <a href="{{ route('participer') }}" class="{{ request()->routeIs('participer') ? 'text-blue-200 underline' : 'text-white' }} font-serif font-semibold text-sm md:text-base uppercase tracking-tight hover:text-blue-400 transition-colors duration-300">Participer</a>
        </div>

        @if (Route::has('login'))
            <div class="flex flex-col md:flex-row gap-3 mt-4 md:mt-0 px-4 md:px-0">
                @auth
                    @if(Auth::user()->id === 1)
                        <a href="{{ url('/welcome') }}" class="px-5 py-1.5 rounded-xl bg-blue-600 text-white font-serif font-semibold text-sm md:text-base hover:bg-blue-700 transition-all transform hover:scale-105">Admin</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-5 py-1.5 rounded-xl bg-red-600 text-white font-serif font-semibold text-sm md:text-base hover:bg-red-700 transition-all transform hover:scale-105">Déconnexion</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="px-5 py-1.5 rounded-xl bg-blue-600 text-white font-serif font-semibold text-sm md:text-base hover:bg-blue-700 transition-all transform hover:scale-105">Connexion</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-5 py-1.5 rounded-xl bg-blue-600 text-white font-serif font-semibold text-sm md:text-base hover:bg-blue-700 transition-all transform hover:scale-105">S'inscrire</a>
                    @endif
                @endauth
            </div>
        @endif
    </nav>

    <main class="min-h-screen">
        @yield('contenu')
    </main>

    <footer class="flex flex-col md:flex-row justify-between p-6 bg-gray-800 text-white mt-12 shadow-lg">
        <div class="w-full md:w-1/3 p-2 flex items-center gap-3">
            <img src="{{ asset('image/logo3.jpg') }}" alt="Logo Toche" class="h-12 object-contain rounded-full hover:scale-110 transition-transform duration-300" />
            <p class="text-sm md:text-base font-serif font-semibold text-gray-300 hover:text-blue-400 transition-colors duration-300">
                Toché, la plateforme de gestion des sites touristiques & événements du Bénin
            </p>
        </div>

        <div class="mt-6 md:mt-0 text-center md:w-1/3">
            <p class="text-base md:text-lg font-serif font-bold text-white mb-2 tracking-tight uppercase">Contactez-nous</p>
            <div class="space-y-1 text-sm md:text-base font-serif text-gray-300">
                <a href="tel:+2290165103959" class="block hover:text-blue-400 transition-colors">+229 01 65 10 39 59</a>
                <a href="tel:+2290169580603" class="block hover:text-blue-400 transition-colors">+229 01 69 58 06 03</a>
            </div>
            <div class="flex justify-center items-center space-x-4 mt-4">
                <a href="#"><img class="w-6 h-6 md:w-7 md:h-7 hover:scale-110 transition-transform rounded" src="{{ asset('/image/facebook2.jpeg') }}" alt="Facebook" /></a>
                <a href="#"><img class="w-6 h-6 md:w-7 md:h-7 hover:scale-110 transition-transform rounded" src="{{ asset('/image/instagram2.jpeg') }}" alt="Instagram" /></a>
                <a href="#"><img class="w-6 h-6 md:w-7 md:h-7 hover:scale-110 transition-transform rounded" src="{{ asset('/image/twiter2.png') }}" alt="Twitter" /></a>
            </div>
        </div>

        <div class="mt-6 md:mt-0 text-center md:w-1/3">
            <p class="text-base md:text-lg font-serif font-bold text-white mb-2 tracking-tight uppercase">Adresse</p>
            <p class="text-sm md:text-base font-serif text-gray-300">Godomey Togoudo, Abomey-Calavi, Bénin</p>
            <a href="https://www.google.com/maps/place/TFG+SARL" class="inline-flex items-center justify-center gap-2 mt-2 text-sm md:text-base font-serif text-gray-300 hover:text-blue-400 transition-colors">
                <img class="w-5 h-5 md:w-6 md:h-6" src="{{ asset('/image/localisation2.jpg') }}" alt="Localisation" />
                <span>Voir sur Google Maps</span>
            </a>
            <p class="text-sm md:text-base font-serif text-cyan-500 mt-3">2025 © TFG - Technology Forever Group · Tous droits réservés.</p>
        </div>
    </footer>

    <script src="//unpkg.com/alpinejs" defer></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
