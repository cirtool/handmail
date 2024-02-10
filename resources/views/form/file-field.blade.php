<div>
    <label class="block text-sm font-medium leading-6 text-gray-900 mb-1">
        {{ __($label) }}
    </label>
    @livewire('handmail::file-uploader', ['context' => $context], key($context['model']))
</div>
