<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toché.bj</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
   
   <!-- NAVIGATION -->
<nav class="bg-gray-700 text-white p-4 flex flex-col md:flex-row items-center justify-between">
    
    <!-- Logo -->
    <div class="h-18 flex justify-center mb-2 md:mb-0">
        <a href="{{ route('accueil') }}">
            <img class="w-16 h-16 p-1 mb-2 rounded-full" src="{{ asset('image/logo3.jpg') }}" alt="Toché">
        </a>
    </div>

    <!-- Menu Principal -->
    <div class="flex flex-wrap justify-center md:justify-between items-center gap-x-4">
        <a class="hover:text-red-700" href="{{ route('accueil') }}">ACCUEIL</a>
        <a class="hover:text-red-700" href="{{ route('site_touristique') }}">SITES TOURISTIQUES</a>
        <a class="hover:text-red-700" href="{{ route('evenements') }}">ÉVÉNEMENTS</a>
        <a class="hover:text-red-700" href="{{ route('apropos') }}">À PROPOS</a>
        <a class="hover:text-red-700" href="{{ route('Contacts') }}">CONTACTS</a>
        <a class="hover:text-red-700" href="{{ route('participer') }}">PARTICIPER</a>
    </div>

    <!-- Actions Utilisateur -->
    @if (Route::has('login'))
    <div class="flex flex-col md:flex-row gap-3 mt-4 md:mt-0 px-4 md:px-0">
        @auth
            {{-- Si l'utilisateur a l'ID 1, on affiche le bouton Admin --}}
            @if(Auth::user()->id === 1)
                <a href="{{ url('/welcome') }}" class="px-5 py-1.5 rounded-xl bg-blue-200 hover:bg-blue-600 text-black transition-all text-center transform hover:scale-105">
                    Admin
                </a>
            @endif

            {{-- Bouton Déconnexion pour tous les utilisateurs connectés --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-5 py-1.5 rounded-xl bg-red-200 hover:bg-red-600 text-black transition-all text-center transform hover:scale-105">
                    Déconnexion
                </button>
            </form>
        @else
            {{-- Boutons Connexion et Inscription pour les invités --}}
            <a href="{{ route('login') }}" class="px-5 py-1.5 rounded-xl bg-blue-200 hover:bg-blue-600 text-black transition-all text-center transform hover:scale-105">
                Connexion
            </a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="px-5 py-1.5 rounded-xl bg-blue-200 hover:bg-blue-600 text-black transition-all text-center transform hover:scale-105">
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
     {{-- section de message --}}
   
</main>

<!-- FOOTER -->
<footer class="flex flex-col md:flex-row justify-between p-4 bg-black text-white mt-10">
    
    <!-- À propos -->
    <div class="w-full max-w-screen-md p-2 flex items-center gap-2 font-[Arial]">
        <img src="{{ asset('image/logo3.jpg') }}" alt="Logo Toche" class="h-10 object-contain hover:scale-110 transition-transform duration-300 rounded-full">
        <p class="text-sm sm:text-base md:text-xl lg:text-2xl font-bold text-gray-400 hover:text-blue-500 transition-all duration-300">
            Toche, la plateforme de gestion des sites touristiques & événements du Bénin
        </p>
    </div>

    <!-- Coordonnées -->
    <div class="mt-4 md:mt-0 text-sm md:text-base lg:text-lg text-gray-400 text-center font-[Arial]">
        <p class="font-semibold mb-1">Contactez-nous :</p>
        <div class="space-y-1">
            <a href="tel:+2290165103959" class="block hover:text-blue-600 transition">+229 01 65 10 39 59</a>
            <a href="tel:+2290169580603" class="block hover:text-blue-600 transition">+229 01 69 58 06 03</a>
        </div>
        <div class="flex justify-center items-center space-x-4 mt-3">
            <a href="#"><img class="w-6 h-6 md:w-7 md:h-7 hover:scale-110 transition-transform rounded" src="{{ asset('/image/facebook2.jpeg') }}" alt="Facebook"></a>
            <a href="#"><img class="w-6 h-6 md:w-7 md:h-7 hover:scale-110 transition-transform rounded" src="{{ asset('/image/instagram2.jpeg') }}" alt="Instagram"></a>
            <a href="#"><img class="w-6 h-6 md:w-7 md:h-7 hover:scale-110 transition-transform rounded" src="{{ asset('/image/twiter2.png') }}" alt="Twitter"></a>
        </div>
    </div>

    <!-- Adresse -->
    <div class="mt-4 md:mt-0 text-center text-sm md:text-base text-gray-400 font-[Arial]">
        <p class="text-cyan-500 font-semibold">
            2024 © TFG - Technology Forever Group · Tous droits réservés.
        </p>
        <a href="https://www.google.com/maps/place/TFG+SARL" class="inline-flex items-center justify-center gap-2 hover:text-blue-600 transition">
            <img class="w-5 h-5 md:w-6 md:h-6" src="{{ asset('/image/localisation2.jpg') }}" alt="Localisation">
            <span>Adresse</span>
        </a>
        <p class="mt-1">Godomey Togoudo, Abomey-Calavi, Bénin</p>
    </div>
</footer>

<script src="//unpkg.com/alpinejs" defer></script>

</body>
</html>
