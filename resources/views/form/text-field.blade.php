<div>
    <label class="block text-sm font-medium leading-6 text-gray-900 dark:text-pink-100">
        {{ __($label) }}
    </label>
    <div class="mt-2">
        <input 
            type="text" 
            wire:model="{{ $context['model'] . '.value' }}"
            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-md ring-0 sm:text-sm sm:leading-6 dark:bg-zinc-800 focus:ring-0 focus:shadow-pink-800/20 transition-all dark:text-pink-200 focus:outline-0" 
        >
    </div>
</div>
