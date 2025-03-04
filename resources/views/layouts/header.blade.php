<!--begin::Header-->
<nav class="app-header navbar navbar-expand bg-body">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
            <li class="nav-item d-none d-md-block"><a href="{{route('welcome')}}" class="nav-link">Home</a></li>
            <li class="nav-item d-none d-md-block"><a href="{{ route('contact.liste') }}" class="nav-link">Contact</a></li>
        </ul>
        <!--end::Start Navbar Links-->

        <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto">
            <!--begin::Navbar Search-->
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="bi bi-search"></i>
                </a>
            </li>
            <!--end::Navbar Search-->

            <!--begin::Messages Dropdown Menu-->
            <li class="nav-item dropdown">
                <a class="nav-link" data-bs-toggle="dropdown" href="#">
                    <i class="bi bi-chat-text"></i>
                    <span class="navbar-badge badge text-bg-danger">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <a href="#" class="dropdown-item">See All Messages</a>
                </div>
            </li>
            <!--end::Messages Dropdown Menu-->

            <!--begin::Notifications Dropdown Menu-->
            <li class="nav-item dropdown">
                <a class="nav-link" data-bs-toggle="dropdown" href="#">
                    <i class="bi bi-bell-fill"></i>
                    <span class="navbar-badge badge text-bg-warning">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">See All Notifications</a>
                </div>
            </li>
            <!--end::Notifications Dropdown Menu-->

            <!--begin::Fullscreen Toggle-->
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                </a>
            </li>
            <!--end::Fullscreen Toggle-->

            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu position-relative">
    @auth
    <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
        <img src="{{ auth()->user()->profile_picture ?? '/path/to/default-avatar.jpg' }}" 
            class="user-image rounded-circle shadow-sm" alt="User Image" width="40" height="40" />
        <span class="d-none d-md-inline ms-2 text-truncate" style="max-width: 150px;">{{ auth()->user()->name }}</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-end shadow mt-2 w-auto rounded-lg" style="right: 0; left: auto; min-width: 250px;">
        <!-- User Image -->
        <li class="user-header text-bg-primary text-center p-3">
            <img src="{{ auth()->user()->profile_picture ?? '/path/to/default-avatar.jpg' }}" 
                class="rounded-circle shadow mb-2" alt="User Image" width="70" height="70" />
            <p class="mb-0 fw-bold text-truncate">{{ auth()->user()->name }}</p>
            <small class="d-block">{{ auth()->user()->role ?? 'User' }}</small>
            <small class="d-block">Member since {{ auth()->user()->created_at->format('M Y') }}</small>
        </li>

        <!-- Menu Body -->
        <li class="user-body px-3 py-2">
            <div class="d-flex justify-content-between">
                <a href="#" class="text-decoration-none">Followers</a>
                <a href="#" class="text-decoration-none">Sales</a>
                <a href="#" class="text-decoration-none">Friends</a>
            </div>
        </li>

        <!-- Menu Footer -->
        <li class="user-footer d-flex justify-content-between px-3 py-2">
            <a href="{{ route('profile') }}" class="btn btn-sm btn-outline-primary">Profile</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger">Déconnexion</button>
            </form>
        </li>
    </ul>
    @endauth
</li>

<!--end::User Menu Dropdown-->
        </ul>
        <!--end::End Navbar Links-->
    </div>
    <!--end::Container-->
</nav>
<!--end::Header-->
