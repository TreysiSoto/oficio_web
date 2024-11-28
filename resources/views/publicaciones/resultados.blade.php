
@if($publicaciones->isEmpty())
    <div class="w-full max-w-md bg-[#507dbc] p-6 rounded-lg shadow-md text-center">
        <p class="text-gray-200 text-lg">No se encontraron resultados para su búsqueda.</p>
    </div>
@else
    @foreach ($publicaciones as $publicacion)
        <div class="w-full max-w-md bg-[#507dbc] p-6 rounded-lg shadow-md relative">
            <div class="mt-8 text-left">
                <p class="mt-1 text-gray-200 text-base">{{ $publicacion->descripcion }}</p>
                <p class="mt-1 text-gray-200 text-base">Dirección: {{ $publicacion->direccion }}</p>
                <p class="mt-2 text-gray-200 text-base">Publicado el: <span class="font-bold">{{ \Carbon\Carbon::parse($publicacion->fecha_publicacion)->format('d/m/Y') }}</span></p>
            </div>
            <div class="mt-6 text-center">
                <a href="{{ route('login') }}" class="inline-block bg-[#77ACA2] text-[#031926] py-2 px-4 rounded-md font-medium hover:bg-[#468189] transition duration-150 ease-in-out">Ver más</a>
            </div>
        </div>
    @endforeach
@endif
