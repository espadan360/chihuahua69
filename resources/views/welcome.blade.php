@extends('layouts.appPublic')

@section('content')
<div class="container">
    <h1 class="my-4">Anuncios Disponibles</h1>

    @if(isset($message))
    <p>{{ $message }}</p>
    @else
    <!-- Contenedor para las tarjetas -->
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($anuncios as $anuncio)
        <div class="col">
            <!-- Tarjeta de anuncio -->
            <div class="card h-100">
                @php
                // Si no hay imagen principal, asignar imagen por defecto
                $imagen = $anuncio->imagenPrincipal ? $anuncio->imagenPrincipal : (object)['ruta' => 'https://via.placeholder.com/300x200'];
                @endphp

                <img src="{{ asset('storage/' . $imagen->ruta) }}" class="card-img-top" alt="Imagen del anuncio">

                <div class="card-body">
                    <h5 class="card-title">{{ $anuncio->genero }} - {{ $anuncio->edad }} años</h5>
                    <p class="card-text">
                        <strong>Nacionalidad:</strong> {{ $anuncio->nacionalidad }}<br>
                        <strong>Servicios:</strong> {{ $anuncio->servicios }}<br>
                        <strong>Municipio:</strong> {{ $anuncio->municipio }}
                    </p>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('anuncio', ['id_anuncio' => $anuncio->id]) }}" class="btn btn-primary">Ver más</a>
                </div>

            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection