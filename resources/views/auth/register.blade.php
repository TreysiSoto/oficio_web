<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="py-6 px-2 font-bold text-center text-3xl">
                
            Crear una cuenta nueva

        </div>
    
        <div>
            <x-label for="name" value="{{ __('Nombre') }}" />
            <x-input id="name" class="block mt-1 w-full text-lg " type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
        </div>    

        <div class="mt-4">
            <x-label for="email" value="{{ __('Correo') }}" />
            <x-input id="email" class="block mt-1 w-full text-lg " type="email" name="email" :value="old('email')" required autocomplete="username" />
        </div>

        <div class="mt-4">
            <x-label for="password" value="{{ __('Contraseña') }}" />
            <x-input id="password" class="block mt-1 w-full text-lg " type="password" name="password" required autocomplete="new-password" />
        </div>

        <div class="mt-4">
            <x-label for="password_confirmation" value="{{ __('Confirmar Contraseña') }}" />
            <x-input id="password_confirmation" class="block mt-1 w-full text-lg " type="password" name="password_confirmation" required autocomplete="new-password" />
        </div>

        <div class="mt-4"> 
        <x-label for="tipo_usuario" value="{{ __('Tipo de usuario') }}" />
        <select name="tipo_usuario" id="tipo_usuario" required class=" block w-auto py-2 px-4 mt-1 rounded-full border-gray-300 shadow-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-lg ">
            <option value="empleador">Elige una opción...</option>
            <option value="empleador">Empleador</option>
            <option value="trabajador">Trabajador</option>
        </select>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class=" font-semibold text-[#77ACA2] underline text-sm text-black hover:text-[#48D1CC] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('¿Ya estás registrado?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Registrarse') }}
            </x--primary-button>
        </div>
    </form>
</x-guest-layout>
