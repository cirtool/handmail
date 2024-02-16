@props(['items'])

<div 
  x-data="{
    active: '{{ collect($items)->keys()->first() }}'
  }"
  class="flex-1"
>
  <div {{ $attributes->merge(['class' => 'border-b border-gray-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 bg-opacity-75 backdrop-blur backdrop-filter py-2']) }}>
    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
      @foreach ($items as $name => $item)
        <a 
          href="#"
          class=" whitespace-nowrap py-2 px-4 text-sm font-medium rounded-lg transition-all"
          x-bind:class="active == '{{ $name }}' ? 'text-pink-600 bg-zinc-800' : 'bg-transparent text-pink-200'"
          x-on:click.prevent="active = '{{ $name }}'"
        >
          {{ $item }}
        </a>
      @endforeach
    </nav>
  </div>
  {{ $slot }}
</div>
