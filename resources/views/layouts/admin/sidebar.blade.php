<aside class="w-64 bg-gray-800 text-gray-100 min-h-screen shadow-lg">
    <div class="p-6 border-b border-gray-700">
        <h1 class="text-2xl font-bold">{{ config('app.name', 'RolePilot') }}</h1>
        <p class="text-sm text-gray-400 mt-1">RBAC Management System</p>
    </div>

    <nav class="mt-6">
        <ul class="space-y-1">
            @foreach($menus->where('parent_id', null) as $menu)
                @php
                    // Show menu if active or has any active children
                    $activeChildren = $menu->children->where('is_active', true);
                    $shouldShow = $menu->is_active || $activeChildren->count() > 0;
                @endphp

                @if($shouldShow)
                    @can($menu->permission_name)
                        <li>
                            <a href="{{ $menu->route ? route($menu->route) : '#' }}"
                               class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition
                               {{ $menu->route && Route::has($menu->route) && request()->routeIs($menu->route . '*') ? 'bg-gray-900 font-semibold' : '' }}">

                                @include('layouts.admin.partials.menu-icon', ['icon' => $menu->icon])
                                {{ $menu->name }}
                            </a>

                            {{-- Submenu --}}
                            @if($activeChildren->count())
                                <ul class="ml-6 mt-1 space-y-1">
                                    @foreach($activeChildren as $child)
                                        @can($child->permission_name)
                                            <li>
                                                <a href="{{ $child->route ? route($child->route) : '#' }}"
                                                   class="flex items-center px-4 py-2 rounded hover:bg-gray-700 transition
                                                   {{ $child->route && Route::has($child->route) && request()->routeIs($child->route . '*') ? 'bg-gray-900 font-semibold' : '' }}">
                                                    @include('layouts.admin.partials.menu-icon', ['icon' => $child->icon])
                                                    {{ $child->name }}
                                                </a>
                                            </li>
                                        @endcan
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endcan
                @endif
            @endforeach
        </ul>
    </nav>
</aside>
