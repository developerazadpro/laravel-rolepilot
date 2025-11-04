@props([
    'permission',   // permission string (use perm('users','create'))
    'route' => '#', // url
    'label' => 'Action',
    'type' => 'primary',
    'icon' => null,
])

@can($permission)
    <a href="{{ $route }}" {{ $attributes->merge([
            'class' => 'inline-flex items-center px-4 py-2 text-white text-sm font-semibold rounded shadow transition ' .
                       ($type === 'primary' ? 'bg-blue-600 hover:bg-blue-700 transition' :
                        ($type === 'warning' ? 'bg-yellow-500 hover:bg-yellow-600 transition' :
                        ($type === 'danger' ? 'bg-red-600 hover:bg-red-700 transition' :
                        'bg-blue-600 hover:bg-blue-700 transition')))
    ]) }}>
        + {{ $label }}
    </a>
@endcan
