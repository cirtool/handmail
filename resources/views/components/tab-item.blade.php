@props(['name'])

<section x-show="active == '{{ $name }}'">
  {{ $slot }}
</section>
