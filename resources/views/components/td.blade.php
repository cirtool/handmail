@props(['isPrimary' => false])

@php
    $class = $isPrimary ? 'font-medium text-gray-900' : 'text-gray-500';
@endphp

<td 
    @class([
        'hitespace-nowrap border-b border-gray-200 py-4 pl-4 pr-3 text-sm sm:pl-6 lg:pl-8', 
        $class
    ])
>
    {{ $slot }}
</td>
