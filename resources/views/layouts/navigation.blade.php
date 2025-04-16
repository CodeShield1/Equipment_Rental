<nav x-data="{ open: false }" class="bg-white text-black shadow-md sticky top-0 w-full z-20">
    <div class="max-w-[90rem] mx-auto px-4 py-3 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <a href="/" class="text-black duration-300 hover:text-orange-500 text-2xl font-bold">
                    Equipment Rental
                </a>
            </div>

            @php
                $active = 'text-orange-500 text-base border-b-2 border-white';
                $inactive = 'text-gray-950 text-base hover:text-orange-500 hover:border-b-2 hover:border-white text-md';
            @endphp

            <!-- Navigation Links for Authenticated and Guests -->
            <div class="hidden md:flex flex-1 justify-center space-x-8">
                <!-- For Guests and Normal Users -->
                @guest
                    <x-nav-link :href="route('landing')" class=" {{ request()->routeIs('landing') ? $active : $inactive }}">Home</x-nav-link>
                    <x-nav-link :href="route('shop.index')" class="{{ request()->routeIs('shop.index') ? $active : $inactive }}">Shop</x-nav-link>
                    <x-nav-link :href="'#contact'" class="{{ request()->url() == url('/') . '#contact' ? $active : $inactive }}">Contact</x-nav-link>
                    <x-nav-link :href="'#testimonials'" class="{{ request()->url() == url('/') . '#testimonials' ? $active : $inactive }}">Testimonials</x-nav-link>
                    <x-nav-link :href="'#featured'" class="{{ request()->url() == url('/') . '#featured' ? $active : $inactive }}">Featured Equipment</x-nav-link>
               @else
                    <!-- For Normal Users -->
                    <x-nav-link :href="route('landing')" class="{{ request()->routeIs('landing') ? $active : $inactive }}">Home</x-nav-link>
                    <x-nav-link :href="route('shop.index')" class="{{ request()->routeIs('shop.index') ? $active : $inactive }}">Shop</x-nav-link>
                    <x-nav-link :href="'#contact'" class="{{ request()->url() == url('/') . '#contact' ? $active : $inactive }}">Contact</x-nav-link>
                    <x-nav-link :href="'#testimonials'" class="{{ request()->url() == url('/') . '#testimonials' ? $active : $inactive }}">Testimonials</x-nav-link>
                    <x-nav-link :href="'#featured'" class="{{ request()->url() == url('/') . '#featured' ? $active : $inactive }}">Featured Equipment</x-nav-link>

                    <!-- For Admins -->
                    @if(Auth::user()->is_admin)
                        <x-nav-link :href="route('admin.dashboard')" class="{{ request()->routeIs('admin.dashboard') ? $active : $inactive }}">Admin Dashboard</x-nav-link>
                    @endif
                @endguest
            </div>

            <!-- Button for All Users -->
            <div class="hidden md:flex items-center space-x-4">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded">
                            Logout
                        </button>
                    </form>
                @else
                    <x-nav-link :href="route('register')" class="bg-orange-500 hover:bg-orange-600 text-white hover:text-white px-4 py-2 rounded ">Register</x-nav-link>
                @endauth
            </div>
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-black focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        
        </div>
    </div>

    <!-- Hamburger Menu (Mobile) -->
    {{-- <div class="-mr-2 flex items-center sm:hidden">
        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-black focus:outline-none">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div> --}}

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('landing')" :active="request()->routeIs('landing')" class="hover:text-orange-500 active:text-orange-500">
                Home
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('shop.index')" :active="request()->routeIs('shop.index')" class="hover:text-orange-500 active:text-orange-500">
                Shop
            </x-responsive-nav-link>

            @guest
                <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')" class="hover:text-orange-500 active:text-orange-500">
                    Login
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')" class="hover:text-orange-500 active:text-orange-500">
                    Register
                </x-responsive-nav-link>
            @else

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="hover:text-orange-500 active:text-orange-500">
                        Logout
                    </x-responsive-nav-link>
                </form>
            @endguest
        </div>
    </div>
</nav>
