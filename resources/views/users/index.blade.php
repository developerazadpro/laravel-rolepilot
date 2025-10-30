<x-admin-layout>
    <x-slot name="breadcrumb">
        <nav class="text-gray-500 text-sm">
            <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a> &gt; Users
        </nav>
    </x-slot>

    <div class="max-w-7xl mx-auto p-4 sm:p-6 bg-white shadow rounded">

        <h2 class="text-xl sm:text-2xl font-semibold mb-4 sm:mb-6 text-gray-800">Users</h2>

        @if(session('success'))
            <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 rounded text-sm sm:text-base">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded text-sm sm:text-base">
                <thead>
                    <tr class="bg-gray-100 text-gray-700 uppercase tracking-wider text-xs sm:text-sm">
                        <th class="py-2 px-3 sm:py-3 sm:px-4 border-b text-left">Name</th>
                        <th class="py-2 px-3 sm:py-3 sm:px-4 border-b text-left">Email</th>
                        <th class="py-2 px-3 sm:py-3 sm:px-4 border-b text-left">Roles</th>
                        <th class="py-2 px-3 sm:py-3 sm:px-4 border-b text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-3 sm:py-2 sm:px-4 border-b break-words">{{ $user->name }}</td>
                            <td class="py-2 px-3 sm:py-2 sm:px-4 border-b break-words">{{ $user->email }}</td>
                            <td class="py-2 px-3 sm:py-2 sm:px-4 border-b break-words">
                                @if($user->roles->count())
                                    {{ $user->roles->pluck('name')->join(', ') }}
                                @else
                                    <span class="text-gray-500 italic">No role assigned</span>
                                @endif
                            </td>
                            <td class="py-2 px-3 sm:py-2 sm:px-4 border-b flex flex-wrap gap-2">
                                <a href="{{ route('users.editRole', $user->id) }}"
                                   class="px-2 sm:px-3 py-1 text-xs sm:text-sm bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                                    Edit Role
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500 italic text-sm sm:text-base">
                                No users found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $users->links() }}
        </div>

    </div>
</x-admin-layout>
