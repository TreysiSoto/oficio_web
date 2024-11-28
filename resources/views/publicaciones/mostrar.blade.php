@extends('layouts.app')

@section('content')
<div>
    @foreach ($publicaciones as $publicacion)
        <div class="publicacion">
            <p>{{ $publicacion->descripcion }}</p>
            <p>{{ $publicacion->direccion }}</p>
            <a href="{{ route('login') }}">Leer más</a>
        </div>
    @endforeach
</div>
@endsection