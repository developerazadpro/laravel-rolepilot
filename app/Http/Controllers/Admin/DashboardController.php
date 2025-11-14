<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function index()
    {
        // Summary Cards
        $userCount = User::count();
        $roleCount = Role::count();
        $permissionCount = Permission::count();
        $logCount = Activity::count();

        // Users per Role (for pie chart)
        $roles = Role::withCount('users')->get();
        $roleLabels = $roles->pluck('name')->toArray();
        $roleData = $roles->pluck('users_count')->toArray();

        // Activity Overview (last 7 days)
        $activityData = [];
        $activityLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $day = now()->subDays($i);

            $start = $day->copy()->startOfDay();
            $end   = $day->copy()->endOfDay();

            $count = Activity::whereBetween('created_at', [$start, $end])->count();

            $activityLabels[] = $day->format('D');
            $activityData[] = $count;            
        }
        // Recent Activities
        $recentLogs = Activity::latest()->take(5)->get();
        //dd($recentLogs);
        

        return view('admin.dashboard', compact(
            'userCount', 'roleCount', 'permissionCount', 'logCount',
            'roleLabels', 'roleData', 'activityLabels', 'activityData', 'recentLogs'
        ));
    }
}
