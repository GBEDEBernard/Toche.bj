<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toche.bj</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

    <!-- NAVIGATION -->
    <nav class="bg-black text-white flex flex-col md:flex-row items-center justify-between p-4">
        
        <!-- Logo -->
        <div class="h-16 flex justify-center mb-4">
            <a  href="{{ route('accueil') }}">
                <img class="w-24 h-24 p-2  rounded-full" src="{{ asset('image/logo3.jpg')}}" alt="Toché">
            </a>
        </div>
        <!-- Menu -->
        <div class="flex flex-wrap justify-center md:justify-between items-center gap-x-4 mt-4 md:mt-0">
          <a class="hover:text-red-700" href="{{ route('accueil') }}">ACCUEIL</a>
             <a class="hover:text-red-700" href="{{ route('site_touristique') }}">SITE TOURISTIQUES</a>
             <a class="hover:text-red-700" href="{{ route('evenements') }}">ÉVÉNEMENTS</a>
             <a class="hover:text-red-700" href="{{ route('apropos') }}">À PROPOS</a>
             <a class="hover:text-red-700" href="{{ route('Contacts') }}">CONTACTS</a>
             <a class="hover:text-red-700" href="{{ route('participer') }}">PARTICIPER</a>
     </div>


        <!-- Boutons Enregistrer / Connexion -->
        <div class="flex gap-x-4 mt-4 md:mt-0">
            <a href="{{route('register')}}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 transition">
                Créer un compte
            </a>
            <a href="login" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700 transition">
                Connexion
            </a>
        </div>
        
    </nav>

    <!-- Contenu principal -->
    <div>
        @yield('contenu')
    </div>

    <!-- FOOTER -->
    <footer class="flex flex-col md:flex-row justify-between p-4 bg-black text-white mt-10">
        
        <!-- Description -->
        <div class="max-w-sm">
            <p class="text-base md:text-xl lg:text-2xl font-semibold text-justify pr-2 pt-2 hover:text-blue-500 transition">
                TOCHE, LA PLATEFORME DE GESTION DES SITES TOURISTIQUES & ÉVÉNEMENTS DU BÉNIN
            </p>
        </div>

        <!-- Contacts -->
        <div class="mt-4 md:mt-0">
            <p>Contactez-nous :</p>
            <a href="tel:+2290165103959">+229 0165 10 39 59</a> <br>
            <a href="tel:+2290169580603">+229 0169 58 06 03</a> <br>
            <a href="#">Afficher les contacts</a>

            <div class="flex space-x-4 mt-2">
                <a href="#"><img class="w-6" src="{{ asset('/image/facebook2.jpeg')}}" alt="Facebook"></a>
                <a href="#"><img class="w-6" src="{{ asset('/image/instagram2.jpeg')}}" alt="Instagram"></a>
                <a href="#"><img class="w-6" src="{{ asset('/image/twiter2.png')}}" alt="Twitter"></a>
            </div>
        </div>

        <!-- Adresse -->
        <div class="mt-4 md:mt-0">
            <p class="text-cyan-500">
                2024 © TFG - Technology Forever Group · Tous droits réservés.
            </p>
            <a href="https://www.google.com/maps/place/TFG+SARL">
                <img class="w-8" src="{{ asset('/image/localisation2.jpg')}}" alt="Localisation"> Adresse
            </a>
            <p>Godomey Togoudo, Abomey-Calavi, Bénin</p>
        </div>

    </footer>

</body>
</html>
