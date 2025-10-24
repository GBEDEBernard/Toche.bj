<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Toché.bj</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet" />

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}" />

    <style>
        .font-serif { font-family: 'Playfair Display', serif; }

        /* Lazy load effect pro */
        .lazy-img {
            filter: blur(12px);
            opacity: 0;
            transition: filter 0.6s ease-out, opacity 0.6s ease-out, transform 0.6s ease-out;
            transform: scale(1.05);
        }
        .lazy-img.loaded {
            filter: blur(0);
            opacity: 1;
            transform: scale(1);
        }

        /* Ajustements responsive */
        @media (max-width: 768px) {
            nav div.flex.flex-wrap { flex-direction: column; gap: 2rem !important; }
            nav img { width: 48px; height: 48px; }
            footer { padding: 4 !important; }
            footer img { height: 32px; }
            footer p { font-size: 0.75rem; }
        }
    </style>
<!-- Bootstrap Icons -->
<link 
  rel="stylesheet" 
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
</head>
<body class="bg-gray-50">
<!-- NAVBAR -->
<nav class="bg-gray-800 text-white p-4 shadow-lg w-max-auto"
     x-data="{ itineraireOpen: false, mobileOpen: false, profilOpen: false }">

  <!-- Ligne principale -->
  <div class="flex items-center justify-between w-full">
    <!-- Logo -->
    <a href="{{ route('accueil') }}" class="flex-shrink-0">
      <img class="w-12 h-12 sm:w-14 sm:h-14 rounded-full hover:scale-105 transition-transform duration-300"
           src="{{ asset('image/logo3.jpg') }}" alt="Toché Logo" />
    </a>

    <!-- Menu desktop -->
    <div class="hidden md:flex items-center gap-8 font-serif uppercase text-sm">
      <a href="{{ route('accueil') }}" 
         class="{{ request()->routeIs('accueil') ? 'text-red-500' : 'hover:text-blue-400' }} transition-colors">
         Accueil
      </a>
      <a href="{{ route('site_touristique') }}" 
         class="{{ request()->routeIs('site_touristique') ? 'text-red-500' : 'hover:text-blue-400' }} transition-colors">
         Sites Touristiques
      </a>

      <!-- Sous-menu Événements -->
      <div class="relative" @mouseenter="itineraireOpen = true" @mouseleave="itineraireOpen = false">
        <button @click="itineraireOpen = !itineraireOpen" 
                class="flex uppercase  items-center gap-1 transition-colors 
                       {{ request()->routeIs('evenements') || request()->routeIs('itineraire.offres') ? 'text-red-500' : 'hover:text-blue-400' }}">
          Événements
          <svg class="w-4 h-4 transition-transform duration-200" 
               :class="{ 'rotate-180': itineraireOpen }" 
               fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>

        <div x-show="itineraireOpen" x-transition 
             class="absolute mt-2 w-48 bg-white text-gray-800 rounded-lg shadow-lg z-50">
          <a href="{{ route('evenements') }}" 
             class="block px-4 py-2 hover:bg-gray-100 {{ request()->routeIs('evenements') ? 'text-red-500 font-semibold' : '' }}">
             Voir tous les événements
          </a>
          <a href="{{ route('itineraire.offres') }}" 
             class="block px-4 py-2 hover:bg-gray-100 border-t {{ request()->routeIs('itineraire.offres') ? 'text-red-500 font-semibold' : '' }}">
             Les offres d’itinéraires
          </a>
        </div>
      </div>

      <a href="{{ route('apropos') }}" 
         class="{{ request()->routeIs('apropos') ? 'text-red-500' : 'hover:text-blue-400' }} transition-colors">
         À propos
      </a>
      <a href="{{ route('Contacts') }}" 
         class="{{ request()->routeIs('Contacts') ? 'text-red-500' : 'hover:text-blue-400' }} transition-colors">
         Contacts
      </a>
      <a href="{{ route('participer') }}" 
         class="{{ request()->routeIs('participer') ? 'text-red-500' : 'hover:text-blue-400' }} transition-colors">
         Participer
      </a>
    </div>

    <!-- Partie droite (profil + menu hamburger) -->
    <div class="flex items-center gap-1">
      
      <!-- Icône de profil : visible tant que le menu mobile n’est pas ouvert -->
      <div x-show="!mobileOpen" class="relative" x-data="{ profilOpen: false }">
        <button @click="profilOpen = !profilOpen" class="text-white text-2xl focus:outline-none">
          <i class="bi bi-person-circle"></i>
        </button>

        <!-- Menu profil -->
        <div x-show="profilOpen" @click.away="profilOpen = false" x-transition
             class="absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg py-2 z-50 text-gray-800">
          @guest
            <a href="{{ route('login') }}" class="block px-4 py-2 hover:bg-blue-100">Connexion</a>
            @if (Route::has('register'))
              <a href="{{ route('register') }}" class="block px-4 py-2 hover:bg-blue-100 border-t">S’inscrire</a>
            @endif
          @else
            @hasrole('admin')
              <a href="{{ url('/welcome') }}" class="block px-4 py-2 text-red-600 font-serif font-bold hover:bg-gray-100">Tableau de bord</a>
            @endhasrole
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 font-bold hover:bg-red-100 border-t">
                Déconnexion
              </button>
            </form>
          @endguest
        </div>
      </div>

      <!-- Bouton Menu hamburger -->
      <button @click="mobileOpen = !mobileOpen" 
              class="md:hidden text-white focus:outline-none">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path :class="{ 'hidden': mobileOpen, 'inline-flex': !mobileOpen }" 
                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                d="M4 6h16M4 12h16M4 18h16" />
          <path :class="{ 'hidden': !mobileOpen, 'inline-flex': mobileOpen }" 
                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>

    </div>
  </div>

  <!-- Menu mobile déroulant -->
  <div x-show="mobileOpen" x-transition class="md:hidden mt-4 flex flex-col gap-3 items-center">
    <a @click="mobileOpen = false" href="{{ route('accueil') }}" class="font-serif uppercase text-sm hover:text-blue-400">Accueil</a>
    <a @click="mobileOpen = false" href="{{ route('site_touristique') }}" class="font-serif uppercase text-sm hover:text-blue-400">Sites Touristiques</a>

    <!-- Sous-menu mobile -->
    <div x-data="{ open: false }" class="w-full flex flex-col items-center">
      <button @click="open = !open" class="w-full text-center font-serif uppercase text-sm flex items-center justify-center gap-2 hover:text-blue-400">
        Événements
        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </button>
      <div x-show="open" x-transition class="flex flex-col gap-2 mt-2 text-gray-200">
        <a href="{{ route('evenements') }}" class="hover:text-blue-400 text-sm">Voir tous les événements</a>
        <a href="{{ route('itineraire.offres') }}" class="hover:text-blue-400 text-sm">Les offres d’itinéraires</a>
      </div>
    </div>

    <a href="{{ route('apropos') }}" class="font-serif uppercase text-sm hover:text-blue-400">À propos</a>
    <a href="{{ route('Contacts') }}" class="font-serif uppercase text-sm hover:text-blue-400">Contacts</a>
    <a href="{{ route('participer') }}" class="font-serif uppercase text-sm hover:text-blue-400">Participer</a>
  </div>
</nav>



<!-- MAIN -->
<main class="min-h-screen">
    @yield('contenu')
</main>
<!-- FOOTER -->
<!-- FOOTER PROFESSIONNEL -->
<footer class="bg-gray-900 text-gray-300 py-10 px-6 md:px-16 lg:px-24">
  <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-10 items-start">

    <!-- Colonne Logo / Description -->
    <div class="flex flex-col items-center md:items-start text-center md:text-left space-y-4">
      <img 
        src="{{ asset('image/logo3.jpg') }}" 
        alt="Logo Toche" 
        class="h-16 w-16 md:h-20 md:w-20 object-contain rounded-full shadow-lg hover:scale-110 transition-transform duration-300"
      />
      <p class="text-sm md:text-base font-serif leading-relaxed text-gray-400">
        <span class="text-white font-semibold">Toché</span> — votre passerelle vers la découverte du Bénin 🇧🇯.<br>
        Explorez les sites touristiques, réservez vos événements, et vivez l’expérience autrement.
      </p>
    </div>

    <!-- Colonne Contact -->
    <div class="flex flex-col items-center md:items-start text-center md:text-left space-y-4">
      <h2 class="text-lg md:text-xl font-bold text-white uppercase tracking-wide border-b border-gray-700 pb-1">Contact</h2>
      <div class="space-y-1 text-sm md:text-base">
        <a href="tel:+2290165103959" class="block hover:text-blue-400 transition-colors">📞 +229 01 65 10 39 59</a>
        <a href="tel:+2290169580603" class="block hover:text-blue-400 transition-colors">📞 +229 01 69 58 06 03</a>
      </div>
      <div class="flex items-center justify-center md:justify-start space-x-5 mt-3">
        <a href="#"><img class="w-6 h-6 md:w-7 md:h-7 hover:scale-110 transition-transform rounded" src="{{ asset('/image/facebook2.jpeg') }}" alt="Facebook" /></a>
        <a href="#"><img class="w-6 h-6 md:w-7 md:h-7 hover:scale-110 transition-transform rounded" src="{{ asset('/image/instagram2.jpeg') }}" alt="Instagram" /></a>
        <a href="#"><img class="w-6 h-6 md:w-7 md:h-7 hover:scale-110 transition-transform rounded" src="{{ asset('/image/twiter2.png') }}" alt="Twitter" /></a>
      </div>
    </div>

    <!-- Colonne Adresse -->
    <div class="flex flex-col items-center md:items-start text-center md:text-left space-y-4">
      <h2 class="text-lg md:text-xl font-bold text-white uppercase tracking-wide border-b border-gray-700 pb-1">Adresse</h2>
      <p class="text-sm md:text-base leading-relaxed text-gray-400">
        Godomey Togoudo, Abomey-Calavi, Bénin
      </p>
      <a href="https://www.google.com/maps/place/TFG+SARL" 
         target="_blank" 
         class="inline-flex items-center justify-center md:justify-start gap-2 mt-2 text-sm md:text-base text-blue-400 hover:text-blue-300 transition-colors">
        <img class="w-5 h-5 md:w-6 md:h-6" src="{{ asset('/image/localisation2.jpg') }}" alt="Localisation" />
        <span>Voir sur Google Maps</span>
      </a>
    </div>
  </div>

  <!-- Ligne du bas -->
  <div class="border-t border-gray-700 mt-10 pt-6 text-center text-sm md:text-base text-gray-500">
    © 2025 <span class="text-white font-semibold">TFG - Technology Forever Group</span> · Tous droits réservés.
  </div>
</footer>


<script src="//unpkg.com/alpinejs" defer></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {
  const lazyImages = document.querySelectorAll("img.lazy-img");
  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const img = entry.target;
          img.src = img.dataset.src;
          img.addEventListener('load', () => { img.classList.add('loaded'); });
          observer.unobserve(img);
        }
      });
    }, { rootMargin: "0px 0px 200px 0px", threshold: 0.1 });
    lazyImages.forEach(img => observer.observe(img));
  } else {
    lazyImages.forEach(img => { img.src = img.dataset.src; img.classList.add('loaded'); });
  }
});
</script>
