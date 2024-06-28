<nav x-data="{ open: false }" @keydown.window.escape="open = false"
    class="absolute inset-x-0 top-0 flex z-10 h-16 border-b border-gray-900/10">
    <div class="mx-auto flex w-full max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
        <div class="flex flex-1 items-center gap-x-6">
            <button type="button" class="-m-3 p-3 md:hidden" @click="open = true">
                <span class="sr-only">Open main menu</span>
                <svg class="h-5 w-5 text-gray-900" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10zm0 5.25a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75a.75.75 0 01-.75-.75z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
            <div class="hidden md:flex shrink-0 flex items-center h-8 w-auto">
                <a href="{{ route('dashboard') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>
        </div>
        <nav class="hidden md:flex md:gap-x-11 md:text-sm md:font-semibold md:leading-6 md:text-gray-700">
            @if (auth()->user()->role->slug != 'costumer')
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-nav-link>
            <x-dropdown>
                <x-slot name="trigger">
                    <button
                        class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium rounded-md text-gray-500  hover:text-gray-700 focus:outline-none transition ease-in-out duration-150 -m-1.5 p-1.5 {{ request()->routeIs(['location','location.*', 'brands', 'brands.*','drivers', 'drivers.*']) ? 'border-b-2 border-indigo-400' : 'border border-transparent' }}">
                        <div> {{ __('Data Master') }}</div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('location')" :active="request()->routeIs(['location','location.*'])">
                        {{ __('Location') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('brands')" :active="request()->routeIs(['brands','brands.*'])">
                        {{ __('Brands') }}
                    </x-dropdown-link>
                    {{-- <x-dropdown-link :href="route('drivers')"
                        :active="request()->routeIs(['drivers','drivers.*'])">
                        {{ __('Drivers') }}
                    </x-dropdown-link> --}}
                </x-slot>
            </x-dropdown>
            <x-dropdown>
                <x-slot name="trigger">
                    <button
                        class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium rounded-md text-gray-500  hover:text-gray-700 focus:outline-none transition ease-in-out duration-150 -m-1.5 p-1.5 {{ request()->routeIs(['cars','cars.*', 'cars-location', 'cars-location.*']) ? 'border-b-2 border-indigo-400' : 'border border-transparent' }}">
                        {{ __('Cars') }}
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('cars')">
                        {{ __('Cars') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('cars-location')">
                        {{ __('Cars Location') }}
                    </x-dropdown-link>
                </x-slot>
            </x-dropdown>

            <x-nav-link :href="route('users')" :active="request()->routeIs('users')">
                {{ __('Manage User') }}
            </x-nav-link>
            @endif

            <x-dropdown>
                <x-slot name="trigger">
                    <button
                        class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium rounded-md text-gray-500  hover:text-gray-700 focus:outline-none transition ease-in-out duration-150 -m-1.5 p-1.5 {{ request()->routeIs(['bookings','bookings.*']) ? 'border-b-2 border-indigo-400' : 'border border-transparent' }}">
                        <div> {{ __('Bookings') }}</div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('bookings')" :active="request()->routeIs(['bookings','bookings.*'])">
                        {{ __('Riwayat Bookings') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('payments')" :active="request()->routeIs(['payments','payments.*'])">
                        {{ __('Riwayat Payment') }}
                    </x-dropdown-link>
                </x-slot>
            </x-dropdown>

        </nav>
        <div class="flex flex-1 items-center justify-end gap-x-8">
            <x-dropdown align="right" width="48" class="-m-1.5 p-1.5">
                <x-slot name="trigger">
                    <button
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500  hover:text-gray-700 focus:outline-none transition ease-in-out duration-150 -m-1.5 p-1.5">

                        <div>{{ Auth::user()->name }}</div>

                        <div class="ms-1">
                            <img class="h-8 w-8 rounded-full bg-gray-800" src="{{ Auth::user()->photo_profile_url }}"
                                alt="{{ Auth::user()->name }}">
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
    <div x-description="Mobile menu, show/hide based on menu open state." class="lg:hidden" x-ref="dialog" x-show="open"
        aria-modal="true">
        <div x-description="Background backdrop, show/hide based on slide-over state." class="fixed inset-0 z-50">
        </div>
        <div class="fixed inset-y-0 left-0 z-50 w-full overflow-y-auto bg-white px-4 pb-6 sm:max-w-sm sm:px-6 sm:ring-1 sm:ring-gray-900/10"
            @click.away="open = false">
            <div class="-ml-0.5 flex h-16 items-center gap-x-6">
                <button type="button" class="-m-2.5 p-2.5 text-gray-700" @click="open = false">
                    <span class="sr-only">Close menu</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                <div class="-ml-0.5">
                    <a href="#" class="-m-1.5 block p-1.5">
                        <span class="sr-only">Your Company</span>
                        <img class="h-8 w-auto"
                            src="https://tailwindui.com/img/logos/mark.svg?color=indigo&amp;shade=600" alt="">
                    </a>
                </div>
            </div>
            <div class="mt-2 space-y-2">
                <a href="{{ route('splash') }}"
                    class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Home</a>
                <a href="#"
                    class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">
                    Riwayat Bookings
                </a>
                <a href="{{ route('profile.edit') }}"
                    class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Clients</a>

            </div>
        </div>
    </div>
</nav>