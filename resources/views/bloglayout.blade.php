<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toché.bj</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        .font-serif {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>
<body>
    <!-- NAVIGATION -->
    <nav class="bg-gray-800 text-white p-4 flex flex-col md:flex-row items-center justify-between shadow-lg">
        <!-- Logo -->
        <div class="flex justify-center mb-4 md:mb-0">
            <a href="{{ route('accueil') }}">
                <img class="w-16 h-16 p-1 rounded-full  hover:scale-105 transition-transform duration-300" 
                     src="{{ asset('image/logo3.jpg') }}" 
                     alt="Toché Logo">
            </a>
        </div>

        <!-- Menu Principal -->
        <div class="flex flex-wrap justify-center md:justify-between items-center gap-x-6">
            <a class="font-serif font-semibold text-sm md:text-base uppercase tracking-tight hover:text-blue-400 transition-colors duration-300" 
               href="{{ route('accueil') }}">Accueil</a>
            <a class="font-serif font-semibold text-sm md:text-base uppercase tracking-tight hover:text-blue-400 transition-colors duration-300" 
               href="{{ route('site_touristique') }}">Sites Touristiques</a>
            <a class="font-serif font-semibold text-sm md:text-base uppercase tracking-tight hover:text-blue-400 transition-colors duration-300" 
               href="{{ route('evenements') }}">Événements</a>
            <a class="font-serif font-semibold text-sm md:text-base uppercase tracking-tight hover:text-blue-400 transition-colors duration-300" 
               href="{{ route('apropos') }}">À Propos</a>
            <a class="font-serif font-semibold text-sm md:text-base uppercase tracking-tight hover:text-blue-400 transition-colors duration-300" 
               href="{{ route('Contacts') }}">Contacts</a>
            <a class="font-serif font-semibold text-sm md:text-base uppercase tracking-tight hover:text-blue-400 transition-colors duration-300" 
               href="{{ route('participer') }}">Participer</a>
        </div>

        <!-- Actions Utilisateur -->
        @if (Route::has('login'))
            <div class="flex flex-col md:flex-row gap-3 mt-4 md:mt-0 px-4 md:px-0">
                @auth
                    @if(Auth::user()->id === 1)
                        <a href="{{ url('/welcome') }}" 
                           class="px-5 py-1.5 rounded-xl bg-blue-600 text-white font-serif font-semibold text-sm md:text-base hover:bg-blue-700 transition-all transform hover:scale-105">
                            Admin
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                                class="px-5 py-1.5 rounded-xl bg-red-600 text-white font-serif font-semibold text-sm md:text-base hover:bg-red-700 transition-all transform hover:scale-105">
                            Déconnexion
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" 
                       class="px-5 py-1.5 rounded-xl bg-blue-600 text-white font-serif font-semibold text-sm md:text-base hover:bg-blue-700 transition-all transform hover:scale-105">
                        Connexion
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" 
                           class="px-5 py-1.5 rounded-xl bg-blue-600 text-white font-serif font-semibold text-sm md:text-base hover:bg-blue-700 transition-all transform hover:scale-105">
                            S'inscrire
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </nav>

    <!-- CONTENU PRINCIPAL -->
    <main class="min-h-screen">
        @yield('contenu')
    </main>

    <!-- FOOTER -->
    <footer class="flex flex-col md:flex-row justify-between p-6 bg-gray-800 text-white mt-12 shadow-lg">
        <!-- À propos -->
        <div class="w-full md:w-1/3 p-2 flex items-center gap-3">
            <img src="{{ asset('image/logo3.jpg') }}" 
                 alt="Logo Toche" 
                 class="h-12 object-contain rounded-full hover:scale-110 transition-transform duration-300">
            <p class="text-sm md:text-base font-serif font-semibold text-gray-300 hover:text-blue-400 transition-colors duration-300">
                Toché, la plateforme de gestion des sites touristiques & événements du Bénin
            </p>
        </div>

        <!-- Coordonnées -->
        <div class="mt-6 md:mt-0 text-center md:w-1/3">
            <p class="text-base md:text-lg font-serif font-bold text-white mb-2 tracking-tight uppercase">Contactez-nous</p>
            <div class="space-y-1 text-sm md:text-base font-serif text-gray-300">
                <a href="tel:+2290165103959" class="block hover:text-blue-400 transition-colors">+229 01 65 10 39 59</a>
                <a href="tel:+2290169580603" class="block hover:text-blue-400 transition-colors">+229 01 69 58 06 03</a>
            </div>
            <div class="flex justify-center items-center space-x-4 mt-4">
                <a href="#"><img class="w-6 h-6 md:w-7 md:h-7 hover:scale-110 transition-transform rounded" 
                                 src="{{ asset('/image/facebook2.jpeg') }}" 
                                 alt="Facebook"></a>
                <a href="#"><img class="w-6 h-6 md:w-7 md:h-7 hover:scale-110 transition-transform rounded" 
                                 src="{{ asset('/image/instagram2.jpeg') }}" 
                                 alt="Instagram"></a>
                <a href="#"><img class="w-6 h-6 md:w-7 md:h-7 hover:scale-110 transition-transform rounded" 
                                 src="{{ asset('/image/twiter2.png') }}" 
                                 alt="Twitter"></a>
            </div>
        </div>

        <!-- Adresse -->
        <div class="mt-6 md:mt-0 text-center md:w-1/3">
            <p class="text-base md:text-lg font-serif font-bold text-white mb-2 tracking-tight uppercase">Adresse</p>
            <p class="text-sm md:text-base font-serif text-gray-300">Godomey Togoudo, Abomey-Calavi, Bénin</p>
            <a href="https://www.google.com/maps/place/TFG+SARL" 
               class="inline-flex items-center justify-center gap-2 mt-2 text-sm md:text-base font-serif text-gray-300 hover:text-blue-400 transition-colors">
                <img class="w-5 h-5 md:w-6 md:h-6" src="{{ asset('/image/localisation2.jpg') }}" alt="Localisation">
                <span>Voir sur Google Maps</span>
            </a>
            <p class="text-sm md:text-base font-serif text-cyan-500 mt-3">
                2025 © TFG - Technology Forever Group · Tous droits réservés.
            </p>
        </div>
    </footer>

    <script src="//unpkg.com/alpinejs" defer></script>
    {{-- script pour le faq --}}

<script>
    function toggleFaq(button) {
        const answer = button.nextElementSibling;
        const expanded = button.getAttribute('aria-expanded') === 'true';
        button.setAttribute('aria-expanded', !expanded);
        answer.classList.toggle('hidden');
        button.querySelector('svg').classList.toggle('rotate-180');
    }
    </script>
</body>
</html>