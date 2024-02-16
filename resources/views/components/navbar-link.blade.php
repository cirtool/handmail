@props(['to' => '#', 'activeWhen' => []])

@php
    foreach ($activeWhen as $value) {
        $activeWhen[] = "$value/*";
    }
@endphp

<a 
    href="{{ $to }}"
    @class([
        
        'text-gray-500 inline-flex items-center px-1 pt-1 text-sm font-medium', 
        'hover:text-gray-700 dark:hover:text-pink-300 dark:text-pink-200' => ! Request::is($activeWhen),
        'text-pink-500' => Request::is($activeWhen)
    ])
    @if (Request::is($activeWhen))
        aria-current="page"
    @endif
>
    {{ $slot }}
</a>
