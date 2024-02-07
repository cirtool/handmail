<div>
    <label class="block text-sm font-medium leading-6 text-gray-900">
        {{ __($label) }}
    </label>
    <div class="mt-2">
        <input 
            type="color" 
            wire:model="{{ $context['model'] . '.value' }}"
            class="block w-full rounded-md border-0 text-gray-900 py-0.5 px-0.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 bg-white h-8" 
        >
    </div>
</div>
