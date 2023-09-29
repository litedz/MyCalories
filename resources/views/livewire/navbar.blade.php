<div>
    <div x-data="{ open: false, openMenuMobile: false, OpenProfile: true, OpenSubMenuProfile: false, authUser: {{ auth()->check() }} }" x-cloak>
        <nav x-data="{ FixedNav: false }"
            class="bg-white border-gray-200 dark:bg-gray-900 dark:text-white transition-all duration-300 border-b border"
            :class="FixedNav && 'fixed z-30 w-full shadow shadow-primary'"
            @scroll.window="window.scrollY > 200 ? FixedNav = true : FixedNav = false">
            <div class="w-11/12 flex flex-wrap items-center justify-between mx-auto dark:bg-gray-900 rounded-full pr-2">
                {{-- logo --}}
                <a href="/" class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}"
                        class="h-20 mr-3 dark:rounded-full sm:mx-5 dark:h-12 dark:my-2" alt="Flowbite Logo" />
                    <span
                        class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white capitalize sm:hidden">Mycal</span>
                </a>
                {{-- profile user --}}
                <div class="flex items-center gap-2 order-2 ">
                    {{-- Enable dark mode button --}}

                    <div x-show="authUser" class="flex gap-4">
                        <div>
                            <span :class="$wire.bg_limite" class=" px-5 rounded py-2 shadow-lg  text-white "
                                wire:key='{{ rand() }}'><span class=" font-bold ">{{ $kcalDay }}</span> <span class="text-sm font-medium">kcal/Day</span></span>
                        </div>
                        <button type="button"
                            class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                            id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                            data-dropdown-placement="bottom">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-8 h-8 rounded-full" src="https://i.pravatar.cc/150?img=67" alt="user photo">
                        </button>
                        <!-- Dropdown menu -->
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
                            id="user-dropdown">
                            <div class="px-4 py-3">
                                <span class="block text-sm text-gray-900 dark:text-white">Bonnie Green</span>
                                <span
                                    class="block text-sm  text-gray-500 truncate dark:text-gray-400">name@flowbite.com</span>
                            </div>
                            {{-- submenu profile --}}
                            <ul class="py-2 capitalize" aria-labelledby="user-menu-button">
                                <li>
                                    @can('adminView', App\Models\User::class)
                                        <a x-show="{{ auth()->user()->IsAdmin() }}" href="#"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Dashboard</a>
                                    @endcan
                                </li>
                                <li>
                                    <a href="{{route('profile.edit')}}"
                                    wire:navigate
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Settings</a>
                                </li>
                                <li>
                                    <a href="{{route('user.listFood')}}"
                                    wire:navigate
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Your lists</a>
                                </li>
                                <li>
                                    <a href="{{route('logout')}}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign
                                        out</a>
                                </li>
                            </ul>
                        </div>
                        <div>

                        </div>
                    </div>
                    <button type="button" @click="$dispatch('dark-mode')">
                        <span
                            class="fa fa-moon px-3 py-2 rounded-lg bg-slate-100 border-2  border-slate-300 dark:text-slate-700"></span>
                    </button>
                    <button data-collapse-toggle="navbar-user" type="button"
                        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden xl:hidden lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                        aria-controls="navbar-user" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 17 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 1h15M1 7h15M1 13h15" />
                        </svg>
                    </button>
                </div>
                <div class="items-center sm:w-full hidden justify-between sm:order-3 w-auto md:flex md:w-auto md:order-1 lg:flex lg:w-auto lg:order-1 xl:flex"
                    id="navbar-user">
                    <ul x-data="{ active: 'link-home' }"
                        class="flex flex-row sm:flex-col font-medium p-4 md:p-0 mt-4  sm:border-gray-100 rounded-lg sm:bg-gray-50  md:space-x-8 md:mt-0 md  md:dark:bg-gray-900 dark:border-gray-700 capitalize">

                        <li>
                            <a href="#" id="link-home" @mouseenter="active = $el.id" @mouseleave="active =''"
                                :class="active == $el.id && 'active-link'"
                                class="block py-2 pl-3 pr-4   bg-transparent  rounded md:bg-transparent  md:p-0"
                                aria-current="page">Home</a>
                        </li>
                        <li>
                            <a href="{{route('calcul.bmi')}}" id="link-bmi" @mouseenter="active = $el.id" @mouseleave="active =''"
                                :class="active == $el.id && '!active-link'" wire:navigate
                                class="block bg-transparent  py-2 pl-3 pr-4 text-gray-900 rounded  md:p-0 dark:text-white     dark:border-gray-700">BMI</a>
                        </li>
                        <li>
                            <a href="{{route('categories')}}" id="link-categories" @mouseenter="active = $el.id" @mouseleave="active =''"
                                :class="active == $el.id && '!active-link'" wire:navigate
                                class="block bg-transparent  py-2 pl-3 pr-4 text-gray-900 rounded  md:p-0 dark:text-white     dark:border-gray-700">categories</a>
                        </li>



                    </ul>
                </div>

            </div>
        </nav>
    </div>
</div>
