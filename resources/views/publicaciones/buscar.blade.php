<section class="py-4">
    <div class="container">
        <h1 class="text-center mb-4">Resultados</h1>

        @if($publicaciones->isEmpty())
            <div class="alert alert-warning" role="alert">
                No se encontraron publicaciones para este oficio.
            </div>
        @else
            <div class="row">
                @foreach($publicaciones as $publicacion)
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $publicacion->descripcion }}</h5>
                                <p class="card-text">Publicado por: {{ $publicacion->empleador->user->name }}</p>
                                <p class="card-text text-muted">{{ \Carbon\Carbon::parse($publicacion->fecha_publicacion)->format('d/m/Y') }}</p>
                                <p class="card-text">Dirección: {{ $publicacion->direccion }}</p>

                                @auth
                                    <a href="{{ route('ver.publicacion', $publicacion->id) }}" class="btn btn-primary">Ver más</a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-secondary">Iniciar sesión</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            
            <div class="mt-4">
                {{ $publicaciones->links('pagination::bootstrap-4') }}
            </div>
        @endif
    </div>
</section>