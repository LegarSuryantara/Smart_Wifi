<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>

    <!-- Styles -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="dashboard-admin-wrapper">
        <!-- Sidebar Navigation -->
        @include('layouts.admin-navigation')

        <div class="main-content-wrapper">
            <!-- Header -->
            @include('layouts.header')

            <!-- Main Content -->
            <main class="main-content">
                @yield('content')
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    @stack('scripts')
    @isset($script)
        {{ $script }}
    @endisset

    <style>
        /* Layout Styles */
        .dashboard-admin-wrapper {
            display: flex;
            min-height: 100vh;
            background-color: #f8fafc;
        }

        .main-content-wrapper {
            flex: 1;
            margin-left: 250px; /* Sesuaikan dengan lebar sidebar */
            transition: margin-left 0.3s ease;
        }

        .main-content {
            padding: 20px;
            min-height: calc(100vh - 60px); /* Sesuaikan dengan tinggi header */
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .main-content-wrapper {
                margin-left: 0;
            }
            
            .admin-navigation {
                transform: translateX(-100%);
                position: fixed;
                z-index: 1000;
            }
            
            .admin-navigation.active {
                transform: translateX(0);
            }
        }

        /* Dark Mode Support */
        .dark .dashboard-admin-wrapper {
            background-color: #0f172a;
        }
    </style>
</body>
</html>