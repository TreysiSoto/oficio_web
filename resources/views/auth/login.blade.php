<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    @if(session('message'))
        <div class="alert alert-success text-center text-white bg-green-500 p-2 rounded-md">
            {{ session('message') }}
        </div>
    @endif

        <h1 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-4">{{ __('Iniciar Sesión') }}</h1>
        
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Correo')" class="text-gray-700 dark:text-gray-300" />
                <x-text-input id="email" class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-black focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-600" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Contraseña')" class="text-gray-700 dark:text-gray-300" />
                <x-text-input id="password" class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-600" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <label for="remember_me" class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ __('Recordarme') }}</label>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between">
                @if (Route::has('password.request'))
                    <a class="text-sm text-in[#031926] hover:text-[#48D1CC] dark:text-[#48D1CC]-200 dark:hover:text-[#48D1CC]-200" href="{{ route('password.request') }}">
                        {{ __('Olvidaste tu contraseña?') }}
                    </a>
                @endif

                <x-primary-button class="bg-[#031926] hover:bg-[#48D1CC] text-white px-4 py-2 rounded-md">
                    {{ __('Ingresar') }}
                </x-primary-button>
            </div>
        </form>

</x-guest-layout>
