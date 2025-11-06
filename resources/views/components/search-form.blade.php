@props([
    'route',
    'search' => '', // Current search value
    'placeholder' => 'Search...',
    'widthClass' => 'w-full sm:w-1/2'
])

<div class="{{ $widthClass }}">
    <form method="GET" action="{{ route($route) }}" class="flex w-full sm:w-auto">
        <input type="text" name="search" value="{{ $search }}"
               placeholder="{{ $placeholder }}"
               class="flex-grow border-green-300 rounded-l-md focus:ring-green-500 focus:border-green-500">
        <button type="submit" class="px-3 bg-green-600 text-white rounded-r-md hover:bg-green-700">
            Search
        </button>
    </form>
</div>
