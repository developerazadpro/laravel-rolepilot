<x-admin-layout>
    <div class="space-y-6">

        <!--  Page Header -->
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
            <p class="text-sm text-gray-500">Welcome back, {{ auth()->user()->name ?? 'User' }} 👋</p>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <x-dashboard.card title="Users" icon="users" :count="$userCount" color="blue" />
            <x-dashboard.card title="Roles" icon="shield" :count="$roleCount" color="green" />
            <x-dashboard.card title="Permissions" icon="lock" :count="$permissionCount" color="purple" />
            <x-dashboard.card title="Audit Logs" icon="file-text" :count="$logCount" color="orange" />
        </div>


        <!-- Charts Section Wrapper -->
        <div class="flex flex-col xl:flex-row xl:space-x-6 space-y-6 xl:space-y-0">
            <!-- Users Per Role Chart -->
            <div class="bg-white rounded-2xl shadow p-4 w-full xl:w-[50%]">
                <h2 class="text-lg font-semibold mb-3 text-gray-700">Users per Role</h2>
                <div class="h-64">
                    <canvas id="usersPerRoleChart"></canvas>
                </div>
            </div>

            <!-- Activity Chart -->
            <div class="bg-white rounded-2xl shadow p-4 w-full xl:w-[50%] mt-6 xl:mt-0">
                <h2 class="text-lg font-semibold mb-3 text-gray-700">Activity Overview (Last 7 Days)</h2>
                <div class="h-64">
                    <canvas id="activityChart"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Recent Activity Feed -->
        <div class="bg-white rounded-2xl shadow p-4">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-lg font-semibold text-gray-700">Recent Activities</h2>
                <a href="{{ route('admin.logs.index') }}" class="text-sm text-blue-600 hover:underline">View all</a>
            </div>

            <ul class="divide-y divide-gray-100 text-sm text-gray-600">
                @forelse($recentLogs as $log)
                    @php
                        // Determine causer
                        $causerName = optional($log->causer)->name ?? 'System';
                        $emoji = $log->causer ? '👤' : '⚙️';

                        // Subject type name
                        $subjectName = class_basename($log->subject_type);
                    @endphp

                    <li class="py-2">
                        {{ $emoji }} <strong>{{ $causerName }}</strong> 
                        {{ $log->description }} 
                        <strong>{{ $subjectName }}#{{ $log->subject_id }}</strong>
                        <span class="text-xs text-gray-400">({{ $log->created_at->diffForHumans() }})</span>
                    </li>
                @empty
                    <li class="py-2 text-gray-400">No recent activities found.</li>
                @endforelse
            </ul>
        </div>



        <!--  Quick Actions -->
        <div class="bg-white rounded-2xl shadow p-4">
            <h2 class="text-lg font-semibold mb-3 text-gray-700">Quick Actions</h2>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.roles.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">➕ Create Role</a>
                <a href="{{ route('admin.permissions.create') }}" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">➕ Create Permission</a>
                <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">👥 Manage Users</a>
                <a href="{{ route('admin.logs.index') }}" class="px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-800">📜 View Logs</a>
            </div>
        </div>

    </div>

    <!--  Chart.js Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const usersPerRoleCtx = document.getElementById('usersPerRoleChart').getContext('2d');

        // Convert PHP arrays to JS arrays
        const roleLabels = {!! json_encode($roleLabels) !!};
        const roleData   = {!! json_encode($roleData) !!};
        
        new Chart(usersPerRoleCtx, {
            type: 'pie',
            data: {
                labels: roleLabels,
                datasets: [{
                    data: roleData,
                    backgroundColor: ['#3B82F6', '#10B981', '#F59E0B', '#8B5CF6', '#F43F5E'],
                }]
            },
            options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
        });

        const activityCtx = document.getElementById('activityChart').getContext('2d');

        // Convert PHP arrays to JS arrays
        const activityLabels = {!! json_encode($activityLabels) !!};
        const activityData = {!! json_encode($activityData) !!};

        new Chart(activityCtx, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: activityLabels,
                    data: activityData,
                    borderColor: '#6366F1',
                    tension: 0.4,
                    fill: true,
                    backgroundColor: 'rgba(99, 102, 241, 0.1)',
                }]
            },
            options: { responsive: true, scales: { y: { beginAtZero: true } } }
        });
    </script>
</x-admin-layout>
