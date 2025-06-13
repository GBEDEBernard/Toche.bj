<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand py-4">
        <a href="{{ route('welcome') }}" class="brand-link flex items-center gap-2">
            <img src="/image/logo3.jpg" alt="Toché Logo" class="brand-image w-10 h-10 opacity-75 shadow rounded-full hover:scale-105 transition-transform duration-300" />
            <span class="brand-text font-serif font-bold text-lg md:text-xl text-white tracking-tight uppercase">Toché le Bénin</span>
        </a>
    </div>
    <!--end::Sidebar Brand-->
  
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-4">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
  
                <!-- Les Roles -->
                <li class="nav-item">
                    <a href="#" class="nav-link flex items-center gap-2 font-serif font-semibold text-sm md:text-base uppercase tracking-tight text-white hover:bg-gray-700 transition-colors duration-300">
                        <i class="nav-icon bi bi-table text-blue-400"></i>
                        <p>Gestion_Roles<i class="nav-arrow bi bi-chevron-right ms-auto"></i></p>
                    </a>
                    <ul class="nav nav-treeview ps-4">
                         <li class="nav-item">
                                @hasrole('admin')
                                <a href="{{ route('admin.roles.index') }}" class="nav-link flex items-center gap-2 font-serif text-sm text-gray-300 hover:text-indigo-800 transition-colors duration-300">
                                    <i class="nav-icon bi bi-circle text-yellow-400"></i>
                                    <p>Roles et permission</p>
                                </a>
                                @endhasrole
                        </li>
 
                    </ul>
                </li>
  
                <!-- Entité -->
                <li class="nav-item">
                    <a href="#" class="nav-link flex items-center gap-2 font-serif font-semibold text-sm md:text-base uppercase tracking-tight text-white hover:bg-gray-700 transition-colors duration-300">
                        <i class="nav-icon bi bi-grid-fill text-red-400"></i>
                        <p>Entité<i class="nav-arrow bi bi-chevron-right ms-auto"></i></p>
                    </a>
                    <ul class="nav nav-treeview ps-4">
                        <li class="nav-item">
                            <a href="{{ route('Admin.Avis.index') }}" class="nav-link flex items-center gap-2 font-serif text-sm text-gray-300 hover:text-blue-400 transition-colors duration-300">
                                <i class="nav-icon bi bi-circle text-green-400"></i>
                                <p>Avis des utilisateurs</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('index') }}" class="nav-link flex items-center gap-2 font-serif text-sm text-gray-300 hover:text-blue-400 transition-colors duration-300">
                                <i class="nav-icon bi bi-circle text-green-400"></i>
                                <p>Les Sites touristiques</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('indexevenements') }}" class="nav-link flex items-center gap-2 font-serif text-sm text-gray-300 hover:text-blue-400 transition-colors duration-300">
                                <i class="nav-icon bi bi-circle text-green-400"></i>
                                <p>Les Évènements</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.hotels.index') }}" class="nav-link flex items-center gap-2 font-serif text-sm text-gray-300 hover:text-blue-400 transition-colors duration-300">
                                <i class="nav-icon bi bi-circle text-green-400"></i>
                                <p>Hotels & Restauration</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.reservations.index') }}" class="nav-link flex items-center gap-2 font-serif text-sm text-gray-300 hover:text-blue-400 transition-colors duration-300">
                                <i class="nav-icon bi bi-circle text-green-400"></i>
                                <p>Les Réservations</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('indexvisites') }}" class="nav-link flex items-center gap-2 font-serif text-sm text-gray-300 hover:text-blue-400 transition-colors duration-300">
                                <i class="nav-icon bi bi-circle text-green-400"></i>
                                <p>Les Visites</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('galeries.index') }}" class="nav-link flex items-center gap-2 font-serif text-sm text-gray-300 hover:text-blue-400 transition-colors duration-300">
                                <i class="nav-icon bi bi-circle text-green-400"></i>
                                <p>Les Galeries</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('indextickets') }}" class="nav-link flex items-center gap-2 font-serif text-sm text-gray-300 hover:text-blue-400 transition-colors duration-300">
                                <i class="nav-icon bi bi-circle text-green-400"></i>
                                <p>Les Tickets</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('indexcategorie') }}" class="nav-link flex items-center gap-2 font-serif text-sm text-gray-300 hover:text-blue-400 transition-colors duration-300">
                                <i class="nav-icon bi bi-circle text-green-400"></i>
                                <p>Les Catégories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('indexusers') }}" class="nav-link flex items-center gap-2 font-serif text-sm text-gray-300 hover:text-blue-400 transition-colors duration-300">
                                <i class="nav-icon bi bi-circle text-green-400"></i>
                                <p>Utilisateurs</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('paiement.index') }}" class="nav-link flex items-center gap-2 font-serif text-sm text-gray-300 hover:text-blue-400 transition-colors duration-300">
                                <i class="nav-icon bi bi-circle text-green-400"></i>
                                <p>Paiements</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('piece.index') }}" class="nav-link flex items-center gap-2 font-serif text-sm text-gray-300 hover:text-blue-400 transition-colors duration-300">
                                <i class="nav-icon bi bi-circle text-green-400"></i>
                                <p>Pièces d'identité</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('contact.liste') }}" class="nav-link flex items-center gap-2 font-serif text-sm text-gray-300 hover:text-blue-400 transition-colors duration-300">
                                <i class="nav-icon bi bi-circle text-green-400"></i>
                                <p>Les Contacts</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.apropos.index') }}" class="nav-link flex items-center gap-2 font-serif text-sm text-gray-300 hover:text-blue-400 transition-colors duration-300">
                                <i class="nav-icon bi bi-circle text-green-400"></i>
                                <p>A propos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.faqs.index') }}" class="nav-link flex items-center gap-2 font-serif text-sm text-gray-300 hover:text-blue-400 transition-colors duration-300">
                                <i class="nav-icon bi bi-circle text-green-400"></i>
                                <p>Les Faqs</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.newsletters.index') }}" class="nav-link flex items-center gap-2 font-serif text-sm text-gray-300 hover:text-blue-400 transition-colors duration-300">
                                <i class="nav-icon bi bi-circle text-green-400"></i>
                                <p>Newsleters</p>
                            </a>
                        </li>
                    </ul>
                </li>
  
                <!-- Détails paragraphes -->
                <li class="nav-item">
                    <a href="#" class="nav-link flex items-center gap-2 font-serif font-semibold text-sm md:text-base uppercase tracking-tight text-white hover:bg-gray-700 transition-colors duration-300">
                        <i class="nav-icon bi bi-info-circle-fill text-red-400"></i>
                        <p>Détails Paragraphes<i class="nav-arrow bi bi-chevron-right ms-auto"></i></p>
                    </a>
                    <ul class="nav nav-treeview ps-4">
                        <!-- Sous-menu Sites -->
                        <li class="nav-item">
                            <a href="#" class="nav-link toggle-submenu flex items-center gap-2 font-serif text-sm text-gray-300 hover:text-blue-400 transition-colors duration-300" data-target="sites-submenu">
                                <i class="nav-icon bi bi-geo-alt text-blue-400"></i>
                                <p>Sites Touristiques<i class="nav-arrow bi bi-chevron-down ms-auto"></i></p>
                            </a>
                            <ul class="nav nav-treeview ps-4" id="sites-submenu" style="display: none;">
                                @forelse(App\Models\Site_touristique::all() as $site)
                                    <li class="nav-item">
                                        <a href="{{ route('admin.details.index', ['site_id' => $site->id]) }}" class="nav-link flex items-center gap-2 font-serif text-sm text-gray-300 hover:text-blue-400 transition-colors duration-300">
                                            <i class="nav-icon bi bi-circle-fill text-green-400" style="font-size: 0.5rem;"></i>
                                            <p>{{ $site->nom }}</p>
                                        </a>
                                    </li>
                                @empty
                                    <li class="nav-item">
                                        <p class="text-muted ps-4 font-serif text-sm">Aucun site disponible</p>
                                    </li>
                                @endforelse
                            </ul>
                        </li>
                        <!-- Sous-menu Événements -->
                        <li class="nav-item">
                            <a href="#" class="nav-link toggle-submenu flex items-center gap-2 font-serif text-sm text-gray-300 hover:text-blue-400 transition-colors duration-300" data-target="events-submenu">
                                <i class="nav-icon bi bi-calendar-event text-blue-400"></i>
                                <p>Événements<i class="nav-arrow bi bi-chevron-down ms-auto"></i></p>
                            </a>
                            <ul class="nav nav-treeview ps-4" id="events-submenu" style="display: none;">
                                @forelse(App\Models\Evenement::all() as $evenement)
                                    <li class="nav-item">
                                        <a href="{{ route('admin.paragraphes.index', ['evenement_id' => $evenement->id]) }}" class="nav-link flex items-center gap-2 font-serif text-sm text-gray-300 hover:text-blue-400 transition-colors duration-300">
                                            <i class="nav-icon bi bi-circle-fill text-green-400" style="font-size: 0.5rem;"></i>
                                            <p>{{ $evenement->nom }}</p>
                                        </a>
                                    </li>
                                @empty
                                    <li class="nav-item">
                                        <p class="text-muted ps-4 font-serif text-sm">Aucun événement disponible</p>
                                    </li>
                                @endforelse
                            </ul>
                           
                        </li>
                    </ul>
                </li>
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
  </aside>
  <!--end::Sidebar-->