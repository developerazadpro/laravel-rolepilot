@props([
    'module', // e.g. 'users'
    'label'
])

<div class="flex items-center gap-2">
    {{-- Add New --}}
    <x-action-button
        :permission="perm($module, 'create')"
        :route="route('admin.' . $module . '.create')"
        :label="$label"
        type="primary"
    />

</div>
