<div>
  <x-handmail::header title="Email Templates" description="Lorem ipsum dolor sit amet, consectetur adipiscing elit.">
    <x-handmail::primary-button x-data x-on:click="$store.modals.open('create-template')">
      Create Template
    </x-handmail::primary-button>
  </x-handmail::header>

  <div class="px-4 sm:px-6 lg:px-8">
    <div class="mt-2 flow-root">
      <div class="-mx-4 -my-2 sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full align-middle ring-1 ring-black ring-opacity-5 sm:rounded-lg" style="overflow: clip">
          <table class="min-w-full border-separate border-spacing-0">
            <thead>
              <tr>
                <th scope="col" class="sticky top-12 z-10 border-b border-gray-300 bg-white bg-opacity-75 py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:pl-6 lg:pl-8">Name</th>

                <th scope="col" class="sticky top-12 z-10 border-b border-gray-300 bg-white bg-opacity-75 py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:pl-6 lg:pl-8">Created At</th>

                <th scope="col" class="sticky top-12 z-10 border-b border-gray-300 bg-white bg-opacity-75 py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:pl-6 lg:pl-8">Updated At</th>
                
                <th scope="col" class="sticky top-12 z-10 border-b border-gray-300 bg-white bg-opacity-75 py-3.5 pl-3 pr-4 backdrop-blur backdrop-filter sm:pr-6 lg:pr-8 ">
                  <span class="sr-only">Edit</span>
                </th>
              </tr>
            </thead>
            <tbody>
              @forelse ($templates as $template)
                <tr wire:key="template-record-{{ $template->uuid }}">
                  <td class="whitespace-nowrap border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">{{ $template->name }}</td>

                  <td class="whitespace-nowrap border-b border-gray-200 py-4 pl-4 pr-3 text-sm text-gray-500 sm:pl-6 lg:pl-8">{{ $template->created_at }}</td>

                  <td class="whitespace-nowrap border-b border-gray-200 py-4 pl-4 pr-3 text-sm  text-gray-500 sm:pl-6 lg:pl-8">{{ $template->updated_at }}</td>

                  <td class="relative whitespace-nowrap border-b border-gray-200 py-4 pr-4 pl-3 text-right text-sm font-medium sm:pr-8 lg:pr-8">
                    <a href="{{ route('handmail.edit-template', ['template' => $template]) }}" class="text-indigo-600 hover:text-indigo-900">Edit<span class="sr-only">, {{ $template->name }}</span></a>
                  </td>
                </tr>
              @empty
                  <tr>
                    <td colspan="2">No templates found.</td>
                  </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    
  </div>

  <div class="mt-6">
    {{ $templates->links('handmail::components.pagination') }}
  </div>

  @livewire('handmail::create-template')
</div>
