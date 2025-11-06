<x-admin-layout>
    <x-slot name="breadcrumb">
        <nav class="text-gray-500 text-sm">
            <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a> &gt;
            Menus
        </nav>
    </x-slot>

    <div class="max-w-7xl mx-auto p-4 sm:p-6 bg-white shadow rounded">
        
        <h2 class="text-xl sm:text-2xl font-semibold mb-4 sm:mb-6 text-gray-800">Menus</h2>

        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-4 gap-2">           
            
            @include('admin.partials.action-toolbar', [
                'module' => 'menus',
                'label' => 'Add Menu'
            ])

            <x-search-form route="admin.menus.index" :search="$search" placeholder="Search menus..." />   

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
                                <x-table-row-actions :module="'menus'" :id="$menu->id" />
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
