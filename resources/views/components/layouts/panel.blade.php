<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Handmail</title>
    <link rel="stylesheet" href="{{ mix('app.css', 'vendor/handmail') }}">
    @livewireStyles
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="h-full">
    <div class="min-h-full">
        <x-handmail::navbar />

        <div class="py-10">
            <header>
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold leading-tight tracking-tight text-gray-900">Dashboard</h1>
                </div>
            </header>
            <main>
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('modals', {
                open(name) {
                    window.dispatchEvent(new CustomEvent('modal:open:' + name))
                },
                close(name) {
                    window.dispatchEvent(new CustomEvent('modal:close:' + name))
                }
            })
        })
    </script>

    @livewireScripts
</body>

</html>
