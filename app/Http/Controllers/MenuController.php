<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $menus = Menu::with('children')->whereNull('parent_id')->orderBy('order')->get();
        return view('admin.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $parents = Menu::whereNull('parent_id')->get(); // For parent dropdown
        $permissions = Permission::all(); // For permission assignment
        return view('admin.menus.create', compact('parents', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'route' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:menus,id',
            'order' => 'nullable|integer',
            'permission_name' => 'nullable|string|max:255',
        ]);
        Menu::create($data);
        return redirect()->route('admin.menus.index')->with('success', 'Menu created successfully.');
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
    public function edit(Menu $menu) {
        $parents = Menu::whereNull('parent_id')->where('id', '!=', $menu->id)->get();
        $permissions = Permission::all();
        return view('admin.menus.edit', compact('menu', 'parents', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'route' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:menus,id',
            'order' => 'nullable|integer',
            'permission_name' => 'nullable|string|max:255',
        ]);
        $menu->update($data);
        return redirect()->route('admin.menus.index')->with('success', 'Menu updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu) {
        $menu->delete();
        return redirect()->route('admin.menus.index')->with('success', 'Menu deleted successfully.');
    }
}
