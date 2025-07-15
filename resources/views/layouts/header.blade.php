<!--begin::Header-->
<nav class="app-header navbar navbar-expand bg-body shadow-sm ">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button" aria-label="Toggle Sidebar">
                    <i class="bi bi-list"></i>
                </a>
            </li>
            <li class="nav-item d-none d-md-block">
                <a href="{{ route('welcome') }}" class="nav-link">Tableau de bord</a>
            </li>
            <li class="nav-item d-none d-md-block">
                <a href="{{ route('contact.liste') }}" class="nav-link">Contact</a>
            </li>
        </ul>
        <!--end::Start Navbar Links-->

        <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto align-items-center">
            <!--begin::Navbar Search-->
            <li class="nav-item">
                <form class="d-flex" action="{{ route('admin.search') }}" method="GET">
                    <input class="form-control form-control-sm me-2" type="search" name="query" placeholder="Rechercher..." aria-label="Search">
                    <button class="btn btn-outline-primary btn-sm" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </li>
           
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen" aria-label="Toggle Fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i>
                </a>
            </li>
            <!--begin::Notifications Dropdown Menu-->
            <li class="nav-item dropdown">
                <a class="nav-link" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                    <i class="bi bi-bell-fill text-orange"></i>
                    @php
                        $unreadNotifications = 0;
                        if (auth()->check()) {
                            try {
                                $unreadNotifications = auth()->user()->unreadNotifications()->where('type', 'App\Notifications\NewAvisNotification')->count();
                            } catch (\Exception $e) {
                                \Log::error('Error fetching notifications: ' . $e->getMessage());
                            }
                        }
                    @endphp
                    @if ($unreadNotifications > 0)
                        <span class="navbar-badge badge text-bg-orange">{{ $unreadNotifications }}</span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end shadow">
                    <span class="dropdown-item dropdown-header">{{ $unreadNotifications }} Notification{{ $unreadNotifications !== 1 ? 's' : '' }} d’avis</span>
                    <div class="dropdown-divider"></div>
                    @if (auth()->check())
                        @forelse (auth()->user()->unreadNotifications()->where('type', 'App\Notifications\NewAvisNotification')->take(3)->get() as $notification)
                            <a href="{{ route('Admin.Avis.index') }}" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <div class="me-2">
                                        <i class="bi bi-star-fill text-orange"></i>
                                    </div>
                                    <div>
                                        <p class="mb-0 text-truncate" style="max-width: 200px;">{{ $notification->data['message'] }}</p>
                                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                        @empty
                            <div class="dropdown-item text-muted">Aucune notification d’avis nouvelle</div>
                        @endforelse
                    @else
                        <div class="dropdown-item text-muted">Connectez-vous pour voir les notifications</div>
                    @endif
                    <a href="{{ route('Admin.Avis.index') }}" class="dropdown-item dropdown-footer">Voir tous les avis</a>
                </div>
            </li>
            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
                @auth
                    <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ auth()->user()->photo ? asset(auth()->user()->photo) : asset('images/default-avatar.jpg') }}"
                             class="user-image rounded-circle shadow-sm" alt="User Image" width="32" height="32">
                        <span class="d-none d-md-inline ms-2 text-truncate" style="max-width: 150px;">{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li class="user-header bg-primary text-white text-center p-3">
                            <img src="{{ auth()->user()->photo ? asset(auth()->user()->photo) : asset('images/default-avatar.jpg') }}"
                                 class="rounded-circle shadow-sm" alt="User Image" width="60" height="60">
                            <p class="mb-1 fw-bold">{{ auth()->user()->name }}</p>
                            <small>{{ auth()->user()->roles->pluck('name')->implode(', ') ?: 'Utilisateur' }}</small>
                            <small>Membre depuis {{ auth()->user()->created_at->format('M Y') }}</small>
                        </li>
                        <li class="user-body px-3 py-2">
                            <div class="row text-center">
                                <div class="col-4">
                                    <a href="#" class="text-decoration-none">Abonnés</a>
                                    <p class="mb-0">{{ auth()->user()->followers_count ?? 0 }}</p>
                                </div>
                                <div class="col-4">
                                    <a href="#" class="text-decoration-none">Réservations</a>
                                    <p class="mb-0">{{ auth()->user()->reservations_count ?? 0 }}</p>
                                </div>
                                <div class="col-4">
                                    <a href="#" class="text-decoration-none">Amis</a>
                                    <p class="mb-0">{{ auth()->user()->friends_count ?? 0 }}</p>
                                </div>
                            </div>
                        </li>
                        <li class="user-footer d-flex justify-content-between p-3">
                            <a href="{{ route('profile') }}" class="btn btn-sm btn-outline-primary">Profil</a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger">Déconnexion</button>
                            </form>
                        </li>
                    </ul>
                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link">Inscription</a>
                    </li>
                @endauth
            </li>
            <!--end::User Menu Dropdown-->
        </ul>
        <!--end::End Navbar Links-->
    </div>
    <!--end::Container-->
</nav>
<!--end::Header-->