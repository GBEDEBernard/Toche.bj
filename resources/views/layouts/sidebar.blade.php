<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand">
      <a href="{{ route('welcome') }}" class="brand-link">
          <img src="/image/logo3.jpg" alt="AdminLTE Logo" class="brand-image opacity-75 shadow rounded-full" />
          <span class="brand-text fw-light">Toché le Bénin</span>
      </a>
  </div>
  <!--end::Sidebar Brand-->

  <!--begin::Sidebar Wrapper-->
  <div class="sidebar-wrapper">
      <nav class="mt-2">
          <!--begin::Sidebar Menu-->
          <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

              <!-- Les tableaux -->
              <li class="nav-item">
                  <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-table text-primary"></i>
                      <p>
                          Les tableaux
                          <i class="nav-arrow bi bi-chevron-right"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="{{ route('contact.liste') }}" class="nav-link">
                              <i class="nav-icon bi bi-circle text-warning"></i>
                              <p>Tableau des Contacts</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('indexcategorie') }}" class="nav-link">
                              <i class="nav-icon bi bi-circle text-warning"></i>
                              <p>Tableaux des Catégories</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('admin.reservations.index') }}" class="nav-link">
                              <i class="nav-icon bi bi-circle text-warning"></i>
                              <p>Tableau Reservations</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('indexvisites') }}" class="nav-link">
                              <i class="nav-icon bi bi-circle text-warning"></i>
                              <p>Tableau des Visites</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('indexevenements') }}" class="nav-link">
                              <i class="nav-icon bi bi-circle text-warning"></i>
                              <p>Tableaux des Évènements</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('galeries.index') }}" class="nav-link">
                              <i class="nav-icon bi bi-circle text-warning"></i>
                              <p>Tableau des Galeries</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('indexroles') }}" class="nav-link">
                              <i class="nav-icon bi bi-circle text-warning"></i>
                              <p>Tableau des Rôles</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('indextickets') }}" class="nav-link">
                              <i class="nav-icon bi bi-circle text-warning"></i>
                              <p>Tableau des Tickets</p>
                          </a>
                      </li>
                  </ul>
              </li>

              <!-- Les formulaires -->
              <li class="nav-item">
                  <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-pencil-square text-success"></i>
                      <p>
                          Les Formulaires
                          <i class="nav-arrow bi bi-chevron-right"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="{{ route('formulaire') }}" class="nav-link">
                              <i class="nav-icon bi bi-circle text-warning"></i>
                              <p>Formulaire</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('createcategorie') }}" class="nav-link">
                              <i class="nav-icon bi bi-circle text-warning"></i>
                              <p>Ajouter une Catégorie</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('create') }}" class="nav-link">
                              <i class="nav-icon bi bi-circle text-warning"></i>
                              <p>Ajouter un Site</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('evenement.create') }}" class="nav-link">
                              <i class="nav-icon bi bi-circle text-warning"></i>
                              <p>Ajouter un Évènement</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('visites') }}" class="nav-link">
                              <i class="nav-icon bi bi-circle text-warning"></i>
                              <p>Ajouter une Visite</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('roles') }}" class="nav-link">
                              <i class="nav-icon bi bi-circle text-warning"></i>
                              <p>Ajouter un Rôle</p>
                          </a>
                      </li>
                  </ul>
              </li>

           
<!-- Entité -->
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon bi bi-grid-fill text-danger"></i>
        <p>
            Entité
            <i class="nav-arrow bi bi-chevron-right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('Admin.Avis.index') }}" class="nav-link">
                <i class="nav-icon bi bi-circle text-success"></i>
                <p>Avis des utilisateurs</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('index') }}" class="nav-link">
                <i class="nav-icon bi bi-circle text-success"></i>
                <p>Les Sites touristiques</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('indexevenements') }}" class="nav-link">
                <i class="nav-icon bi bi-circle text-success"></i>
                <p>Les évènements</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.reservations.index') }}" class="nav-link">
                <i class="nav-icon bi bi-circle text-success"></i>
                <p>Les Réservations</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('indexvisites') }}" class="nav-link">
                <i class="nav-icon bi bi-circle text-success"></i>
                <p>Les visites</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('galeries.index') }}" class="nav-link">
                <i class="nav-icon bi bi-circle text-success"></i>
                <p>Les Galeries</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('indextickets') }}" class="nav-link">
                <i class="nav-icon bi bi-circle text-success"></i>
                <p>Les Tickets</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('indexroles') }}" class="nav-link">
                <i class="nav-icon bi bi-circle text-success"></i>
                <p>Les Rôles</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('users') }}" class="nav-link">
                <i class="nav-icon bi bi-circle text-success"></i>
                <p> Utilisateurs</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('paiement.index') }}" class="nav-link">
                <i class="nav-icon bi bi-circle text-success"></i>
                <p>Paiements</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('piece.index') }}" class="nav-link">
                <i class="nav-icon bi bi-circle text-success"></i>
                <p> Pièces d'identité</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('contact.liste') }}" class="nav-link">
                <i class="nav-icon bi bi-circle text-success"></i>
                <p>Les Contacts</p>
            </a>
        </li>
    </ul>
</li>

<!-- Menu regroupé Détails -->
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon bi bi-info-circle-fill text-danger"></i>
        <p>
            Détails paragraphes
            <i class="nav-arrow bi bi-chevron-right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <!-- Sous-menu Sites -->
        <li class="nav-item">
            <a href="#" class="nav-link toggle-submenu" data-target="sites-submenu">
                <i class="nav-icon bi bi-geo-alt text-primary"></i>
                <p>
                    Sites Touristiques
                    <i class="nav-arrow bi bi-chevron-down float-end"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" id="sites-submenu" style="display: none;">
                @forelse(App\Models\Site_touristique::all() as $site)
                    <li class="nav-item">
                        <a href="{{ route('admin.details.index', ['site_id' => $site->id]) }}" class="nav-link">
                            <i class="nav-icon bi bi-circle-fill text-success" style="font-size: 0.5rem;"></i>
                            <p>{{ $site->nom }}</p>
                        </a>
                    </li>
                @empty
                    <li class="nav-item">
                        <p class="text-muted ps-4">Aucun site disponible</p>
                    </li>
                @endforelse
            </ul>
        </li>
        
        <!-- Sous-menu Événements -->
        <li class="nav-item">
            <a href="#" class="nav-link toggle-submenu" data-target="events-submenu">
                <i class="nav-icon bi bi-calendar-event text-primary"></i>
                <p>
                    Événements
                    <i class="nav-arrow bi bi-chevron-down float-end"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" id="events-submenu" style="display: none;">
                @forelse(App\Models\Evenement::all() as $evenement)
                    <li class="nav-item">
                        <a href="{{ route('admin.paragraphes.index', ['evenement_id' => $evenement->id]) }}" class="nav-link">
                            <i class="nav-icon bi bi-circle-fill text-success" style="font-size: 0.5rem;"></i>
                            <p>{{ $evenement->nom }}</p>
                        </a>
                    </li>
                @empty
                    <li class="nav-item">
                        <p class="text-muted ps-4">Aucun événement disponible</p>
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
