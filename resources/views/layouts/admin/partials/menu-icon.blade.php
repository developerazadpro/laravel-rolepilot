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

    @case('settings')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="1.5"
            class="w-5 h-5 mr-3 text-blue-400">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M10.325 4.317a1 1 0 011.35-.937 8.25 8.25 0 016.28 6.28 1 1 0 01-.937 1.35 2.25 2.25 0 000 4.98 1 1 0 01.937 1.35 8.25 8.25 0 01-6.28 6.28 1 1 0 01-1.35-.937 2.25 2.25 0 00-4.98 0 1 1 0 01-1.35.937 8.25 8.25 0 01-6.28-6.28 1 1 0 01.937-1.35 2.25 2.25 0 000-4.98 1 1 0 01-.937-1.35 8.25 8.25 0 016.28-6.28 1 1 0 011.35.937 2.25 2.25 0 004.98 0zM12 15.75a3.75 3.75 0 100-7.5 3.75 3.75 0 000 7.5z" />
        </svg>
        @break

    @case('menus')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" 
            fill="none" stroke="currentColor" stroke-width="1.5" 
            class="w-5 h-5 mr-3 text-blue-400">
            <path stroke-linecap="round" stroke-linejoin="round" 
                d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        @break
    
    @case('logs')
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
            stroke-width="1.5" stroke="currentColor" 
            class="w-5 h-5 mr-3 text-blue-400">
        <path stroke-linecap="round" stroke-linejoin="round" 
                d="M9 12h6m-6 4h6M9 8h6M7.5 3h9a2 2 0 012 2v14a2 2 0 01-2 2h-9a2 2 0 01-2-2V5a2 2 0 012-2z" />
        </svg>
        @break

    @default
        <svg class="w-5 5-6 mr-3 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <circle cx="12" cy="12" r="9" stroke-width="2" />
        </svg>
@endswitch
