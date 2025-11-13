<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
//use Spatie\Permission\Models\Permission;
use App\Models\Permission;
//use Spatie\Permission\Models\Role;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::with('roles')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', compact('users', 'search'));
    }


    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'nullable|string'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        if (!empty($validated['role'])) {
            $user->assignRole($validated['role']);
        }

        return redirect()->route('admin.users.index')->with('success', 'User created successfully!');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        //$permissions = Permission::all();
        
        // Group permissions by module (e.g. Users, Roles, Menus)
        $permissions = Permission::all()->groupBy(function ($permission) {
            $parts = explode(' ', $permission->name);
            return ucfirst(end($parts)); // e.g. "Users"
        });
        $userPermissions = $user->permissions->pluck('name')->toArray();

        return view('admin.users.edit', compact('user', 'roles', 'permissions', 'userPermissions'));
    }

    /* public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,name',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        $user->syncRoles([$request->role]);
        $user->syncPermissions($request->permissions ?? []);

        return redirect()->route('admin.users.index')->with('success', 'Role and permissions updated successfully!');
    } */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,name',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        // Capture old roles & permissions before updating
        $oldRoles = $user->getRoleNames();
        $oldPermissions = $user->getPermissionNames();

        // Apply new role and permissions
        $user->syncRoles([$request->role]);
        $user->syncPermissions($request->permissions ?? []);

        // Capture updated roles & permissions
        $newRoles = $user->getRoleNames();
        $newPermissions = $user->getPermissionNames();

        // Log the change in Spatie Activity Log
        activity()
            ->causedBy(Auth::user()) // Who made the change
            ->performedOn($user)       // Which user was modified
            ->event('updated')         // Type of event
            ->withProperties([
                'old' => [
                    'roles' => $oldRoles,
                    'permissions' => $oldPermissions,
                ],
                'new' => [
                    'roles' => $newRoles,
                    'permissions' => $newPermissions,
                ],
            ])
            ->log("Updated roles and permissions for user: {$user->name}");

        return redirect()->route('admin.users.index')->with('success', 'Role and permissions updated successfully!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    public function toggleActive(User $user)
    {
        $user->is_active = !$user->is_active; // flip status
        $user->save();

        return response()->json([
            'success' => true,
            'status' => $user->is_active ? 'active' : 'inactive',
        ]);
    }


}
