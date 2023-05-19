@props(['active', 'icon'])

@php
$classes = ($active ?? false)
            ? 'flex items-center px-6 py-2 mt-4 text-gray-100 bg-gray-700 bg-opacity-25'
            : 'flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <i class="bx {{ $icon }}"></i>
    <span class="mx-3">{{ $slot }}</span>
</a>
