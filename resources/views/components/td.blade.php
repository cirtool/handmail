@props(['isPrimary' => false])

@php
    $class = $isPrimary ? 'font-medium text-gray-900 dark:text-pink-100' : 'text-gray-500 dark:text-pink-100 dark:opacity-75';
    $class .= ' hitespace-nowrap border-b border-gray-200 dark:border-zinc-700 py-4 pl-4 pr-3 text-sm sm:pl-6 lg:pl-8';
@endphp

<td 
    {{ $attributes->merge(['class' => $class]) }}
>
    {{ $slot }}
</td>
