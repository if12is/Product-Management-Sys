<nav class="navbar navbar-expand topbar mb-4 static-top">
    <div class="container-fluid">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle me-3">
            <i class="bi bi-list"></i>
        </button>

        <div class="d-none d-sm-inline-block form-inline me-auto ml-md-3 my-2 my-md-0 mw-100">
            <h1 class="h5 mb-0 text-gray-800">@yield('title', 'Dashboard')</h1>
        </div>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="me-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                    <img class="img-profile rounded-circle"
                        src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=4e73df&color=ffffff"
                        width="32" height="32">
                </a>
                <div class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">
                        <i class="bi bi-person-fill me-2 text-gray-400"></i>
                        Profile
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="bi bi-gear-fill me-2 text-gray-400"></i>
                        Settings
                    </a>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="bi bi-box-arrow-right me-2 text-gray-400"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
