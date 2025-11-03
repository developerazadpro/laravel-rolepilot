<x-admin-layout>
    <x-slot name="breadcrumb">
        <nav class="text-gray-500 text-sm">
            <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a> &gt;
            Menus
        </nav>
    </x-slot>

    <div class="max-w-7xl mx-auto p-4 sm:p-6 bg-white shadow rounded">

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl sm:text-2xl font-semibold text-gray-800">Menus</h2>
            <a href="{{ route('admin.menus.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700 transition">
                + Add Menu
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 rounded text-sm sm:text-base">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm sm:text-base border border-gray-200 rounded">
                <thead>
                    <tr class="bg-gray-100 text-gray-700 uppercase text-xs sm:text-sm">
                        <th class="py-2 px-3 border-b text-left">Name</th>
                        <th class="py-2 px-3 border-b text-left">Parent</th>
                        <th class="py-2 px-3 border-b text-left">Route</th>
                        <th class="py-2 px-3 border-b text-left">Icon</th>
                        <th class="py-2 px-3 border-b text-left">Permission</th>
                        <th class="py-2 px-3 border-b text-left">Order</th>
                        <th class="py-2 px-3 border-b text-left">Is Active?</th>
                        <th class="py-2 px-3 border-b text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($menus as $menu)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-3 border-b">{{ $menu->name }}</td>
                            <td class="py-2 px-3 border-b">{{ $menu->parent->name ?? '—' }}</td>
                            <td class="py-2 px-3 border-b">{{ $menu->route ?? '—' }}</td>
                            <td class="py-2 px-3 border-b">{{ $menu->icon ?? '—' }}</td>
                            <td class="py-2 px-3 border-b">{{ $menu->permission_name ?? '—' }}</td>
                            <td class="py-2 px-3 border-b">{{ $menu->order ?? '—' }}</td>
                            <td class="py-2 px-3 border-b">{{ $menu->is_active ? 'Active' : 'Inactive' }}</td>
                            <td class="py-2 px-3 border-b flex gap-2">
                                <a href="{{ route('admin.menus.edit', $menu->id) }}"
                                   class="px-3 py-1 bg-yellow-500 text-white text-xs sm:text-sm rounded hover:bg-yellow-600 transition">
                                   Edit
                                </a>

                                <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this menu?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-600 text-white text-xs sm:text-sm rounded hover:bg-red-700 transition">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-gray-500 italic">
                                No menus found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
