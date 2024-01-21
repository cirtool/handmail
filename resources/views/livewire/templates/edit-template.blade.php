<x-handmail::email-editor 
  class="flex-1"
  :tabs="['settings' => 'Additional Settings']"
>
  <x-handmail::tab-item name="settings">
    <x-handmail::input label="Template Name" wire:model="template.name" />
  </x-handmail::tab-item>

  <x-slot:footer>
    <x-handmail::primary-button wire:click.prevent="save">
      Save
    </x-handmail::primary-button>
    <x-handmail::primary-button wire:click.prevent="download">
      Download
    </x-handmail::primary-button>
  </x-slot:footer>
</x-handmail::email-editor>
