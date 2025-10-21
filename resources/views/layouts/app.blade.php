<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Token CSRF pour sécuriser les requêtes POST -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'Toché.bj')</title>

    <!-- Polices et icônes -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}" />

    <!-- mes vites e, production -->
    <link rel="stylesheet" href="{{ Vite::asset('resources/sass/app.scss') }}">
    
    <!-- Bibliothèque SweetAlert2 pour les alertes stylées -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Inclusion des assets générés par Vite (CSS & JS de Laravel Mix ou Vite) -->
<!-- Inclusion des assets générés par Vite (CSS & JS de Laravel Mix ou Vite) -->
<link rel="stylesheet" href="{{ Vite::asset('resources/sass/app.scss') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      /* Style de l'overlay du loader : fond noir transparent, bloque toute la page */
      #loader-overlay {
        position: fixed; /* Fixé par-dessus tout */
        inset: 0; /* Top, right, bottom, left à 0 */
        background: rgba(0, 0, 0, 0.7); /* noir avec opacité 70% */
        display: flex; /* on utilise flexbox pour centrer */
        justify-content: center; /* centre horizontalement */
        align-items: center; /* centre verticalement */
        z-index: 9999; /* au-dessus de tout */
        display: none; /* invisible par défaut */
      }

      /* Carte au centre de l'overlay : fond noir plus opaque + arrondi + ombre */
      #loader-card {
        background: rgba(20, 20, 20, 0.9); /* noir presque opaque */
        padding: 2rem 3rem; /* espace interne généreux */
        border-radius: 12px; /* coins arrondis */
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.6); /* ombre douce */
        display: flex;
        flex-direction: column; /* vertical */
        align-items: center; /* centré horizontalement */
      }

      /* Style du spinner blanc (roue qui tourne) */
      .loader {
        border: 6px solid rgba(255, 255, 255, 0.2); /* bord clair */
        border-top: 6px solid #ffffff; /* bord du haut blanc */
        border-radius: 50%; /* forme ronde */
        width: 48px; /* largeur */
        height: 48px; /* hauteur */
        animation: spin 1s linear infinite; /* animation rotation infinie */
        margin-bottom: 1rem; /* espace sous le spinner */
      }

      /* Animation rotation */
      @keyframes spin {
        0% { transform: rotate(0deg);}
        100% { transform: rotate(360deg);}
      }

      /* Texte "Chargement..." en blanc, gras et taille correcte */
      #loader-text {
        color: white;
        font-weight: 600;
        font-size: 1.1rem;
      }
    </style>
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">

        <!-- Overlay loader : visible seulement quand on charge -->
        <div id="loader-overlay" aria-hidden="true" aria-label="Chargement en cours">
          <div id="loader-card" role="alert" aria-live="assertive">
            <div class="loader"></div> <!-- Spinner animé -->
            <div id="loader-text">Chargement...</div> <!-- Texte -->
          </div>
        </div>
      
        {{-- Inclusion des parties communes : header, sidebar, footer --}}
        @include('layouts.header')
        @include('layouts.sidebar')
        
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                {{ session('error') }}
            </div>
        @endif
        <!-- Contenu principal de la page -->
        <main class="app-main">
            @yield('content')
        </main>

        @include('layouts.footer')
    </div>

    <!-- Scripts externes (plugins JS) -->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>

    <!-- Configuration OverlayScrollbars -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebarWrapper = document.querySelector('.sidebar-wrapper');
            // Si sidebar existe et OverlayScrollbars est chargé
            if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: 'os-theme-light',
                        autoHide: 'leave',
                        clickScroll: true,
                    },
                });
            }
        });
    </script>

    <!-- Confirmation suppression avec SweetAlert2 -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // On cible tous les formulaires contenant un input _method=DELETE (suppression)
            const deleteForms = Array.from(document.querySelectorAll('form')).filter(form => {
                const methodInput = form.querySelector('input[name="_method"]');
                return methodInput && methodInput.value.toUpperCase() === 'DELETE';
            });

            deleteForms.forEach(form => {
                form.addEventListener('submit', e => {
                    e.preventDefault(); // On bloque la soumission

                    // On affiche l'alerte SweetAlert2
                    Swal.fire({
                        title: 'Es-tu sûr ?',
                        text: "Cette action est irréversible !",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33', // rouge vif
                        cancelButtonColor: '#3085d6', // bleu
                        confirmButtonText: 'Oui, supprime !',
                        cancelButtonText: 'Annuler'
                    }).then(result => {
                        if (result.isConfirmed) {
                            form.submit(); // Si OK, on soumet
                        }
                    });
                });
            });
        });
    </script>

    <!-- Affichage du loader lors du clic sur un lien interne ou lors du départ de la page -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const loader = document.getElementById('loader-overlay');

            // Pour chaque lien sur la page
            document.querySelectorAll('a[href]').forEach(link => {
                link.addEventListener('click', e => {
                    // Ignorer liens externes, ouverture dans un nouvel onglet ou ancres (#)
                    if (
                        link.target === '_blank' ||
                        link.href.indexOf(window.location.origin) !== 0 ||
                        link.getAttribute('href').startsWith('#')
                    ) return;

                    e.preventDefault(); // On bloque l'action standard du lien
                    loader.style.display = 'flex'; // On affiche le loader

                    // On attend 300ms avant de rediriger (pour voir le loader)
                    setTimeout(() => {
                        window.location.href = link.href;
                    }, 300);
                });
            });

            // Quand on quitte la page (ex: refresh, fermeture onglet)
            window.addEventListener('beforeunload', () => {
                loader.style.display = 'flex'; // On affiche le loader
            });
        });
    </script>
<!-- mon vite js -->
 <script type="module" src="{{ Vite::asset('resources/js/app.js') }}"></script>

    @stack('scripts')
    <!-- compilation de mes vite js -->
    <script type="module" src="{{ Vite::asset('resources/js/app.js') }}"></script>

</body>
</html>
