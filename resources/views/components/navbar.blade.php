<nav 
    class="border-b border-gray-200 bg-white sticky top-0 z-50"
    x-data="{ openMobileNav: false }"
>
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex h-12 justify-between">
            <div class="flex">
                <div class="flex flex-shrink-0 items-center">
                    <img class="block h-8 w-auto lg:hidden"
                        src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                        alt="Your Company">
                    <img class="hidden h-8 w-auto lg:block"
                        src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                        alt="Your Company">
                </div>
                <div class="flex flex-col justify-center ml-2">
                    <p class="text-sm leading-tight font-medium text-gray-800">Handmail</p>
                    <p class="text-xs text-gray-600 leading-tight">
                        {{ Handmail::getVersion() }} by Cirtool
                    </p>
                </div>
            </div>
            <div class="hidden sm:-my-px sm:ml-6 sm:flex sm:space-x-4">
                <x-handmail::navbar-link :to="route('handmail.templates')" :active-when="['handmail/templates']">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        class="w-5 h-5">
                        <path d="M2 3a1 1 0 00-1 1v1a1 1 0 001 1h16a1 1 0 001-1V4a1 1 0 00-1-1H2z" />
                        <path fill-rule="evenodd"
                            d="M2 7.5h16l-.811 7.71a2 2 0 01-1.99 1.79H4.802a2 2 0 01-1.99-1.79L2 7.5zM7 11a1 1 0 011-1h4a1 1 0 110 2H8a1 1 0 01-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="ml-1">Templates</span>
                </x-handmail::navbar-link>

                <x-handmail::navbar-link :to="route('handmail.emails')" :active-when="['handmail/emails']">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        class="w-5 h-5">
                        <path fill-rule="evenodd"
                            d="M5.404 14.596A6.5 6.5 0 1116.5 10a1.25 1.25 0 01-2.5 0 4 4 0 10-.571 2.06A2.75 2.75 0 0018 10a8 8 0 10-2.343 5.657.75.75 0 00-1.06-1.06 6.5 6.5 0 01-9.193 0zM10 7.5a2.5 2.5 0 100 5 2.5 2.5 0 000-5z"
                            clip-rule="evenodd" />
                    </svg>

                    <span class="ml-1">Emails</span>
                </x-handmail::navbar-link>

                <x-handmail::navbar-link>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        class="w-5 h-5">
                        <path fill-rule="evenodd"
                            d="M4.5 2A1.5 1.5 0 003 3.5v13A1.5 1.5 0 004.5 18h11a1.5 1.5 0 001.5-1.5V7.621a1.5 1.5 0 00-.44-1.06l-4.12-4.122A1.5 1.5 0 0011.378 2H4.5zm2.25 8.5a.75.75 0 000 1.5h6.5a.75.75 0 000-1.5h-6.5zm0 3a.75.75 0 000 1.5h6.5a.75.75 0 000-1.5h-6.5z"
                            clip-rule="evenodd" />
                    </svg>

                    <span class="ml-1">Docs</span>
                </x-handmail::navbar-link>
            </div>
            <div class="-mr-2 flex items-center sm:hidden">
                <!-- Mobile menu button -->
                <button 
                    type="button"
                    class="relative inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    aria-controls="mobile-menu" 
                    aria-expanded="false"
                    x-on:click.prevent="openMobileNav = ! openMobileNav"
                >
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>

                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true" x-bind:class="! openMobileNav ? 'block' : 'hidden'">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>

                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true" x-bind:class="openMobileNav ? 'block' : 'hidden'">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden" id="mobile-menu" x-show="openMobileNav">
        <div class="space-y-1 pb-3 pt-2">
            <a href="#"
                class="border-transparent text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800 block border-l-4 py-2 pl-3 pr-4 text-base font-medium">Templates</a>
            <a href="#"
                class="border-transparent text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800 block border-l-4 py-2 pl-3 pr-4 text-base font-medium">Emails</a>
            <a href="#"
                class="border-transparent text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800 block border-l-4 py-2 pl-3 pr-4 text-base font-medium">Docs</a>
        </div>
    </div>
</nav>
