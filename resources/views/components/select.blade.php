@props(['label' => null])

@php
    $model = $attributes->whereStartsWith('wire:model')->first();
@endphp

<div>
    @if ($label !== null)
        <label for="{{ $model }}" class="block text-sm font-medium leading-6 text-gray-900 mt-2 ">
            {{ $label }}
        </label>
    @endif
    <select 
        name="{{ $model }}" 
        id="{{ $model }}" 
        {{ $attributes->merge(['class' => 'block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6']) }}>
      {{ $slot }}
    </select>
  </div>
