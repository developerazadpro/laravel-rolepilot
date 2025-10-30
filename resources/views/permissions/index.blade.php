<x-admin-layout>
    <x-slot name="breadcrumb">
        <nav class="text-gray-500 text-sm">
            <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a> &gt; Permissions
        </nav>
    </x-slot>

    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">

        <h2 class="text-xl sm:text-2xl font-semibold mb-4">Permissions</h2>

        <a href="{{ route('permissions.create') }}"
            class="inline-flex items-center mb-4 px-3 sm:px-4 py-1 sm:py-2 bg-blue-600 text-white text-sm sm:text-base font-semibold rounded shadow hover:bg-blue-700 transition">
            Create New
        </a>

        @if(session('success'))
            <div class="mb-4 px-3 sm:px-4 py-2 bg-green-100 text-green-800 rounded text-sm sm:text-base">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded text-sm sm:text-base">
                <thead>
                    <tr class="bg-gray-100 text-gray-700 uppercase text-xs sm:text-sm">
                        <th class="text-left py-2 px-3 sm:py-2 sm:px-4 border-b">Permission Name</th>
                        <th class="text-left py-2 px-3 sm:py-2 sm:px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($permissions as $permission)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-3 sm:py-2 sm:px-4 border-b break-words">{{ $permission->name }}</td>
                            <td class="py-2 px-3 sm:py-2 sm:px-4 border-b flex flex-wrap gap-2">
                                <form action="{{ route('permissions.destroy', $permission) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Delete this permission?')"
                                            class="px-2 sm:px-3 py-1 text-xs sm:text-sm bg-red-600 text-white rounded hover:bg-red-700">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center text-gray-500 py-4 text-sm sm:text-base">
                                No permissions found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $permissions->links() }}
        </div>

    </div>
</x-admin-layout>
