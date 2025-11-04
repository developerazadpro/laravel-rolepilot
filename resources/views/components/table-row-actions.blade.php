@props(['module', 'id']) {{-- module: 'users' --}}

<div class="flex items-center gap-2">   
    @canany([perm($module, 'edit'), perm($module, 'delete')])
        {{-- Edit --}}
        @can(perm($module, 'edit'))
            <a href="{{ route('admin.' . $module . '.edit', $id) }}" class="px-2 sm:px-3 py-1 text-xs sm:text-sm bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                Edit
            </a>
        @endcan

        {{-- Delete --}}
        @can(perm($module, 'delete'))
            <form action="{{ route('admin.' . $module . '.destroy', $id) }}" method="POST" 
                onsubmit="return confirm('Are you sure you want to delete this user?');" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700 transition">
                    Delete
                </button>
            </form>
        @endcan
    @else
        <span class="px-2 sm:px-3 py-1 text-sm text-gray-400 italic">
            No actions available
        </span>
    @endcanany
</div>
