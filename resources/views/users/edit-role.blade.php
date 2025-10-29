<x-admin-layout>
    <x-slot name="breadcrumb">
        <nav class="text-gray-500 text-sm">
            <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a> &gt; Users
        </nav>
    </x-slot>

    <div class="max-w-3xl mx-auto p-4 sm:p-6 bg-white shadow rounded">

        <h2 class="text-xl sm:text-2xl font-semibold mb-4 sm:mb-6 text-gray-800">
            Edit Role & Permissions for {{ $user->name }}
        </h2>

        <form method="POST" action="{{ route('users.updateRole', $user->id) }}">
            @csrf
            @method('PUT')

            <!-- Select Role -->
            <div class="mb-4 sm:mb-6">
                <label for="role" class="block text-sm font-medium text-gray-700 mb-1 sm:mb-2">Select Role</label>
                <select id="role" name="role"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base"
                        required>
                    <option value="">-- Choose Role --</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
                @error('role')
                    <p class="text-xs sm:text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Direct Permissions -->
            <div class="mb-4 sm:mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1 sm:mb-2">Assign Direct Permissions</label>
                <p class="text-xs text-gray-500 mb-2 sm:mb-3">
                    These permissions are applied <strong>in addition</strong> to the role’s permissions.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                    @foreach($permissions as $permission)
                        <label class="inline-flex items-center text-sm sm:text-base">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                   class="text-blue-600 border-gray-300 rounded shadow-sm focus:ring-blue-500"
                                   {{ in_array($permission->name, $userPermissions ?? []) ? 'checked' : '' }}>
                            <span class="ml-2">{{ $permission->name }}</span>
                        </label>
                    @endforeach
                </div>
                @error('permissions')
                    <p class="text-xs sm:text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row justify-between gap-2">
                <a href="{{ route('users.index') }}"
                   class="px-4 py-2 bg-gray-500 text-white text-sm font-semibold rounded hover:bg-gray-600 transition text-center">
                    Cancel
                </a>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded hover:bg-blue-700 transition">
                    Update
                </button>
            </div>

        </form>
    </div>
</x-admin-layout>
