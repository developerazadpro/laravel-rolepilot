<x-admin-layout>
    <x-slot name="breadcrumb">
        <nav class="text-gray-500 text-sm">
            <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a> &gt; Users
        </nav>
    </x-slot>

    <div x-data="userTable()" class="max-w-7xl mx-auto p-4 sm:p-6 bg-white shadow rounded">

        <h2 class="text-xl sm:text-2xl font-semibold mb-4 sm:mb-6 text-gray-800">Users</h2>

        @if(session('success'))
            <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 rounded text-sm sm:text-base">
                {{ session('success') }}
            </div>
        @endif

        <!-- Search and Filter -->         
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-4 gap-2">
            <a href="{{ route('users.create') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded shadow hover:bg-blue-700 transition">
                + Add User
            </a>

            <form method="GET" action="{{ route('users.index') }}" class="w-full sm:w-1/2 flex">
                <input type="text" name="search" value="{{ $search ?? '' }}"
                    placeholder="Search users..."
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
                    <tr class="bg-gray-100 text-gray-700 uppercase tracking-wider text-xs sm:text-sm">
                        <th class="py-2 px-3 sm:py-3 sm:px-4 border-b text-left">Name</th>
                        <th class="py-2 px-3 sm:py-3 sm:px-4 border-b text-left">Email</th>
                        <th class="py-2 px-3 sm:py-3 sm:px-4 border-b text-left">Roles</th>
                        <th class="py-2 px-3 sm:py-3 sm:px-4 border-b text-left">Status</th>
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

                            <td class="py-2 px-4 border-b">
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox"
                                        class="sr-only peer"
                                        {{ $user->is_active ? 'checked' : '' }}
                                        @change="toggleUser({{ $user->id }}, $event.target.checked)">
                                    <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer dark:bg-gray-700 peer-checked:bg-blue-600 relative transition">
                                        <span class="absolute left-[2px] top-[2px] bg-white w-5 h-5 rounded-full transition-transform peer-checked:translate-x-full"></span>
                                    </div>
                                    <span class="ml-2 text-sm text-gray-700" x-text="$event?.target?.checked ? 'Active' : 'Inactive'"></span>
                                </label>
                            </td>

                            <td class="py-2 px-3 sm:py-2 sm:px-4 border-b flex flex-wrap gap-2">
                                <a href="{{ route('users.editRole', $user->id) }}"
                                   class="px-2 sm:px-3 py-1 text-xs sm:text-sm bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                                    Edit
                                </a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700 transition">
                                        Delete
                                    </button>
                                </form>

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

    {{-- ✅ AlpineJS toggle script --}}
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('userTable', () => ({
                toggleUser(id, isActive) {
                    fetch(`/users/${id}/toggle-active`, {
                        method: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ is_active: isActive }),
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (!data.success) {
                            alert('Failed to update user status.');
                        }
                    })
                    .catch(err => console.error('Error:', err));
                }
            }))
        })
    </script>
</x-admin-layout>
