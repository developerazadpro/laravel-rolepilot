<aside class="w-64 bg-gray-800 text-gray-100 min-h-screen shadow-lg">
    <div class="p-6 border-b border-gray-700">
        <h1 class="text-2xl font-bold">{{ config('app.name', 'RolePilot') }}</h1>
        <p class="text-sm text-gray-400 mt-1">RBAC Management System</p>
    </div>

    <nav class="mt-6">
        <ul class="space-y-1">
            @foreach($menus->where('parent_id', null) as $menu)
                @can($menu->permission_name)
                    <li>
                        <a href="{{ $menu->route ? route($menu->route) : '#' }}"
                           class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition
                           {{ request()->routeIs($menu->route . '*') ? 'bg-gray-900 font-semibold' : '' }}">

                            @include('layouts.admin.partials.menu-icon', ['icon' => $menu->icon])
                            {{ $menu->name }}
                        </a>

                        {{-- Submenu --}}
                        @if($menu->children->count())
                            <ul class="ml-6 mt-1 space-y-1">
                                @foreach($menu->children as $child)
                                    @can($child->permission_name)
                                        <li>
                                            <a href="{{ $child->route ? route($child->route) : '#' }}"
                                               class="flex items-center px-4 py-2 rounded hover:bg-gray-700 transition
                                               {{ request()->routeIs($child->route . '*') ? 'bg-gray-900 font-semibold' : '' }}">
                                                {{ $child->name }}
                                            </a>
                                        </li>
                                    @endcan
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endcan
            @endforeach
        </ul>
    </nav>
</aside>
