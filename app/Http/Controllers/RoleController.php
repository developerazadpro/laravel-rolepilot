<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Spatie\Permission\Models\Permission;
use App\Models\Permission;
//use Spatie\Permission\Models\Role;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $roles = Role::when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%");
        })
        ->orderBy('name')
        ->paginate(10)
        ->withQueryString();

        return view('admin.roles.index', compact('roles', 'search'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | unique:roles,name',
            'permissions' => 'array|nullable',
        ]);

        // Create the role
        $role = Role::create(['name' => $request->name]);

        // Assign permissions if provided
        $assignedPermissions = [];
        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
            $assignedPermissions = $request->permissions;
        }

        // Log creation with assigned permissions
        activity()
            ->causedBy(Auth::user())
            ->performedOn($role)
            ->event('created')
            ->withProperties([
                'role' => $role->name,
                'permissions' => $assignedPermissions,
            ])
            ->log("Created new role '{$role->name}' with permissions: " . implode(', ', $assignedPermissions));


        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,'. $role->id,
            'permissions' => 'array|nullable',
        ]);

        // Capture old data before updating
        $oldName = $role->name;
        $oldPermissions = $role->permissions->pluck('name')->toArray();

        // Update role name
        $role->update(['name' => $request->name]);

        // Sync new permissions
        $newPermissions = $request->permissions ?? [];
        $role->syncPermissions($newPermissions);

        // Log role update
        activity()
            ->causedBy(Auth::user())
            ->performedOn($role)
            ->event('updated')
            ->withProperties([
                'old' => [
                    'name' => $oldName,
                    'permissions' => $oldPermissions,
                ],
                'new' => [
                    'name' => $role->name,
                    'permissions' => $newPermissions,
                ],
            ])
            ->log("Updated role '{$role->name}' — name/permissions changed.");

        return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully.');
    }
}
