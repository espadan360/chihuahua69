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
                        @if($anuncio->imagen)
                            <img src="{{ asset('storage/' . $anuncio->imagen) }}" class="card-img-top" alt="Imagen del anuncio">
                        @else
                            <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Imagen por defecto">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $anuncio->genero }} - {{ $anuncio->edad }} años</h5>
                            <p class="card-text">
                                <strong>Nacionalidad:</strong> {{ $anuncio->nacionalidad }}<br>
                                <strong>Servicios:</strong> {{ $anuncio->servicios }}<br>
                                <strong>Municipio:</strong> {{ $anuncio->municipio }}
                            </p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="#" class="btn btn-primary">Ver más</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
