<x-handmail::modal name="create-template" max-width="lg">
    <x-slot:heading>
        Create Template
    </x-slot:heading>

    <form wire:submit.prevent="store" class="space-y-2">
        <x-handmail::input label="Template Name" wire:model.defer="name" />

        <x-handmail::select wire:model.defer="layout" label="Layout">
            @foreach (Handmail::getLayouts() as $layout)
            <option value="{{ $layout->name }}">
                {{ $layout->label }}
            </option>
            @endforeach
        </x-handmail::select>
    
        <div class="mt-4">
            <x-handmail::primary-button type="submit">
                Create
            </x-handmail::primary-button>
        </div>
    </form>
</x-handmail::modal>
