@props(['items'])

<div 
  x-data="{
    active: '{{ collect($items)->keys()->first() }}'
  }"
  class="flex-1"
>
  <div {{ $attributes->merge(['class' => 'border-b border-gray-200']) }}>
    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
      @foreach ($items as $name => $item)
        <a 
          href="#"
          class="border-transparent whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium"
          x-bind:class="active == '{{ $name }}' ? 'text-indigo-600 border-indigo-500 ' : 'text-gray-500 hover:border-gray-300 hover:text-gray-700'"
          x-on:click.prevent="active = '{{ $name }}'"
        >
          {{ $item }}
        </a>
      @endforeach
    </nav>
  </div>
  {{ $slot }}
</div>
