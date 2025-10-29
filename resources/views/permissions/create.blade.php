<x-admin-layout>
    <x-slot name="breadcrumb">
        <nav class="text-gray-500 text-sm">
            <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a> &gt; Permissions
        </nav>
    </x-slot>

    <div class="max-w-3xl mx-auto p-4 sm:p-6 lg:p-8 bg-white shadow rounded">

        <h2 class="text-xl sm:text-2xl font-semibold mb-4 sm:mb-6">Create Permission</h2>

        <form method="POST" action="{{ route('permissions.store') }}">
            @csrf

            <div class="mb-4 sm:mb-6">
                <label for="name" class="block text-sm sm:text-base font-medium text-gray-700 mb-1">Permission Name</label>
                <input type="text" name="name" id="name"
                       class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base"
                       required>
                @error('name')
                    <p class="text-xs sm:text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col sm:flex-row justify-between gap-2">
                <a href="{{ route('permissions.index') }}"
                   class="px-4 py-2 bg-gray-500 text-white text-sm sm:text-base font-semibold rounded hover:bg-gray-600 text-center">
                    Cancel
                </a>
                <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white text-sm sm:text-base font-semibold rounded hover:bg-green-700">
                    Create
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
