@props(['title', 'description'])

<div class="px-4 sm:px-6 lg:px-8 bg-white dark:bg-zinc-900 bg-opacity-75 backdrop-blur backdrop-filter py-4">
    <header class="mb-4">
        <h1 class="text-3xl font-bold leading-tight tracking-tight leading-tight text-gray-900 dark:text-white">
            {{ $title }}
        </h1>
        <p class="truncate text-base text-gray-500 leading-tight dark:text-pink-100 opacity-75">
            {{ $description }}
        </p>
    </header>
    <div>
        {{ $slot }}
    </div>
</div>
