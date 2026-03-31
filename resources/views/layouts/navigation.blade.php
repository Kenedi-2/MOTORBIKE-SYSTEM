<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Left: Nav Links -->
            <div class="flex">
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">

                    @if(Auth::user()->role === 'admin')
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">Dashboard</x-nav-link>
                        <x-nav-link :href="route('motorbikes.index')" :active="request()->routeIs('motorbikes.*')">Motorbikes</x-nav-link>
                        <x-nav-link :href="route('drivers.index')" :active="request()->routeIs('drivers.*')">Drivers</x-nav-link>
                        <x-nav-link :href="route('contracts.index')" :active="request()->routeIs('contracts.*')">Contracts</x-nav-link>
                        <x-nav-link :href="route('sponsors.index')" :active="request()->routeIs('sponsors.*')">Sponsors</x-nav-link>
                        <x-nav-link :href="route('services.index')" :active="request()->routeIs('services.*')">Services</x-nav-link>
                        <x-nav-link :href="route('payments.index')" :active="request()->routeIs('payments.*')">Payments</x-nav-link>

                    @elseif(Auth::user()->role === 'driver')
                        <x-nav-link :href="route('drivers.dashboard')" :active="request()->routeIs('drivers.dashboard')">Dashboard</x-nav-link>
                        <x-nav-link :href="route('drivers.contracts')" :active="request()->routeIs('drivers.contracts')">Contracts</x-nav-link>
                  
                    @endif

                </div>
            </div>

            <!-- Right: User Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent rounded-md text-gray-500 bg-white hover:text-gray-700">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

        </div>
    </div>
</nav>