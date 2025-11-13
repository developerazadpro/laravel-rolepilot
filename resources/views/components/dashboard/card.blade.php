@props(['title', 'count' => 0, 'icon' => 'info', 'color' => 'blue'])

@php
    $colorClasses = [
        'blue' => 'bg-blue-500',
        'green' => 'bg-green-500',
        'purple' => 'bg-purple-500',
        'orange' => 'bg-orange-500',
        'gray' => 'bg-gray-500',
    ];
@endphp

<div class="bg-white p-4 rounded-2xl shadow flex items-center justify-between">
    <div>
        <h3 class="text-sm text-gray-500 font-medium">{{ $title }}</h3>
        <p class="text-2xl font-bold text-gray-800 mt-1">{{ $count }}</p>
    </div>
    <div class="{{ $colorClasses[$color] ?? 'bg-gray-500' }} text-white p-3 rounded-full">
        <x-lucide-{{ $icon }} class="w-5 h-5" />
    </div>
</div>
