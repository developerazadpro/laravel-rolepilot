@switch($icon)
    @case('dashboard')
        <svg class="w-5 h-5 mr-3 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6M5 10v10h14V10"/>
        </svg>
        @break

    @case('users')
        <svg class="w-5 h-5 mr-3 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5.121 17.804A9 9 0 1118.879 6.196 9 9 0 015.12 17.804z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
        @break

    @case('roles')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
             fill="none" stroke="currentColor" stroke-width="1.5"
             class="w-5 h-5 mr-3 text-blue-400">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 3l7 4v5a9 9 0 11-14 0V7l7-4z" />
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M9 12l2 2 4-4" />
        </svg>
        @break

    @case('permissions')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
             fill="none" stroke="currentColor" stroke-width="1.5"
             class="w-5 h-5 mr-3 text-blue-400">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M15.75 5.25a3 3 0 10-3 3 3 3 0 003-3zM6.75 18.75l-1.5 1.5m1.5-1.5l1.5 1.5m-1.5-1.5V15a4.5 4.5 0 019 0v3.75m-9 0H3.75" />
        </svg>
        @break

    @default
        <svg class="w-5 h-5 mr-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
            <circle cx="12" cy="12" r="9" stroke-width="2"/>
        </svg>
@endswitch
