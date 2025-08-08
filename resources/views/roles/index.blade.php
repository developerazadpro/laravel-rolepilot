<x-app-layout>
    <div class="max-w-5xl mx-auto p-4 sm:p-6 lg:p-8 bg-white shadow rounded">

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold">Roles</h2>
            <a href="{{ route('roles.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                + Add Role
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3 text-green-700 bg-green-100 rounded">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full border border-gray-200">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-4 py-2 border-b">#</th>
                    <th class="px-4 py-2 border-b">Role Name</th>
                    <th class="px-4 py-2 border-b">Permissions</th>
                    <th class="px-4 py-2 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($roles as $role)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $role->name }}</td>
                        <td class="px-4 py-2">
                            @if($role->permissions->count())
                                <span class="text-sm text-gray-700">
                                    {{ $role->permissions->pluck('name')->join(', ') }}
                                </span>
                            @else
                                <span class="text-sm text-gray-400 italic">No permissions</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 flex space-x-2">
                            <a href="{{ route('roles.edit', $role) }}"
                               class="px-3 py-1 bg-yellow-500 text-white text-sm rounded hover:bg-yellow-600">
                                Edit
                            </a>
                            <form action="{{ route('roles.destroy', $role) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this role?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-3 text-center text-gray-500 italic">
                            No roles found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
