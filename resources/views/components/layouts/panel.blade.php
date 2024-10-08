<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Handmail</title>

    @livewireStyles

    <style>[x-cloak] { display: none !important; }</style>

    <link rel="stylesheet" href="{{ mix('app.css', 'vendor/handmail') }}">
    <script defer src="{{ mix('app.js', 'vendor/handmail') }}"></script>
</head>

<body class="h-full">
    <div class="min-h-screen flex flex-col shrink-0 bg-gray-100 dark:bg-zinc-800">
        <x-handmail::navbar />

        {{ $slot }}
    </div>

    @livewireScripts

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
</body>

</html>
