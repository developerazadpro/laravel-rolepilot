<x-app-layout>
    <div class="max-w-3xl mx-auto p-4 sm:p-6 lg:p-8 bg-white shadow rounded">

        <h2 class="text-2xl font-semibold mb-6">Edit Role for {{ $user->name }}</h2>

        <form method="POST" action="{{ route('users.updateRole', $user->id) }}">
            @csrf
            @method('PUT')

            <!-- Select Role -->
            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Select Role</label>
                <select id="role" name="role"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                    <option value="">-- Choose Role --</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
                @error('role')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-between">
                <a href="{{ route('users.index') }}"
                   class="px-4 py-2 bg-gray-500 text-white text-sm font-semibold rounded hover:bg-gray-600">
                    Cancel
                </a>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded hover:bg-blue-700">
                    Update Role
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
