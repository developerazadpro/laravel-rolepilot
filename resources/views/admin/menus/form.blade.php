<x-admin-layout>
    <x-slot name="breadcrumb">
        <nav class="text-gray-500 text-sm">
            <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a> &gt;
            <a href="{{ route('admin.menus.index') }}" class="hover:underline">Menus</a> &gt;
            {{ isset($menu->id) ? 'Edit' : 'Create' }}
        </nav>
    </x-slot>

    <div class="max-w-3xl mx-auto p-6 bg-white shadow rounded">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800">
            {{ isset($menu->id) ? 'Edit Menu' : 'Create New Menu' }}
        </h2>

        <form 
            action="{{ isset($menu->id) ? route('admin.menus.update', $menu->id) : route('admin.menus.store') }}" 
            method="POST"
        >
            @csrf
            @if(isset($menu->id))
                @method('PUT')
            @endif

            <!-- Menu Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                    Menu Name <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="name" required
                       value="{{ old('name', $menu->name ?? '') }}"
                       class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Route Name -->
            <div class="mb-4">
                <label for="route" class="block text-sm font-medium text-gray-700 mb-1">Route Name</label>
                <input type="text" name="route" id="route" 
                       value="{{ old('route', $menu->route ?? '') }}"
                       placeholder="e.g. users.index"
                       class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <p class="text-xs text-gray-500 mt-1">
                    Leave blank for parent menus that have submenus.
                </p>
            </div>

            <!-- Parent Menu -->
            <div class="mb-4">
                <label for="parent_id" class="block text-sm font-medium text-gray-700 mb-1">
                    Parent Menu
                </label>
                <select name="parent_id" id="parent_id" 
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">— None (Top Level Menu) —</option>
                    @foreach($parents as $parent)
                        <option value="{{ $parent->id }}"
                            {{ old('parent_id', $menu->parent_id ?? '') == $parent->id ? 'selected' : '' }}>
                            {{ $parent->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Icon -->
            <div class="mb-4">
                <label for="icon" class="block text-sm font-medium text-gray-700 mb-1">Icon Name</label>
                <input type="text" name="icon" id="icon"
                       value="{{ old('icon', $menu->icon ?? '') }}"
                       placeholder="e.g. lucide-home or heroicon-o-users"
                       class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <p class="text-xs text-gray-500 mt-1">
                    Use icon class name (Lucide or Heroicons). Leave blank for submenu.
                </p>
            </div>

            <!-- Permission -->
            <div class="mb-4">
                <label for="permission_name" class="block text-sm font-medium text-gray-700 mb-1">
                    Permission Name
                </label>
                <select name="permission_name" id="permission_name"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">— None —</option>
                    @foreach(Spatie\Permission\Models\Permission::orderBy('name')->get() as $permission)
                        <option value="{{ $permission->name }}"
                            {{ old('permission_name', $menu->permission_name ?? '') == $permission->name ? 'selected' : '' }}>
                            {{ $permission->name }}
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">
                    Menu will only show for users who have this permission.
                </p>
            </div>

            <!-- Order -->
            <div class="mb-6">
                <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Order</label>
                <input type="number" name="order" id="order"
                       value="{{ old('order', $menu->order ?? '') }}"
                       placeholder="Optional — for sorting"
                       class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Active Status -->
            <div class="mb-4 flex items-center">
                <input type="checkbox" name="is_active" id="is_active"
                    class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                    value="1" {{ old('is_active', $menu->is_active ?? true) ? 'checked' : '' }}>
                <label for="is_active" class="ml-2 text-sm font-medium text-gray-700">
                    Active
                </label>
            </div>


            <!-- Action Buttons -->
            <div class="flex justify-between">
                <a href="{{ route('admin.menus.index') }}"
                   class="px-4 py-2 bg-gray-500 text-white text-sm font-semibold rounded hover:bg-gray-600 transition">
                    Cancel
                </a>

                <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded hover:bg-green-700 transition">
                    {{ isset($menu->id) ? 'Update Menu' : 'Create Menu' }}
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
