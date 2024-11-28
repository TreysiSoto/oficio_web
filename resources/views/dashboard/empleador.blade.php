<x-app-layout>
    <head>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
            <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js">
                
            </script>
            
            <style>
                .map {
                    height: 300px;
                    width: 100%;
                    margin-top: 10px;
                }
            </style>
    </head>
        

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-7">
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                    <!-- Columna Izquierda: Foto e Información del Perfil -->
                    <div class="lg:col-span-1 space-y-8">
                        <div class="flex flex-col items-center bg-gray-50 p-6 rounded-lg shadow-md">
                        
                        @if($empleador->foto_perfil)
                            <div class="relative mb-4">
                            <img src="{{ asset('storage/fotos_perfil_empleador/' . $empleador->foto_perfil) }}" 
                                     alt="Foto de Perfil" 
                                     class="rounded-full w-32 h-32 border-4 border-Silver shadow-lg">
                            </div>
                        @else
                            <p class="text-gray-600 mb-4">No has subido una foto de perfil.</p>
                        @endif

                        <!-- Botón para subir foto -->
                        <form action="{{ route('empleador.subirFotoPerfil', $empleador->id) }}" method="POST" enctype="multipart/form-data" class="mb-4">
                            @csrf
                            @method('POST')

                            <!-- Botón de carga de archivo oculto y asociado al botón visible -->
                            <label for="foto_perfil" class="px-4 py-2 bg-[#031926] text-white rounded-lg cursor-pointer hover:bg-blue-700">
                                Subir Foto
                            </label>
                            <input type="file" name="foto_perfil" id="foto_perfil" accept="image/*" class="hidden" onchange="this.form.submit()">
                        </form>
                        
                        <!-- Sección Información del Perfil -->
                        <!--<h3 class="text-xl font-semibold mb-4">Información del Perfil</h3>-->
                        <div class="space-y-4">
                            @if(Auth::check())
                                <p><strong></strong> {{ Auth::user()->name }}</p>
                            @endif
                            @if($empleador->nombre_empresa)
                                <p><strong></strong> {{ $empleador->nombre_empresa }}</p>
                            @endif
                            @if($empleador->dni)
                                <p><strong>DNI:</strong> {{ $empleador->dni }}</p>
                            @endif
                            @if($empleador->telefono)
                                <p><strong>Teléfono:</strong> {{ $empleador->telefono }}</p>
                            @endif
                            @if($empleador->direccion)
                                <p><strong>Dirección:</strong> {{ $empleador->direccion }}</p>
                            @endif

                            @if($empleador->antecedentes)
                        <p class="mb-4">
                            <strong>Antecedentes:</strong> 
                            <a href="{{ Storage::url($empleador->antecedentes) }}" target="_blank" class="text-blue-500 hover:text-blue-700">
                                Ver archivo
                            </a>
                        </p>
                        @else
                            <p class="mb-4"><strong>Antecedentes:</strong> No especificados</p>
                        @endif

                              <!-- Botón para subir antecedentes -->
                            <form action="{{ route('empleador.subirAntecedentes', $empleador->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <label for="antecedentes" class="px-4 py-2 bg-[#031926] text-white rounded-lg cursor-pointer hover:bg-blue-700">
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
                            <div class="block justify-end mb-4">
                                <a href="{{ route('publicacion.create') }}" class="bg-[#031926] text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                                Crear Nueva Publicación
                                </a>
                            </div>
                        </div>
                    </div>
                                         
                     <!-- Modal para ver las publicaciones del empleador -->
                        <div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
                            <div class="bg-white rounded-lg shadow-xl w-3/4 max-w-3xl p-6 relative">
                                <h2 class="text-xl font-semibold mb-4">Mis Publicaciones de Trabajo</h2>
                                
                                @if($misPublicaciones->isNotEmpty())
                                    <div class="space-y-6">
                                        @foreach($misPublicaciones as $publicacion)
                                            <div class="p-4 border rounded-lg bg-gray-50">
                                                <p class="text-gray-600">{{ \Carbon\Carbon::parse($publicacion->fecha_publicacion)->format('d/m/Y') }}</p>
                                                <p class="text-gray-600 mt-2">{{ $publicacion->descripcion }}</p>
                                                <p class="text-sm text-gray-500">Estado: <span class="font-semibold">{{ $publicacion->estado }}</span></p>
                                                <div class="mt-4 flex space-x-4">
                                                    <button class="text-blue-500 hover:text-blue-700">Editar</button>
                                                    <button class="text-red-500 hover:text-red-700">Eliminar</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p>No hay publicaciones disponibles. ¡Crea una nueva oferta de trabajo!</p>
                                @endif

                                <button id="closeModal" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">&times;</button>
                            </div>
                        </div>
                    </div>
                    
                <!-- Columna Derecha: Secciones Adicionales -->
                <div class="lg:col-span-2 space-y-4">
                    
                        <!-- Sección de Publicaciones de Empleadores -->
                        <div class="block justify-center items-center">
                            <div class="bg-white p-4 rounded-lg shadow-md ">
                                <form action="{{ route('empleador.buscarTrabajo') }}" method="GET">
                                    <div class="flex space-x-2">
                                        <input type="text" name="buscar_trabajo" id="buscar_trabajo" class="p-2 border rounded-lg w-full text-sm" placeholder="Ejemplo: Albañil, Electricista, etc.">
                                        <button type="submit" class="px-4 py-2 bg-[#031926] text-white rounded-lg hover:bg-blue-700 text-sm">Buscar</button>
                                    </div>
                                </form>
                            </div>
                            @if($publicacionesOtras->isNotEmpty())
                            <div class="space-y-6">
                                @foreach($publicacionesOtras as $publicacion)
                                    <div class="p-4 border rounded-lg bg-gray-50">
                                    <p class="text-gray-800 font-semibold text-lg">{{ $publicacion->empleador->user->name }}
                                    <x-button 
                                        onclick="window.location.href='{{ route('empleador.perfil', ['id' => $publicacion->empleador->id]) }}'" 
                                        class="ms-4 bg-[#9DBEBB]">
                                        {{ __('Ver perfil') }}
                                    </x-button>
                                    
                                        <p class="text-gray-600 mt-2">{{ $publicacion->descripcion }}</p>
                                        <!-- Dirección con estilo -->
                                    <p class="text-gray-700 font-medium mt-2">
                                        <span class="block text-sm text-gray-500">Ubicado en </span>
                                        <a href="https://www.google.com/maps?q={{ urlencode($publicacion->direccion) }}" 
                                        target="_blank" 
                                        class="text-indigo-600 font-semibold hover:text-indigo-800 transition-colors duration-200">
                                            {{ $publicacion->direccion }}
                                        </a>
                                    </p>

                                        <p class="text-sm text-gray-500">Estado: <span class="font-semibold">{{ $publicacion->estado }}</span></p>
                                        <p class="text-gray-600">{{ \Carbon\Carbon::parse($publicacion->fecha_publicacion)->format('d/m/Y') }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p>No hay publicaciones disponibles de empleadores. ¡Mantente atento a las nuevas ofertas!</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('openModal').addEventListener('click', function () {
            document.getElementById('modal').classList.remove('hidden');
        });

        document.getElementById('closeModal').addEventListener('click', function () {
            document.getElementById('modal').classList.add('hidden');
        });

        document.getElementById('modal').addEventListener('click', function (event) {
            if (event.target === this) {
                this.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>
