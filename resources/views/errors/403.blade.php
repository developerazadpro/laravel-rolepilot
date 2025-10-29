<x-admin-layout>
    <div class="max-w-3xl mx-auto p-6 mt-10 bg-white shadow rounded text-center">
        <h1 class="text-4xl font-bold text-red-600 mb-4">403</h1>
        <p class="text-gray-700 mb-6">You do not have permission to access this page.</p>
        <a href="{{ route('dashboard') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            Go to Dashboard
        </a>
    </div>
</x-admin-layout>
