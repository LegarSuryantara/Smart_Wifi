<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>@yield('title', 'Dashboard')</title>

  <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet" type="text/css" >
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" crossorigin="anonymous"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
</head>
<body>
  <div class="dashboardadmin d-flex">

    @include('layouts.sidebar')


    <div class="flex-grow-1">
  


      @yield('content')
    </div>
  </div>

  @stack('scripts') {{-- Untuk JS tambahan dari halaman --}}
</body>
</html>
