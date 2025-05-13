<div class="sidebar">
    <a href="{{ route('admin.dashboard') }}" class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon">
            <i class="bi bi-box-seam"></i>
        </div>
        <div class="sidebar-brand-text mx-3">PMS Admin</div>
    </a>

    <hr class="sidebar-divider">

    <div class="nav flex-column">
        <a href="{{ route('admin.dashboard') }}"
            class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('admin.products.index') }}"
            class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
            <i class="bi bi-box me-2"></i>
            <span>Products</span>
        </a>

        <hr class="sidebar-divider">

        <form action="{{ route('admin.logout') }}" method="POST" class="nav-link">
            @csrf
            <button type="submit" class="btn btn-link text-white-50 p-0">
                <i class="bi bi-box-arrow-right me-2"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
</div>
