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

 $isSuperAdmin = Auth::check() && (
        Auth::user()->id === 1 ||
        Auth::user()->email === 'gbedebernard60@gmail.com'
    );
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

             @if ($isSuperAdmin)
                <li class="nav-item {{ $openRoles ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link text-white {{ $openRoles ? 'bg-gray-700' : '' }}">
                        <i class="nav-icon bi bi-table text-blue-400"></i>
                        <p>Gestion_Roles <i class="nav-arrow bi bi-chevron-right ms-auto"></i></p>
                    </a>
                    <ul class="nav nav-treeview ps-4" style="{{ $openRoles ? 'display: block;' : 'display: none;' }}">
                     
                    @hasrole('isSuperAdmin')
                        <li class="nav-item">
                            <a href="{{ route('admin.roles.index') }}" class="nav-link {{ request()->routeIs('admin.roles.index') ? 'text-blue-400' : 'text-gray-300' }}">
                                <i class="nav-icon bi bi-circle text-yellow-400"></i> Roles et permissions
                            </a>
                        </li>
                        @endhasrole
                    </ul>
                </li>
             @endif

                <!-- Entités -->
                <li class="nav-item {{ $openEntity ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link text-white {{ $openEntity ? 'bg-gray-700' : '' }}">
                        <i class="nav-icon  bi bi-gear text-gray-100"></i>
                        <p>Entité <i class="nav-arrow bi bi-chevron-right ms-auto"></i></p>
                    </a>
                  <ul class="nav nav-treeview ps-4 space-y-1" style="{{ $openEntity ? 'display: block;' : 'display: none;' }}">

 {{-- 🗂️ Catégories --}}
    <li class="nav-item">
        <a href="{{ route('indexcategorie') }}" 
           class="nav-link flex items-center gap-3 {{ request()->routeIs('indexcategorie') ? 'text-indigo-400' : 'text-gray-300' }}">
            <i class="bi bi-folder text-gray-100"></i>
            <span class="text-white hover:text-indigo-400 transition-colors">Catégories</span>
        </a>
    </li>
    {{-- 🏛️ Sites touristiques --}}
    <li class="nav-item">
        <a href="{{ route('index') }}" 
           class="nav-link flex items-center gap-3 {{ request()->routeIs('index') ? 'text-indigo-400' : 'text-gray-300' }}">
            <i class="bi bi-folder2 text-gray-100"></i>
            <span class="text-white hover:text-indigo-400 transition-colors">Sites touristiques</span>
        </a>
    </li>

    {{-- 🎉 Évènements --}}
    <li class="nav-item">
        <a href="{{ route('indexevenements') }}" 
           class="nav-link flex items-center gap-3 {{ request()->routeIs('indexevenements') ? 'text-indigo-400' : 'text-gray-300' }}">
            <i class="bi bi-folder2 text-gray-100"></i>
            <span class="text-white hover:text-indigo-400 transition-colors">Évènements</span>
        </a>
    </li>
{{-- ℹ️ À propos --}}
    <li class="nav-item">
        <a href="{{ route('admin.apropos.index') }}" 
           class="nav-link flex items-center gap-3 {{ request()->routeIs('admin.apropos.index') ? 'text-indigo-400' : 'text-gray-300' }}">
            <i class="bi bi-folder2 text-gray-100"></i>
            <span class="text-white hover:text-indigo-400 transition-colors">À propos</span>
        </a>
    </li>
    {{-- 🏨 Hotels & Restauration --}}
    <li class="nav-item">
        <a href="{{ route('admin.hotels.index') }}" 
           class="nav-link flex items-center gap-3 {{ request()->routeIs('admin.hotels.index') ? 'text-indigo-400' : 'text-gray-300' }}">
            <i class="bi  bi-hospital text-gray-100"></i>
            <span class="text-white hover:text-indigo-400 transition-colors">Hotels & Restauration</span>
        </a>
    </li>
    {{-- 🖼️ Galeries --}}
    <li class="nav-item">
        <a href="{{ route('galeries.index') }}" 
           class="nav-link flex items-center gap-3 {{ request()->routeIs('galeries.index') ? 'text-indigo-400' : 'text-gray-300' }}">
            <i class="bi bi-images text-gray-100"></i>
            <span class="text-white hover:text-indigo-400 transition-colors">Galeries</span>
        </a>
    </li>
   {{-- 👁️ Visites --}}
    <li class="nav-item">
        <a href="{{ route('indexvisites') }}" 
           class="nav-link flex items-center gap-3 {{ request()->routeIs('indexvisites') ? 'text-indigo-400' : 'text-gray-300' }}">
            <i class="bi bi-eye text-gray-100"></i>
            <span class="text-white hover:text-indigo-400 transition-colors">Visites</span>
        </a>
    </li>

    {{-- 🎟️ Réservations --}}
    <li class="nav-item">
        <a href="{{ route('admin.reservations.index') }}" 
           class="nav-link flex items-center gap-3 {{ request()->routeIs('admin.reservations.index') ? 'text-indigo-400' : 'text-gray-300' }}">
            <i class="bi bi-handbag text-gray-100"></i>
            <span class="text-white hover:text-indigo-400 transition-colors">Réservations</span>
        </a>
    </li>

    {{-- 💬 Contacts --}}
    <li class="nav-item">
        <a href="{{ route('contact.liste') }}" 
           class="nav-link flex items-center gap-3 {{ request()->routeIs('contact.liste') ? 'text-indigo-400' : 'text-gray-300' }}">
            <i class="bi bi-envelope text-gray-100"></i>
            <span class="text-white hover:text-indigo-400 transition-colors">Contacts</span>
        </a>
    </li>

 {{-- 🗣️ Avis des utilisateurs --}}
    <li class="nav-item">
        <a href="{{ route('Admin.Avis.index') }}" 
           class="nav-link flex items-center gap-3 {{ request()->routeIs('Admin.Avis.index') ? 'text-indigo-400' : 'text-gray-300' }}">
            <i class="bi bi-chat-dots text-gray-100"></i>
            <span class="text-white hover:text-indigo-400 transition-colors">Avis des utilisateurs</span>
        </a>
    </li>

    {{-- 🎫 Tickets --}}
    <li class="nav-item">
        <a href="{{ route('indextickets') }}" 
           class="nav-link flex items-center gap-3 {{ request()->routeIs('indextickets') ? 'text-indigo-400' : 'text-gray-300' }}">
            <i class="bi bi-qr-code text-gray-100"></i>
            <span class="text-white hover:text-indigo-400 transition-colors">Tickets</span>
        </a>
    </li>

 {{-- 💳 Paiements --}}
    <li class="nav-item">
        <a href="{{ route('paiement.index') }}" 
           class="nav-link flex items-center gap-3 {{ request()->routeIs('paiement.index') ? 'text-indigo-400' : 'text-gray-300' }}">
            <i class="bibi bi-coin text-gray-100"></i>
            <span class="text-white hover:text-indigo-400 transition-colors">Paiements</span>
        </a>
    </li>
 {{-- 🪪 Pièces d'identité --}}
    <li class="nav-item">
        <a href="{{ route('piece.index') }}" 
           class="nav-link flex items-center gap-3 {{ request()->routeIs('piece.index') ? 'text-indigo-400' : 'text-gray-300' }}">
            <i class="bi bi-person-vcard text-gray-100"></i>
            <span class="text-white hover:text-indigo-400 transition-colors">Pièces d'identité</span>
        </a>
    </li>
    {{-- 👥 Utilisateurs --}}
    <li class="nav-item">
        <a href="{{ route('indexusers') }}" 
           class="nav-link flex items-center gap-3 {{ request()->routeIs('indexusers') ? 'text-indigo-400' : 'text-gray-300' }}">
            <i class="bi bi-people text-gray-100"></i>
            <span class="text-white hover:text-indigo-400 transition-colors">Utilisateurs</span>
        </a>
    </li>

    {{-- ❓ FAQs --}}
    <li class="nav-item">
        <a href="{{ route('admin.faqs.index') }}" 
           class="nav-link flex items-center gap-3 {{ request()->routeIs('admin.faqs.index') ? 'text-indigo-400' : 'text-gray-300' }}">
            <i class="bi bi-question-circle text-orange-400"></i>
            <span class="text-white hover:text-indigo-400 transition-colors">FAQs</span>
        </a>
    </li>

    {{-- 📰 Newsletters --}}
    <li class="nav-item">
        <a href="{{ route('admin.newsletters.index') }}" 
           class="nav-link flex items-center gap-3 {{ request()->routeIs('admin.newsletters.index') ? 'text-indigo-400' : 'text-gray-300' }}">
            <i class="bi bi-newspaper text-red-400"></i>
            <span class="text-white hover:text-indigo-400 transition-colors">Newsletters</span>
        </a>
    </li>

</ul>

                </li>

                <!-- Détail des Paragraphes -->
                <li class="nav-item {{ $openDetails ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link text-white {{ $openDetails ? 'bg-gray-700' : '' }}">
                        <i class="nav-icon bi bi-send-plus text-yellow-400"></i>
                        <p>Détail_Sites <i class="nav-arrow bi bi-chevron-right ms-auto"></i></p>
                    </a>
                    <ul class="nav nav-treeview ps-4" style="{{ $openDetails ? 'display: block;' : 'display: none;' }}">
                        <!-- Sites -->
                        <li class="nav-item">
                            <a href="#" class="nav-link text-gray-300 hover:text-blue-400">
                                <i class="nav-icon bi-folder2 text-blue-400"></i> Sites Touristiques
                            </a>
                            <ul class="gap-3 nav nav-treeview ps-4" style="display: {{ request()->routeIs('admin.details.*') ? 'block' : 'none' }};">
                                @foreach(App\Models\Site_touristique::all() as $site)
                                    <li class="nav-item">
                                        <a href="{{ route('admin.details.index', ['site_id' => $site->id]) }}"
                                           class="gap-3 nav-link {{ request()->fullUrlIs(route('admin.details.index', ['site_id' => $site->id])) ? 'text-blue-400' : 'text-gray-300' }}">
                                            <i class="bi bi-circle-fill text-green-400" style="font-size: 0.5rem;"></i> {{ $site->nom }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>

                        <!-- Événements -->
                        <li class="nav-item">
                            <a href="#" class="nav-link text-gray-300 hover:text-blue-400">
                                <i class="nav-icon bi bi-folder2 text-blue-400"></i> Événements
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
                    <a href="#" class="gap-3 nav-link text-white {{ $openOffres ? 'bg-gray-700' : '' }}">
                        <i class="nav-icon bi bi-airplane-fill text-indigo-400"></i>
                        <p>Offres_voyages <i class="nav-arrow bi bi-chevron-right ms-auto"></i></p>
                    </a>
                    <ul class="nav nav-treeview ps-4" style="{{ $openOffres ? 'display: block;' : 'display: none;' }}">
                        <li class="nav-item">
                            <a href="{{ route('agence.index') }}" class="gap-3 nav-link {{ request()->routeIs('agence.index') ? 'text-blue-400' : 'text-gray-300' }}">
                                <i class="bi bi-house-add-fill text-gray-100 "></i> Agence_voyage
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('itineraire.index') }}" class="gap-3 nav-link {{ request()->routeIs('agence.index') ? 'text-blue-400' : 'text-gray-300' }}">
                                <i class="bi bi-lightning-charge text-gray-100"></i>
                                  Itinéraire
                            </a>
                        </li> <li class="nav-item">
                            <a href="{{ route('itineraire_site.index') }}" class="gap-3 nav-link {{ request()->routeIs('agence.index') ? 'text-blue-400' : 'text-gray-300' }}">
                                <i class="bi bi-lightning-charge text-gray-100"></i> Itinéraire_Site
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Mon Profil -->
                <li class=" nav-item {{ $openProfile ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link text-white {{ $openProfile ? 'bg-gray-700' : '' }}">
                        <i class="nav-icon bi bi-person-fill-gear text-cyan-400"></i>
                        <p>Mon Profil <i class="nav-arrow bi bi-chevron-right ms-auto"></i></p>
                    </a>
                    <ul class="nav nav-treeview ps-4 " style="{{ $openProfile ? 'display: block;' : 'display: none;' }}">
                        <li class="nav-item">
                            <a href="{{ route('profile') }}" class="gap-3 nav-link {{ request()->routeIs('profile.show') ? 'text-blue-400' : 'text-gray-300' }}">
                                <i class="bi bi-person-fill text-green-400"></i> Voir mon profil
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('profile.edit') }}" class="gap-3 nav-link {{ request()->routeIs('profile.edit') ? 'text-blue-400' : 'text-gray-300' }}">
                                <i class="bi bi-pencil-square text-yellow-400"></i> Modifier mon profil
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('profile.password.edit') }}#changer-mdp" class="gap-3 nav-link text-gray-300 hover:text-red-500">
                                <i class="bi bi-key-fill text-red-500"></i> Changer mot de passe
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('profile.delete.confirm') }}#suppression" class="gap-3 nav-link text-gray-300 hover:text-red-600">
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
