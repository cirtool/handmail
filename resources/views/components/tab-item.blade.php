@props(['name'])

<section x-show="active == '{{ $name }}'" class="relative">
  {{ $slot }}
</section>
