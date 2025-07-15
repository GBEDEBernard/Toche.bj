@php
    $currentRoute = request()->route()->getName();

    $openOffres = str_starts_with($currentRoute, 'agence.');
    $openDetails = request()->routeIs('admin.details.*') || request()->routeIs('admin.paragraphes.*');

    $entiteRoutes = [
        'Admin.Avis.index', 'index', 'indexevenements', 'admin.hotels.index', 'admin.reservations.index',
        'indexvisites', 'galeries.index', 'indextickets', 'indexcategorie', 'indexusers', 'paiement.index',
        'piece.index', 'contact.liste', 'admin.apropos.index', 'admin.faqs.index', 'admin.newsletters.index'
    ];
    $openEntity = !$openOffres && in_array($currentRoute, $entiteRoutes);

    $openRoles = request()->routeIs('admin.roles.*');
    $openProfile = request()->routeIs('profile.*') || request()->is('profile/edit*');
@endphp

<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!-- Logo -->
    <div class="sidebar-brand py-4">
        <a href="{{ route('welcome') }}" class="brand-link flex items-center gap-2">
            <img src="/image/logo3.jpg" alt="Toché Logo" class="brand-image w-10 h-10 opacity-75 shadow rounded-full hover:scale-105 transition-transform duration-300" />
            <span class="brand-text font-serif font-bold text-lg md:text-xl text-white tracking-tight uppercase">Toché le Bénin</span>
        </a>
    </div>

    <!-- Navigation -->
    <div class="sidebar-wrapper overflow-y-auto max-h-screen">
        <nav class="mt-4">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <!-- Gestion des Rôles -->
                <li class="nav-item {{ $openRoles ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link text-white {{ $openRoles ? 'bg-gray-700' : '' }}">
                        <i class="nav-icon bi bi-table text-blue-400"></i>
                        <p>Gestion_Roles <i class="nav-arrow bi bi-chevron-right ms-auto"></i></p>
                    </a>
                    <ul class="nav nav-treeview ps-4" style="{{ $openRoles ? 'display: block;' : 'display: none;' }}">
                        @hasrole('admin')
                        <li class="nav-item">
                            <a href="{{ route('admin.roles.index') }}" class="nav-link {{ request()->routeIs('admin.roles.index') ? 'text-blue-400' : 'text-gray-300' }}">
                                <i class="nav-icon bi bi-circle text-yellow-400"></i> Roles et permissions
                            </a>
                        </li>
                        @endhasrole
                    </ul>
                </li>

                <!-- Entités -->
                <li class="nav-item {{ $openEntity ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link text-white {{ $openEntity ? 'bg-gray-700' : '' }}">
                        <i class="nav-icon bi bi-grid-fill text-red-400"></i>
                        <p>Entité <i class="nav-arrow bi bi-chevron-right ms-auto"></i></p>
                    </a>
                    <ul class="nav nav-treeview ps-4" style="{{ $openEntity ? 'display: block;' : 'display: none;' }}">
                        @php
                            $entites = [
                                ['route' => 'Admin.Avis.index', 'label' => 'Avis des utilisateurs'],
                                ['route' => 'index', 'label' => 'Les Sites touristiques'],
                                ['route' => 'indexevenements', 'label' => 'Les Évènements'],
                                ['route' => 'admin.hotels.index', 'label' => 'Hotels & Restauration'],
                                ['route' => 'admin.reservations.index', 'label' => 'Les Réservations'],
                                ['route' => 'indexvisites', 'label' => 'Les Visites'],
                                ['route' => 'galeries.index', 'label' => 'Les Galeries'],
                                ['route' => 'indextickets', 'label' => 'Les Tickets'],
                                ['route' => 'indexcategorie', 'label' => 'Les Catégories'],
                                ['route' => 'indexusers', 'label' => 'Utilisateurs'],
                                ['route' => 'paiement.index', 'label' => 'Paiements'],
                                ['route' => 'piece.index', 'label' => "Pièces d'identité"],
                                ['route' => 'contact.liste', 'label' => 'Les Contacts'],
                                ['route' => 'admin.apropos.index', 'label' => 'À propos'],
                                ['route' => 'admin.faqs.index', 'label' => 'FAQs'],
                                ['route' => 'admin.newsletters.index', 'label' => 'Newsletters'],
                            ];
                        @endphp
                        @foreach($entites as $entite)
                            <li class="nav-item">
                                <a href="{{ route($entite['route']) }}" class="nav-link {{ request()->routeIs($entite['route']) ? 'text-blue-400' : 'text-gray-300' }}">
                                    <i class="nav-icon bi bi-circle text-green-400"></i> {{ $entite['label'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                <!-- Détail des Paragraphes -->
                <li class="nav-item {{ $openDetails ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link text-white {{ $openDetails ? 'bg-gray-700' : '' }}">
                        <i class="nav-icon bi bi-info-circle-fill text-yellow-400"></i>
                        <p>Détail_Sites <i class="nav-arrow bi bi-chevron-right ms-auto"></i></p>
                    </a>
                    <ul class="nav nav-treeview ps-4" style="{{ $openDetails ? 'display: block;' : 'display: none;' }}">
                        <!-- Sites -->
                        <li class="nav-item">
                            <a href="#" class="nav-link text-gray-300 hover:text-blue-400">
                                <i class="nav-icon bi bi-geo-alt text-blue-400"></i> Sites Touristiques
                            </a>
                            <ul class="nav nav-treeview ps-4" style="display: {{ request()->routeIs('admin.details.*') ? 'block' : 'none' }};">
                                @foreach(App\Models\Site_touristique::all() as $site)
                                    <li class="nav-item">
                                        <a href="{{ route('admin.details.index', ['site_id' => $site->id]) }}"
                                           class="nav-link {{ request()->fullUrlIs(route('admin.details.index', ['site_id' => $site->id])) ? 'text-blue-400' : 'text-gray-300' }}">
                                            <i class="bi bi-circle-fill text-green-400" style="font-size: 0.5rem;"></i> {{ $site->nom }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>

                        <!-- Événements -->
                        <li class="nav-item">
                            <a href="#" class="nav-link text-gray-300 hover:text-blue-400">
                                <i class="nav-icon bi bi-calendar-event text-blue-400"></i> Événements
                            </a>
                            <ul class="nav nav-treeview ps-4" style="display: {{ request()->routeIs('admin.paragraphes.*') ? 'block' : 'none' }};">
                                @foreach(App\Models\Evenement::all() as $evenement)
                                    <li class="nav-item">
                                        <a href="{{ route('admin.paragraphes.index', ['evenement_id' => $evenement->id]) }}"
                                           class="nav-link {{ request()->fullUrlIs(route('admin.paragraphes.index', ['evenement_id' => $evenement->id])) ? 'text-blue-400' : 'text-gray-300' }}">
                                            <i class="bi bi-circle-fill text-green-400" style="font-size: 0.5rem;"></i> {{ $evenement->nom }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </li>

                <!-- Agences -->
                <li class="nav-item {{ $openOffres ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link text-white {{ $openOffres ? 'bg-gray-700' : '' }}">
                        <i class="nav-icon bi bi-airplane-fill text-green-600"></i>
                        <p>Offres_voyages <i class="nav-arrow bi bi-chevron-right ms-auto"></i></p>
                    </a>
                    <ul class="nav nav-treeview ps-4" style="{{ $openOffres ? 'display: block;' : 'display: none;' }}">
                        <li class="nav-item">
                            <a href="{{ route('agence.index') }}" class="nav-link {{ request()->routeIs('agence.index') ? 'text-blue-400' : 'text-gray-300' }}">
                                <i class="bi bi-car-front-fill text-green-500"></i> Agence_voyage
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('itineraire.index') }}" class="nav-link {{ request()->routeIs('agence.index') ? 'text-blue-400' : 'text-gray-300' }}">
                                <i class="bi bi-car-front-fill text-green-500"></i>
 Itinéraire
                            </a>
                        </li> <li class="nav-item">
                            <a href="{{ route('itineraire_site.index') }}" class="nav-link {{ request()->routeIs('agence.index') ? 'text-blue-400' : 'text-gray-300' }}">
                                <i class="bi bi-car-front-fill text-green-500"></i> Itinéraire_Site
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Mon Profil -->
                <li class="nav-item {{ $openProfile ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link text-white {{ $openProfile ? 'bg-gray-700' : '' }}">
                        <i class="nav-icon bi bi-person-circle text-cyan-400"></i>
                        <p>Mon Profil <i class="nav-arrow bi bi-chevron-right ms-auto"></i></p>
                    </a>
                    <ul class="nav nav-treeview ps-4" style="{{ $openProfile ? 'display: block;' : 'display: none;' }}">
                        <li class="nav-item">
                            <a href="{{ route('profile') }}" class="nav-link {{ request()->routeIs('profile.show') ? 'text-blue-400' : 'text-gray-300' }}">
                                <i class="bi bi-person-lines-fill text-green-400"></i> Voir mon profil
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.edit') ? 'text-blue-400' : 'text-gray-300' }}">
                                <i class="bi bi-pencil-fill text-yellow-400"></i> Modifier mon profil
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('profile.password.edit') }}#changer-mdp" class="nav-link text-gray-300 hover:text-red-500">
                                <i class="bi bi-key-fill text-red-500"></i> Changer mot de passe
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('profile.delete.confirm') }}#suppression" class="nav-link text-gray-300 hover:text-red-600">
                                <i class="bi bi-trash-fill text-red-600"></i> Supprimer compte
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>
</aside>
<!--end::Sidebar-->
