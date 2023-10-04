@props(['head', 'body'])

<div class="px-4 sm:px-6 lg:px-8">
    <div class="mt-2 flow-root">
        <div class="-mx-4 -my-2 sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full align-middle ring-1 ring-black ring-opacity-5 sm:rounded-lg"
                style="overflow: clip">
                <table class="min-w-full border-separate border-spacing-0">
                    <thead>
                        {{ $head }}
                    </thead>
                    <tbody>
                        {{ $body }}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
