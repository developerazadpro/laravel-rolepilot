<header class="bg-white shadow flex items-center justify-between px-6 py-4">
    <!-- Page Title -->
    <h2 class="text-xl font-semibold text-gray-800">
        {{ $breadcrumb ?? 'Dashboard' }}
    </h2>

    <!-- User Dropdown -->
    <div class="relative" x-data="{ open: false }">
        <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
            <span class="text-gray-700 font-medium">{{ Auth::user()->name }}</span>
            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        <!-- Dropdown Menu -->
        <div x-show="open" @click.away="open = false"
             class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded shadow-lg z-50">
            <!-- Profile Link -->
            <a href="{{ route('profile.edit') }}"
               class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition">
                Profile
            </a>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 transition">
                    Logout
                </button>
            </form>
        </div>
    </div>
</header>
