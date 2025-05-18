<header class="d-flex align-items-center justify-content-between py-4 px-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-400 shadow-sm" style="border-radius: 0 !important;">
  <div class="d-flex align-items-center">
    <!-- User Name -->
    <span class="text-gray-800 dark:text-gray-400 font-medium mr-4">
      {{ Auth::user()->name }}
    </span>
  </div>
  
  <div class="d-flex align-items-center gap-3 ms-auto">
    <!-- Profile (Changed to circular) -->
    <button class="focus:outline-none">
        @if(Auth::user()->profile_photo)
            <img class="h-9 w-9 rounded-full object-cover hover:ring-2 hover:ring-blue-500 transition-all" 
                src="{{ asset('storage/'.Auth::user()->profile_photo) }}" 
                alt="{{ Auth::user()->name }}">
        @else
            <div class="h-9 w-9 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center hover:ring-2 hover:ring-blue-500 transition-all">
                <span class="text-gray-600 dark:text-gray-300 text-xs font-medium">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </span>
            </div>
        @endif
    </button>
    <!-- Notification (Remains square) -->
    <button class="notification-btn position-relative focus:outline-none" type="button" aria-label="Notifications" style="border-radius: 0 !important;">
      <i class="fas fa-bell text-gray-600 dark:text-gray-300 hover:text-blue-500 transition-colors"></i>
      <span class="notification-badge"></span>
    </button>
  </div>
</header>