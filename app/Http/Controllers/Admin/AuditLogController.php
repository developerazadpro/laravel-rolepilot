<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class AuditLogController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $logs = Activity::with('causer') // causer is the user who performed the action
        ->when($search, function ($query, $search) {
            $query->whereHas('causer', function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->orWhere('description', 'like', "%{$search}%")
            ->orWhere('subject_type', 'like', "%{$search}%");
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

        return view('admin.audit-logs.index', compact('logs', 'search'));
    }
}
