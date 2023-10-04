<div>
  <x-handmail::header title="Email Templates" description="Lorem ipsum dolor sit amet, consectetur adipiscing elit.">
    <x-handmail::primary-button x-data x-on:click="$store.modals.open('create-template')">
      Create Template
    </x-handmail::primary-button>
  </x-handmail::header>

  <x-handmail::table>
    <x-slot:head>
      <tr>
        <x-handmail::th>
          Name
        </x-handmail::th>
        <x-handmail::th>
          Created At
        </x-handmail::th>
        <x-handmail::th>
          Updated At
        </x-handmail::th>
        <x-handmail::th>
          
        </x-handmail::th>
      </tr>
    </x-slot:head>
    <x-slot:body>
      @forelse ($templates as $template)
        <tr wire:key="template-record-{{ $template->uuid }}">
          <x-handmail::td :is-primary="true">
            {{ $template->name }}
          </x-handmail::td>

          <x-handmail::td>
            {{ $template->created_at }}
          </x-handmail::td>

          <x-handmail::td>
            {{ $template->updated_at }}
          </x-handmail::td>

          <x-handmail::td>
            <a 
              href="{{ route('handmail.edit-template', ['template' => $template]) }}" 
              class="text-indigo-600 hover:text-indigo-900"
            >
              Edit<span class="sr-only">, {{ $template->name }}</span>
            </a>
          </x-handmail::td>
        </tr>
      @empty
        <tr>
          <td colspan="4">No templates found.</td>
        </tr>
      @endforelse
    </x-slot:body>
  </x-handmail::table>

  <div class="mt-6">
    {{ $templates->links('handmail::components.pagination') }}
  </div>

  @livewire('handmail::create-template')
</div>
