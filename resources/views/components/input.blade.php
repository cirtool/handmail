@props(['label'])

@php
    $model = $attributes->whereStartsWith('wire:model')->first();
@endphp

<div>
    <label for="{{ $model }}" class="block text-sm font-medium leading-6 text-gray-900">
        {{ $label }}
    </label>
    <div class="mt-2">
        <input 
            name="{{ $model }}" 
            id="{{ $model }}" 
            {{ $attributes->merge(['class' => 'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6']) }}
        >
    </div>
    @error('name') <span class="mt-2 text-sm text-red-600">{{ $message }}</span> @enderror
</div>
