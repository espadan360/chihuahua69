@extends('layouts.appPublic')

@section('content')
<div class="container">
    <h1 class="my-4">Detalles del Anuncio</h1>

    <!-- Verificación si el anuncio tiene imágenes -->
    @if($anuncio->imagenes->isEmpty())
    <p>No hay imágenes disponibles para este anuncio.</p>
    @else
    <!-- Slider de imágenes -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($anuncio->imagenes as $key => $imagen)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                <img src="{{ asset('storage/' . $imagen->ruta) }}" class="d-block w-100" alt="Imagen del anuncio">
            </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>
    @endif

    <div class="mt-4">
        <h4>Información del Anuncio</h4>
        <p><strong>Genero:</strong> {{ $anuncio->genero ? $anuncio->genero->nombre_genero : 'No especificada' }}</p>
        <p><strong>Edad:</strong> {{ $anuncio->edad }} años</p>
        <p><strong>Teléfono:</strong> {{ $anuncio->telefono }}</p>
        <p><strong>Nacionalidad:</strong> {{ $anuncio->nacionalidad ? $anuncio->nacionalidad->nombre_nacionalidad : 'No especificada' }}</p>
        <p><strong>Servicios:</strong> {{ $anuncio->servicios }}</p>
        <p><strong>Municipio:</strong> {{ $anuncio->municipio ? $anuncio->municipio->nombre_municipio : 'No especificado' }}</p>
        <p><strong>Lugar de atención:</strong> {{ $anuncio->lugar_atiendo }}</p>
        <p><strong>Horarios de atención:</strong> {{ $anuncio->horarios_atiendo }}</p>
        <p><strong>Descripción:</strong> {{ $anuncio->descripcion }}</p>
        <p><strong>Medidas:</strong> {{ $anuncio->medidas }}</p>
        <p><strong>Altura:</strong> {{ $anuncio->altura }}</p>
        <p><strong>Peso:</strong> {{ $anuncio->peso }}</p>
    </div>
</div>
@endsection