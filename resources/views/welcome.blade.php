@extends('layouts.appPublic')

@section('content')
<div class="container">
    <h1 class="my-4">Chihuahua69: acompañantes y escorts</h1>

    <!-- Filtros -->
    <div class="mb-4">
        <form action="{{ route('welcome.index') }}" method="GET">
            <div class="row">
                <div class="col">
                    <input type="text" name="genero" class="form-control" placeholder="Género" value="{{ request()->genero }}">
                </div>
                <div class="col">
                    <input type="text" name="nacionalidad" class="form-control" placeholder="Nacionalidad" value="{{ request()->nacionalidad }}">
                </div>
                <div class="col">
                    <input type="text" name="precio" class="form-control" placeholder="Precio" value="{{ request()->precio }}">
                </div>
                <div class="col">
                    <input type="text" name="servicios" class="form-control" placeholder="Servicios" value="{{ request()->servicios }}">
                </div>
                <div class="col">
                    <input type="text" name="municipio" class="form-control" placeholder="Municipio" value="{{ request()->municipio }}">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
        </form>
    </div>

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
