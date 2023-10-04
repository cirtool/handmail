<x-handmail::modal name="create-template" max-width="sm">
    <x-slot:heading>
        Create Template
    </x-slot:heading>

    <form wire:submit.prevent="store">
        <x-handmail::input label="Template Name" wire:model="name" />
    
        <div class="mt-4">
            <x-handmail::primary-button type="submit">
                Create
            </x-handmail::primary-button>
        </div>
    </form>
</x-handmail::modal>
