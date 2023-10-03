<x-handmail::modal name="create-template" max-width="sm">
    <x-slot:heading>
        Create Template
    </x-slot:heading>

    <form wire:submit.prevent="store">
        <div>
            <label for="template-name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
            <div class="mt-2">
            <input name="template-name" id="template-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" wire:model="name">
            </div>
            @error('name') <span class="mt-2 text-sm text-red-600">{{ $message }}</span> @enderror
        </div>
    
        <div class="mt-4">
            <x-handmail::primary-button type="submit">
                Create
            </x-handmail::primary-button>
        </div>
    </form>
</x-handmail::modal>
