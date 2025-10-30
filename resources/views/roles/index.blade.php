<x-admin-layout>
    <x-slot name="breadcrumb">
        <nav class="text-gray-500 text-sm">
            <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a> &gt; Roles
        </nav>
    </x-slot>

    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">

        <h2 class="text-xl sm:text-2xl font-semibold mb-4">Roles</h2>

        @if(session('success'))
            <div class="mb-4 px-3 sm:px-4 py-2 bg-green-100 text-green-800 rounded text-sm sm:text-base">
                {{ session('success') }}
            </div>
        @endif

        <!-- Search and Filter -->         
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-4 gap-2">
            <a href="{{ route('roles.create') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded shadow hover:bg-blue-700 transition">
                + Add Role
            </a>

            <form method="GET" action="{{ route('roles.index') }}" class="w-full sm:w-1/2 flex">
                <input type="text" name="search" value="{{ $search ?? '' }}"
                    placeholder="Search roles..."
                    class="flex-grow border-green-300 rounded-l-md focus:ring-green-500 focus:border-green-500">
                <button type="submit"
                    class="px-3 bg-green-600 text-white rounded-r-md hover:bg-green-700">
                    Search
                </button>
            </form>
        </div>
         <!--/.  -->
         
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded text-sm sm:text-base">
                <thead>
                    <tr class="bg-gray-100 text-gray-700 uppercase text-xs sm:text-sm">
                        <th class="text-left py-2 px-3 sm:py-2 sm:px-4 border-b">Name</th>
                        <th class="text-left py-2 px-3 sm:py-2 sm:px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-3 sm:py-2 sm:px-4 border-b break-words">{{ $role->name }}</td>
                            <td class="py-2 px-3 sm:py-2 sm:px-4 border-b flex flex-wrap gap-2">
                                <a href="{{ route('roles.edit', $role) }}"
                                   class="inline-block px-2 sm:px-3 py-1 text-xs sm:text-sm bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                    Edit
                                </a>
                                <form action="{{ route('roles.destroy', $role) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Delete this role?')"
                                            class="px-2 sm:px-3 py-1 text-xs sm:text-sm bg-red-600 text-white rounded hover:bg-red-700">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $roles->links() }}
        </div>

    </div>
</x-admin-layout>
