<x-admin-layout>
    <x-slot name="breadcrumb">
        <nav class="text-gray-500 text-sm">
            <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a> &gt; Audit Logs
        </nav>
    </x-slot>

    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <h2 class="text-xl sm:text-2xl font-semibold mb-4">Audit Logs</h2>

        <!-- Search and Filter -->
        <div class="flex flex-col sm:flex-row sm:justify-end sm:items-center mb-4 gap-2">            
        
            <form method="GET" action="{{ route('admin.logs.index') }}" class="w-full sm:w-1/2 flex">
                <input type="text" name="search" value="{{ $search ?? '' }}"
                    placeholder="Search logs..."
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
                        <th class="text-left py-2 px-3 sm:py-2 sm:px-4 border-b">User</th>
                        <th class="text-left py-2 px-3 sm:py-2 sm:px-4 border-b">Action</th>
                        <th class="text-left py-2 px-3 sm:py-2 sm:px-4 border-b">Model</th>
                        <th class="text-left py-2 px-3 sm:py-2 sm:px-4 border-b">Details</th>
                        <th class="text-left py-2 px-3 sm:py-2 sm:px-4 border-b">IP</th>
                        <th class="text-left py-2 px-3 sm:py-2 sm:px-4 border-b">When</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-3 sm:py-2 sm:px-4 border-b break-words">{{ $log->causer->name ?? 'System' }}</td>
                            <td class="py-2 px-3 sm:py-2 sm:px-4 border-b break-words">{{ $log->description }}</td>
                            <td class="py-2 px-3 sm:py-2 sm:px-4 border-b break-words">
                                {{ class_basename($log->subject_type ?? $log->subject_type) }}
                                {{ $log->subject_id ? "#{$log->subject_id}" : '' }}
                            </td>
                            <td class="py-2 px-3 sm:py-2 sm:px-4 border-b break-words">
                                @if($log->properties && $log->properties->isNotEmpty())
                                    <pre class="text-xs">{{ json_encode($log->properties->toArray(), JSON_PRETTY_PRINT) }}</pre>
                                @endif
                            </td>
                            <td class="py-2 px-3 sm:py-2 sm:px-4 border-b break-words">{{ $log->ip ?? $log->properties['ip'] ?? '' }}</td>
                            <td class="py-2 px-3 sm:py-2 sm:px-4 border-b break-words">{{ $log->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-4 text-center text-gray-500">No logs yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $logs->links() }}
        </div>
    </div>
</x-admin-layout>
