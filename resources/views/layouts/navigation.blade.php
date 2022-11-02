<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow">
    <!-- Primary Navigation Menu -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">


    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="background:rgb(255, 255, 255)">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center" id="logoAPP">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600 " />
                    </a>
                </div>


                <!-- Navigation Links -->
                <style>
                    @media screen and(max-width:850px) {
                        .responsiv-navlinks {
                            display: none !important;
                        }

                    }
                </style>
                @php
                    $infosEnCoursValidation = DB::table('infosndfs')
                        ->where('ValidationEnCours', '=', '1')
                        ->get();

                @endphp
                <div class="space-x-8 sm:-my-px sm:ml-10 sm:flex">

                    <a href="{{ route('dashboard') }}" style="text-decoration:none;"
                        class="hidden md:inline-flex items-center px-1 pt-1 border-b-2 hover:border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out">
                        Calendrier</a>
                    @if (Auth::user()->admin == 1 || Auth::user()->superadmin == 1)
                        <a href="{{ route('gestionaireUser') }}" style="text-decoration:none;"
                            class="hidden  md:inline-flex items-center px-1 pt-1 border-b-2 hover:border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out">
                            Administration
                            @if (count($infosEnCoursValidation) != 0)
                                <div class="flex flex-row justify-around items-center"
                                    style="color:white; font-size:10px;  width:20px; height:20px; right:0px; bottom:0px; background: rgb(255, 52, 52); margin-left:5px; border:2px solid black; border-radius:0.75rem; ">
                                    <p style="margin-bottom: 0px; margin-top font-family:'nunito',sans-serif; font-weight:bold;">{{ count($infosEnCoursValidation) }}</p></div>
                            @endif
                        </a>
                    @endif
                    <a href="{{ route('mesNDF') }}" style="text-decoration:none;"
                        class="hidden md:inline-flex items-center px-1 pt-1 border-b-2 hover:border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out">Mes
                        Notes de frais</a>
                </div>

            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex  sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Se déconnecter') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Calendrier') }}
            </x-responsive-nav-link>

            @if (Auth::user()->admin == 1 || Auth::user()->superadmin == 1)
                <x-responsive-nav-link :href="route('gestionaireUser')" :active="request()->routeIs('gestionnaireUser')">
                    {{ __('Administration') }}
            @endif

            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('mesNDF')" :active="request()->routeIs('mesNDF')">
                {{ __('Mes notes de frais') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">


            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Se déconnecter') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
