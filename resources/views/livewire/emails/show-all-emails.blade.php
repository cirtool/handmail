<div>
    <x-handmail::header title="Emails" description="Lorem ipsum dolor sit amet, consectetur adipiscing elit.">
        <x-handmail::primary-button x-data x-on:click="$store.modals.open('create-template')">
            Create Email
        </x-handmail::primary-button>
    </x-handmail::header>

    <div class="px-4 sm:px-6 lg:px-8">
        <div class="mt-2 flow-root">
            <div class="-mx-4 -my-2 sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full align-middle ring-1 ring-black ring-opacity-5 sm:rounded-lg"
                    style="overflow: clip">
                    <table class="min-w-full border-separate border-spacing-0">
                        <thead>
                            <tr>
                                <th scope="col"
                                    class="sticky top-12 z-10 border-b border-gray-300 bg-white bg-opacity-75 py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:pl-6 lg:pl-8">
                                    Name</th>
                                <th scope="col"
                                    class="sticky top-12 z-10 hidden border-b border-gray-300 bg-white bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:table-cell ">
                                    Title</th>
                                <th scope="col"
                                    class="sticky top-12 z-10 hidden border-b border-gray-300 bg-white bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter lg:table-cell ">
                                    Email</th>
                                <th scope="col"
                                    class="sticky top-12 z-10 border-b border-gray-300 bg-white bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter ">
                                    Role</th>
                                <th scope="col"
                                    class="sticky top-12 z-10 border-b border-gray-300 bg-white bg-opacity-75 py-3.5 pl-3 pr-4 backdrop-blur backdrop-filter sm:pr-6 lg:pr-8 ">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (range(0, 100) as $item)
                                <tr>
                                    <td
                                        class="whitespace-nowrap border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                                        Lindsay Walton</td>
                                    <td
                                        class="whitespace-nowrap border-b border-gray-200 hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">
                                        Front-end Developer</td>
                                    <td
                                        class="whitespace-nowrap border-b border-gray-200 hidden px-3 py-4 text-sm text-gray-500 lg:table-cell">
                                        lindsay.walton@example.com</td>
                                    <td
                                        class="whitespace-nowrap border-b border-gray-200 px-3 py-4 text-sm text-gray-500">
                                        Member</td>
                                    <td
                                        class="relative whitespace-nowrap border-b border-gray-200 py-4 pr-4 pl-3 text-right text-sm font-medium sm:pr-8 lg:pr-8">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit<span
                                                class="sr-only">, Lindsay Walton</span></a>
                                    </td>
                                </tr>
                            @endforeach

                            <!-- More people... -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
