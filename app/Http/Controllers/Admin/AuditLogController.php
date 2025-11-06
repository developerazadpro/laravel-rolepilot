<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class AuditLogController extends Controller
{
    public function index()
    {
        $logs = Activity::with('causer') // causer is user who performed action
                        ->latest()
                        ->paginate(10);

        return view('admin.audit-logs.index', compact('logs'));
    }
}
