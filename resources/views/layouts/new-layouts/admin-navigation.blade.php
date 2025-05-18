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
            <i class="fas fa-users"></i>
            <span>Users</span>
        </a>
        
        <a class="menu-item {{ request()->routeIs('pakets.index') ? 'active' : '' }}" href="{{ route('pakets.index') }}">
            <i class="fas fa-box-open"></i>
            <span>Pakets</span>
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

<style>
    /* Base Styles */
    .admin-sidebar {
        width: 250px;
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        display: flex;
        flex-direction: column;
        background: white;
        border-right: 1px solid #e5e7eb;
        transition: all 0.3s ease;
        z-index: 50;
    }

    .dark .admin-sidebar {
        background: #1f2937;
        border-right-color: #374151;
    }

    /* Header Styles */
    .sidebar-header {
        padding: 1.5rem 1rem 1rem;
        border-bottom: 1px solid #e5e7eb;
        margin-bottom: 1rem;
    }

    .dark .sidebar-header {
        border-bottom-color: #374151;
    }

    .logo-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        text-decoration: none;
    }

    .sidebar-logo {
        height: 24px;
        width: auto;
        fill: #1f2937;
    }

    .dark .sidebar-logo {
        fill: #f9fafb;
    }

    .panel-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #111827;
    }

    .dark .panel-title {
        color: #f9fafb;
    }

    /* Menu Styles */
    .sidebar-menu {
        flex: 1;
        padding: 0 0.75rem;
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .sidebar-footer {
        padding: 0.75rem;
        border-top: 1px solid #e5e7eb;
        margin-top: auto;
    }

    .dark .sidebar-footer {
        border-top-color: #374151;
    }

    .menu-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        border-radius: 0.375rem;
        color: #4b5563;
        text-decoration: none;
        font-size: 0.9375rem;
        transition: all 0.2s ease;
    }

    .menu-item:hover {
        background-color: #f3f4f6;
        color: #111827;
    }

    .menu-item.active {
        background-color: #3b82f6;
        color: white;
    }

    .menu-item i {
        width: 20px;
        text-align: center;
    }

    .dark .menu-item {
        color: #d1d5db;
    }

    .dark .menu-item:hover {
        background-color: #374151;
        color: #f9fafb;
    }

    .dark .menu-item.active {
        background-color: #1d4ed8;
        color: white;
    }
</style>