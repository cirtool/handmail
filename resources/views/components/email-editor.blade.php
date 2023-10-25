@props(['tabs' => [], 'footer'])

<div {{ $attributes->merge(['class' => 'flex flex-col md:flex-row']) }}>
  <div class="flex flex-col w-full max-w-2xl bg-white bg-opacity-75 backdrop-blur backdrop-filter border-r border-gray-200">
    <x-handmail::tabs 
      :items="array_merge(['blocks' => 'Email Blocks'], $tabs)"
      class="flex-1 px-4 sm:px-6 lg:px-8 sticky top-12 -mt-px"
    >
      <div class="px-4 sm:px-6 lg:px-8 py-4 flex-1">
        <x-handmail::tab-item name="blocks">
          <div x-data="{ openModal: false }">
            @foreach ($this->blocks as $block)
              <div wire:key="{{ $block['id'] }}">
                {!! Handmail::findBlock($block['name'])->render() !!}
              </div>
            @endforeach
            <button 
              type="button" 
              class="w-full rounded-md bg-indigo-50 px-2 py-1 text-sm font-semibold text-indigo-600 shadow-sm hover:bg-indigo-100"
              x-on:click="openModal = true"
            >
              Add Block
            </button>
            <section class="absolute top-0 h-[calc(100vh-12rem)] flex justify-end w-full pointer-events-none">
              <div 
                class="absolute bg-white shadow w-full bottom-0 rounded-md max-h-[calc(50vh)] overflow-auto pointer-events-auto"
                x-on:click.away="openModal = false"
                x-show="openModal"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-6 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100" 
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 translate-y-6 scale-95"
              >
                <h3 
                  class="sticky top-0 text-lg font-semibold leading-6 text-gray-900 border-gray-200 border-b px-4 py-2 bg-white bg-opacity-75 backdrop-blur backdrop-filter"
                >
                  Available Blocks
                </h3>
                <div class="py-2 px-4 grid grid-cols-1 sm:grid-cols-2 gap-2">
                  @forelse ($this->getAvailableBlocks() as $block)
                    <button 
                      type="button" 
                      class="flex justify-between gap-x-1.5 rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                      x-on:click.prevent="$wire.appendBlock('{{ $block->name }}').then(() => openModal = false)"
                    >
                      <span>{{ $block->label }}</span>
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                      </svg>
                    </button>
                  @empty
                    <p class="text-gray-500">No blocks availables, please see the documentation</p>
                  @endforelse
                </div>
              </div>
            </section>
          </div>
        </x-handmail::tab-item>
        {{ $slot }}
      </div>
    </x-handmail::tabs>
    @if (isset($footer))
      <footer {{ $footer->attributes->merge(['class' => 'border-t border-gray-200 px-4 sm:px-6 lg:px-8 py-2 bg-white bg-opacity-75 backdrop-blur backdrop-filter sticky bottom-0']) }}>
        {{ $footer }}
      </footer>
    @endif
  </div>
  <div 
    class="flex-1 relative flex justify-center px-2 pt-16 pb-2 max-h-[calc(100vh-3rem-1px)] shrink-0 sticky top-12 -mt-px"
    x-data="{
      active: 'desktop'
    }"
  >
    <iframe 
      src="http://demo.test/" 
      frameborder="0" 
      class="w-full border border-gray-200 rounded-md transition-all ease-in-out bg-white bg-opacity-75 backdrop-blur backdrop-filter"
      x-bind:class="{
        'max-w-screen-lg max-h-[700px]': active == 'desktop',
        'max-w-screen-md max-h-[900px]': active == 'tablet',
        'max-w-[400px] max-h-[820px]': active == 'mobile'
      }"
    ></iframe>
    <div class="flex space-x-4 justify-center absolute top-4 left-0 right-0 px-4 sm:px-6 lg:px-8">
      <button 
        class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
        x-on:click.prevent="active = 'desktop'"
      >
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
        </svg>
      </button>
      <button 
        class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
        x-on:click.prevent="active = 'tablet'"
      >
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5h3m-6.75 2.25h10.5a2.25 2.25 0 002.25-2.25v-15a2.25 2.25 0 00-2.25-2.25H6.75A2.25 2.25 0 004.5 4.5v15a2.25 2.25 0 002.25 2.25z" />
        </svg>
      </button>
      <button 
        class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
        x-on:click.prevent="active = 'mobile'"
      >
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
        </svg>
      </button>
    </div>
  </div>
</div>
