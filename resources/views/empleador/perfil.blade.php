<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center mb-6">
                        @if($empleador->foto_perfil)
                            <img src="{{ asset('storage/fotos_perfil/' . $empleador->foto_perfil) }}" 
                                 alt="Foto de Perfil" 
                                 class="rounded-full w-32 h-32 mr-6">
                        @endif
                        <div>
                            <h1 class="text-2xl font-bold">{{ $empleador->user->name }}</h1>
                            @if($empleador->dni)
                                <p><strong>DNI:</strong> {{ $empleador->dni }}</p>
                            @endif
                            @if($empleador->telefono)
                                <p><strong>Teléfono:</strong> {{ $empleador->telefono }}</p>
                            @endif
                            @if($empleador->direccion)
                                <p><strong>Dirección:</strong> {{ $empleador->direccion }}</p>
                            @endif
                                </div>
                            </div>

                    <h2 class="text-xl font-semibold mb-4">Publicaciones</h2>
                    
                    @if($publicaciones->isNotEmpty())
                        <div class="space-y-4">
                            @foreach($publicaciones as $publicacion)
                                <div class="p-6 border rounded-lg bg-gray-100 shadow-md">
                                    <p class="text-gray-800 text-lg">{{ $publicacion->descripcion }}</p>
                                    
                                    <p class="text-gray-700 font-medium mt-2">
                                        <span class="block text-sm text-gray-500">Ubicación:</span>
                                        {{ $publicacion->direccion }}
                                    </p>

                                    <p class="text-gray-700 font-medium mt-2">
                                        <span class="block text-sm text-gray-500">Estado:</span>
                                        {{ $publicacion->estado }}
                                    </p>

                                    <p class="text-gray-600 mt-2 text-sm">
                                        <span class="font-medium text-gray-500">Publicado el:</span> 
                                        {{ \Carbon\Carbon::parse($publicacion->fecha_publicacion)->format('d/m/Y') }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-600">No hay publicaciones disponibles.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>