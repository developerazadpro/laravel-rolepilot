<x-app-layout>
    <div class="max-w-3xl mx-auto p-4 sm:p-6 lg:p-8 bg-white shadow rounded">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold">Edit Role</h2>
            <a href="{{ route('roles.index') }}"
               class="px-4 py-2 bg-gray-500 text-white text-sm font-semibold rounded hover:bg-gray-600">
                ← Back
            </a>
        </div>

        <form method="POST" action="{{ route('roles.update', $role) }}">
            @csrf
            @method('PUT')

            <!-- Role Name -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Role Name</label>
                <input type="text" name="name" id="name"
                       value="{{ old('name', $role->name) }}"
                       class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                       required>
                @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Permissions -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Permissions</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 p-3 border rounded bg-gray-50">
                    @foreach($permissions as $permission)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox"
                                   name="permissions[]"
                                   value="{{ $permission->name }}"
                                   {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}
                                   class="text-blue-600 border-gray-300 rounded shadow-sm">
                            <span class="text-sm text-gray-700">{{ $permission->name }}</span>
                        </label>
                    @endforeach
                </div>
                @error('permissions')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('roles.index') }}"
                   class="px-4 py-2 bg-gray-500 text-white text-sm font-semibold rounded hover:bg-gray-600">
                    Cancel
                </a>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded hover:bg-blue-700">
                    Update
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
