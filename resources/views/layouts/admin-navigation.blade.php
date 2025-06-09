<nav class="admin-sidebar">
    <!-- Header with Logo -->
    <div class="sidebar-header">
        <a href="{{ route('admin.index') }}" class="logo-link">
            <x-application-logo class="sidebar-logo" />
            <span class="panel-title">Admin Panel</span>
        </a>
    </div>

    <!-- Main Navigation -->
    <div class="sidebar-menu">
        <a class="menu-item {{ request()->routeIs('admin.index') ? 'active' : '' }}" href="{{ route('admin.index') }}">
            <i class="fas fa-th-large"></i>
            <span>Dashboard</span>
        </a>
        
        <a class="menu-item {{ request()->routeIs('permissions.index') ? 'active' : '' }}" href="{{ route('permissions.index') }}">
            <i class="fas fa-key"></i>
            <span>Permissions</span>
        </a>
        
        <a class="menu-item {{ request()->routeIs('roles.index') ? 'active' : '' }}" href="{{ route('roles.index') }}">
            <i class="fas fa-user-tag"></i>
            <span>Roles</span>
        </a>
        
        <a class="menu-item {{ request()->routeIs('users.index') ? 'active' : '' }}" href="{{ route('users.index') }}">
            <i class="fas fa-user"></i>
            <span>Users</span>
        </a>

        <a class="menu-item {{ request()->routeIs('customers.index') ? 'active' : '' }}" href="{{ route('customers.index') }}">
            <i class="fas fa-users"></i>
            <span>Customers</span>
        </a>
        
        <a class="menu-item {{ request()->routeIs('pakets.index') ? 'active' : '' }}" href="{{ route('pakets.index') }}">
            <i class="fas fa-box-open"></i>
            <span>Pakets</span>
        </a>
        
        <a class="menu-item {{ request()->routeIs('devices.index') ? 'active' : '' }}" href="{{ route('devices.index') }}">
            <i class="fas fa-phone"></i>
            <span>Devices</span>
        </a>

        <a class="menu-item {{ request()->routeIs('monitorings.index') ? 'active' : '' }}" href="{{ route('monitorings.index') }}">
            <i class="fas fa-book"></i>
            <span>Monitoring</span>
        </a>

    </div>

    <!-- Footer Menu -->
    <div class="sidebar-footer">
        <a class="menu-item {{ request()->routeIs('profile.edit') ? 'active' : '' }}" href="{{ route('profile.edit') }}">
            <i class="fas fa-user-circle"></i>
            <span>Profile</span>
        </a>
        
        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <a class="menu-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                <i class="fas fa-sign-out-alt"></i>
                <span>Log Out</span>
            </a>
        </form>
    </div>
</nav>