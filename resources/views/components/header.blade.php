@props(['title', 'description'])

<div class="px-4 sm:px-6 lg:px-8 bg-white bg-opacity-75 backdrop-blur backdrop-filter py-4">
    <header class="mb-4">
        <h1 class="text-3xl font-bold leading-tight tracking-tight leading-tight text-gray-900">
            {{ $title }}
        </h1>
        <p class="truncate text-base text-gray-500 leading-tight">
            {{ $description }}
        </p>
    </header>
    <div>
        {{ $slot }}
    </div>
</div>
