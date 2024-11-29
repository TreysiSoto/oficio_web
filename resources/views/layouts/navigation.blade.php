<nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="flex items-center space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <!-- Opción Dashboard -->
                    <a href="#" class="text-gray-800 dark:text-gray-200"> Nosotros</a>
                    
                    <!-- Opción Perfil -->
                    <a href="#" class="text-gray-800 dark:text-gray-200">Soporte</a>
                </div>
            </div>

            <!-- User Menu (Cerrar sesión) -->
            <div class="flex items-center space-x-4">
                <!-- Cerrar sesión -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-gray-500 dark:text-gray-400">
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

