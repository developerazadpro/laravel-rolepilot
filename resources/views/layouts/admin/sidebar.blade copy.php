<aside class="w-64 bg-gray-800 text-gray-100 min-h-screen shadow-lg">
    <!-- App Name & Caption -->
    <div class="p-6 border-b border-gray-700">
        <h1 class="text-2xl font-bold">{{ config('app.name', 'RolePilot') }}</h1>
        <p class="text-sm text-gray-400 mt-1">RBAC Management System</p>
    </div>

    <!-- Navigation -->
    <nav class="mt-6">
        <ul class="space-y-1">

            <!-- Dashboard -->
            <li>
                <a href="{{ route('dashboard') }}"
                   class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition
                   {{ request()->routeIs('dashboard') ? 'bg-gray-900 font-semibold' : '' }}">
                    <svg class="w-5 h-5 mr-3 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6M5 10v10h14V10"/>
                    </svg>
                    Dashboard
                </a>
            </li>

            <!-- Users -->
            <li>
                <a href="{{ route('admin.users.index') }}"
                   class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition
                   {{ request()->routeIs('users.*') ? 'bg-gray-900 font-semibold' : '' }}">
                    <svg class="w-5 h-5 mr-3 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5.121 17.804A9 9 0 1118.879 6.196 9 9 0 015.12 17.804z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Users
                </a>
            </li>

            <!-- Roles -->
            <li>
                <a href="{{ route('admin.roles.index') }}"
                   class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition
                   {{ request()->routeIs('roles.*') ? 'bg-gray-900 font-semibold' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="1.5"
                         class="w-5 h-5 mr-3 text-blue-400">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 3l7 4v5a9 9 0 11-14 0V7l7-4z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9 12l2 2 4-4" />
                    </svg>
                    Roles
                </a>
            </li>

            <!-- Permissions -->
            <li>
                <a href="{{ route('admin.permissions.index') }}"
                   class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition
                   {{ request()->routeIs('permissions.*') ? 'bg-gray-900 font-semibold' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="1.5"
                         class="w-5 h-5 mr-3 text-blue-400">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15.75 5.25a3 3 0 10-3 3 3 3 0 003-3zM6.75 18.75l-1.5 1.5m1.5-1.5l1.5 1.5m-1.5-1.5V15a4.5 4.5 0 019 0v3.75m-9 0H3.75" />
                    </svg>
                    Permissions
                </a>
            </li>

        </ul>
    </nav>
</aside>
