<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Spatie\Permission\Models\Permission;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $permissions = Permission::when($search, function ($query, $search){
            $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.permissions.index', compact('permissions', 'search'));
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        Permission::create(['name' => $request->name]);

        return redirect()->route('admin.permissions.index')
                         ->with('success', 'Permission created successfully.');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('admin.permissions.index')
                         ->with('success', 'Permission deleted successfully.');
    }
}
