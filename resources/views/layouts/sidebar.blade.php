<nav class="sidebar d-flex flex-column justify-content-between">
    <div>
        <div class="d-flex align-items-center gap-2 mb-5 ps-3">
            <img src="https://storage.googleapis.com/a1aa/image/0d0863c7-adee-4b3f-d92d-b56d8884a7f6.jpg" alt="Logo"
                width="24" height="24">
            <span class="fw-semibold fs-5 text-dark user-select-none">Dashboard</span>
        </div>
        <div class="nav flex-column gap-2">
            <a class="nav-link {{ request()->routeIs('dashboard.dashboardHome') ? 'active' : '' }}"
                href="{{ route('dashboard.dashboardHome') }}">
                <i class="fas fa-th-large"></i> Dashboard
            </a>
            <a class="nav-link {{ request()->routeIs('dashboard.dashboardPakets') ? 'active' : '' }}"
                href="{{ route('dashboard.dashboardPakets') }}">
                <i class="fas fa-box-open"></i> Pakets
            </a>
            <a class="nav-link {{ request()->routeIs('dashboard.dashboardCustomer') ? 'active' : '' }}"
                href="{{ route('dashboard.dashboardCustomer') }}">
                <i class="fas fa-user-friends"></i> Customers
            </a>
            <a class="nav-link {{ request()->routeIs('dashboard.dashboardTransaksi') ? 'active' : '' }}"
                href="{{ route('dashboard.dashboardTransaksi') }}">
                <i class="fas fa-file-invoice"></i> Transaksi
            </a>
            <a class="nav-link {{ request()->routeIs('dashboard.dashboardPengguna') ? 'active' : '' }}"
                href="{{ route('dashboard.dashboardPengguna') }}">
                <i class="fas fa-user-circle"></i> Pengguna
            </a>

        </div>
    </div>
    <div class="nav flex-column">
        <a class="nav-link" href="#"><i class="fas fa-user-circle"></i> Profile</a>
        <a class="nav-link" href="#"><i class="fas fa-cog"></i> Setting</a>
    </div>
</nav>
