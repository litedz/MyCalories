<div>
    <x-guest-layout>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form class="grid gap-2" x-data="{ showRole: false, btnDashsboard: '' }">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" x-show="open" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required wire:model="email" autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    wire:model="password" autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" wire:model='rememberMe'
                        class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>
            {{-- // Select Role  --}}

            <div class="" x-show="$wire.isAdmin" x-cloak wire:key='{{ rand() }}'>
                <x-filament::input.select class="rounded-lg border-slate-300" x-model="btnDashsboard">
                    <option value="" selected>Select option</option>
                    <option value="dash">Admin</option>
                    <option value="home">User</option>
                </x-filament::input.select>
            </div>


            <div class="flex items-center justify-end mt-4 gap-2">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <div>
                    <button class="btn-primary " wire:click='login' type="button" x-show="!$wire.isAdmin"
                        wire:key='{{ rand() }}'>
                        {{ __('Log in') }}
                    </button>

                    <a href="{{ route('welcome') }}" class="btn-primary " type="button"
                        wire:key='{{ rand() }}' x-show="btnDashsboard == 'home' ">
                        {{ __('Home') }}
                    </a>
                    <a href="{{ route('filament.mycal.pages.dashboard') }}"
                        class="btn-primary bg-yellow-400 hover:bg-yellow-600" type="button"
                        wire:key='{{ rand() }}' x-show="btnDashsboard =='dash'">
                        {{ __('Dashboard') }}
                    </a>

                </div>

            </div>
        </form>
    </x-guest-layout>

</div>
