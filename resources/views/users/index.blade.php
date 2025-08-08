<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">

        <h2 class="text-2xl font-semibold mb-4">Users</h2>

        @if(session('success'))
            <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="text-left py-2 px-4 border-b">Name</th>
                        <th class="text-left py-2 px-4 border-b">Email</th>
                        <th class="text-left py-2 px-4 border-b">Roles</th>
                        <th class="text-left py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border-b">{{ $user->name }}</td>
                            <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                            <td class="py-2 px-4 border-b">
                                @if($user->roles->count())
                                    {{ $user->roles->pluck('name')->join(', ') }}
                                @else
                                    <span class="text-gray-500 italic">No role assigned</span>
                                @endif
                            </td>
                            <td class="py-2 px-4 border-b space-x-2">
                                <a href="{{ route('users.editRole', $user->id) }}"
                                   class="inline-block px-3 py-1 text-sm bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                    Edit Role
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500 italic">
                                No users found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
