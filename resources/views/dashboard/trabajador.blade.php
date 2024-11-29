<x-app-layout>
    <head>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <style>
            .map {
                height: 300px;
                width: 100%;
                margin-top: 10px;
            }
        </style>
    </head>
    
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Columna 1: Información del Perfil del Trabajador -->
                <div class="bg-gray-100 p-6 rounded-lg shadow-md h-auto overflow-auto">
                    <!-- Foto de Perfil -->
                    <div class="flex flex-col items-center mb-6">
                        @if($trabajador->foto_perfil)
                            <div class="relative mb-4">
                                <img src="{{ asset('storage/fotos_perfil/' . $trabajador->foto_perfil) }}" 
                                     alt="Foto de Perfil" 
                                     class="rounded-full w-32 h-32 border-4 border-Silver shadow-lg">
                            </div>
                        @else
                            <p class="text-gray-600 mb-4">No has subido una foto de perfil.</p>
                        @endif
                        <form action="{{ route('trabajador.subirFotoPerfil', $trabajador->id) }}" 
                              method="POST" 
                              enctype="multipart/form-data">
                            @csrf
                            <label for="foto_perfil" class="px-4 py-2 bg-[#031926] text-white rounded-lg cursor-pointer hover:bg-[#9DBEBB]">
                                Subir Foto
                            </label>
                            <input type="file" 
                                   name="foto_perfil" 
                                   id="foto_perfil" 
                                   accept="image/*" 
                                   class="hidden" 
                                   onchange="this.form.submit()">
                        </form>
                    </div>
                    
                    <!-- Información General -->
                    @if(Auth::check())
                        <p><strong>Nombre:</strong> {{ Auth::user()->name }}</p>
                    @endif
                    @if($trabajador->dni)
                        <p><strong>DNI:</strong> {{ $trabajador->dni }}</p>
                    @endif
                    @if($trabajador->telefono)
                        <p><strong>Teléfono:</strong> {{ $trabajador->telefono }}</p>
                    @endif
                    @if($trabajador->direccion)
                        <p><strong>Dirección:</strong> {{ $trabajador->direccion }}</p>
                    @endif
                    @if($trabajador->antecedentes)
                        <p class="mb-4">
                            <strong>Antecedentes:</strong> 
                            <a href="{{ Storage::url($trabajador->antecedentes) }}" target="_blank" class="text-blue-500 hover:text-[#9DBEBB]">
                                Ver archivo
                            </a>
                        </p>
                    @else
                        <p class="mb-4"><strong>Antecedentes:</strong> No especificados</p>
                    @endif

                    <!-- Botón para subir antecedentes -->
                    <form action="{{ route('trabajador.subirArchivo', $trabajador->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="antecedentes" class="px-4 py-2 bg-[#031926] text-white rounded-lg cursor-pointer hover:bg-[#9DBEBB]">
                            Subir Antecedentes
                        </label>
                        <input 
                            type="file" 
                            name="antecedentes" 
                            id="antecedentes" 
                            accept="application/pdf, image/*" 
                            class="hidden" 
                            onchange="this.form.submit()"
                        >
                    </form>
                
                   
                    <div class="mt-6">
                       <!--  <h3 class="text-lg font-semibold">Calificaciones y Comentarios</h3> -->
                        @if($opiniones->isEmpty())
                            <p>No tienes calificaciones aún.</p>
                        @else
                            <ul class="space-y-4">
                                @foreach($opiniones as $opinion)
                                    <li class="p-4 bg-gray-100 border border-gray-300 rounded-lg">
                                        <p><strong></strong> {{ $opinion->empleador->user->name }}</p>
                                        
                                        <!-- Mostrar calificación con estrellas -->
                                        <p class="flex items-center">
                                            <strong>Calificación:</strong>
                                            <span class="ml-2">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if($i <= $opinion->calificacion)
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500 inline" viewBox="0 0 20 20" fill="currentColor">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.482 4.564a1 1 0 00.95.69h4.8c.969 0 1.371 1.24.588 1.81l-3.89 2.829a1 1 0 00-.364 1.118l1.482 4.564c.3.921-.755 1.688-1.54 1.118l-3.89-2.828a1 1 0 00-1.176 0l-3.89 2.828c-.785.57-1.84-.197-1.54-1.118l1.482-4.564a1 1 0 00-.364-1.118L2.18 9.99c-.783-.57-.38-1.81.588-1.81h4.8a1 1 0 00.95-.69L9.049 2.927z"/>
                                                        </svg>
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300 inline" viewBox="0 0 20 20" fill="currentColor">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.482 4.564a1 1 0 00.95.69h4.8c.969 0 1.371 1.24.588 1.81l-3.89 2.829a1 1 0 00-.364 1.118l1.482 4.564c.3.921-.755 1.688-1.54 1.118l-3.89-2.828a1 1 0 00-1.176 0l-3.89 2.828c-.785.57-1.84-.197-1.54-1.118l1.482-4.564a1 1 0 00-.364-1.118L2.18 9.99c-.783-.57-.38-1.81.588-1.81h4.8a1 1 0 00.95-.69L9.049 2.927z"/>
                                                        </svg>
                                                    @endif
                                                @endfor
                                            </span>
                                        </p>

                                        <p class="mt-2">{{ $opinion->mensaje }}</p>
                                        <!--<p class="text-sm text-gray-500"> {{ \Carbon\Carbon::parse($opinion->fecha)->format('d/m/Y') }}</p>-->
                                        <p class="text-sm text-gray-500"> {{ \Carbon\Carbon::parse($opinion->fecha)->format('d F Y') }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                </div>

                <!-- Columna 2 y 3: Publicaciones de Empleadores -->
                <div class="lg:col-span-2 space-y-4">
                    <!-- Encabezado con barra de búsqueda -->
                    <div class="flex justify-center items-center">
                        <div class="p-4 rounded-md shadow-sm">
                            <form action="{{ route('trabajador.buscarEmpleador') }}" method="GET">
                                <div class="flex space-x-1">
                                    <input 
                                        type="text" 
                                        name="buscar_trabajo" 
                                        id="buscar_trabajo" 
                                        class="p-3 border rounded-md w-3/4 text-xs" 
                                    >
                                    <button type="submit" class="px-2 py-1 bg-[#031926] text-white rounded-md hover:bg-[#9DBEBB] text-xs">Buscar</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if($publicaciones->isNotEmpty())
                        <div class="space-y-4">
                            @foreach($publicaciones as $publicacion)
                                <div class="p-6 border rounded-lg bg-white shadow-md hover:shadow-lg transition-shadow duration-300">
                                    <p class="text-gray-800 font-semibold text-lg">{{ $publicacion->empleador->user->name }}
                                <x-button 
                                    onclick="window.location.href='{{ route('empleador.perfil', ['id' => $publicacion->empleador->id]) }}'" 
                                    class="ms-4 bg-[#9DBEBB]">
                                    {{ __('Ver perfil') }}
                                </x-button>
                                    
                                    <p class="text-gray-800 text-lg">{{ $publicacion->descripcion }}</p>
                                    
                                    <!-- Dirección con estilo -->
                                    <p class="text-gray-700 font-medium mt-2">
                                        <span class="block text-sm text-gray-500">Ubicado en </span>
                                        <a href="https://www.google.com/maps?q={{ urlencode($publicacion->direccion) }}" 
                                        target="_blank" 
                                        class="text-indigo-600 font-semibold hover:text-indigo-800 transition-colors duration-200">
                                            {{ $publicacion->direccion }}
                                        </a>
                                    </p>

                                    <p class="text-gray-700 font-medium mt-2">
                                        <span class="block text-sm text-gray-500">Empleo:</span>
                                        {{ $publicacion->estado }}
                                    </p>

                                    <p class="text-gray-600 mt-2 text-sm">
                                        <span class="font-medium text-gray-500">Fecha de publicación:</span> 
                                        {{ \Carbon\Carbon::parse($publicacion->fecha_publicacion)->format('d/m/Y') }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-600 text-lg">No hay publicaciones disponibles de empleadores. ¡Mantente atento a las nuevas ofertas!</p>
                    @endif
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>
