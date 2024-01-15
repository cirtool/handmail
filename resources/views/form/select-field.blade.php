<div>
    <label class="block text-sm font-medium leading-6 text-gray-900">
        {{ __($label) }}
    </label>
    <div class="mt-2">
        <select 
            wire:model="{{ $context['model'] . '.value' }}"
            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
        >
            @if ($emptyOption)
                <option selected>
                    {{ $emptyOption }}
                </option>
            @endif
            @foreach ($options as $value => $option)
                <option value="{{ $value }}">
                    {{ $option }}
                </option>
            @endforeach
        </select>
    </div>
</div>
