@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center px-4 py-2 rounded-lg bg-blue-600 text-white font-semibold transition-colors duration-150 ease-in-out'
            : 'flex items-center px-4 py-2 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-600 transition-colors duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
