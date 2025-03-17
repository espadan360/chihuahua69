@extends('layouts.appPublic')
<style>
    img.d-block.w-100 {
        height: 55vh !important;
    }
</style>
@section('content')
<div class="container">
    <h1 class="my-4">Más sobre el anuncio</h1>

    <!-- Verificación si el anuncio tiene imágenes -->
    @if($anuncio->imagenes->isEmpty())
    <img src="{{ asset('storage/' . $imagenPrincipal->ruta) }}" class="d-block w-100" alt="Imagen del anuncio">
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
        <p><strong>Genero:</strong> {{ $anuncio->genero ? $anuncio->genero->nombre_genero : 'No especificada' }}</p>
        <p><strong>Edad:</strong> {{ $anuncio->edad }} años</p>
        <p><strong>Teléfono:</strong> {{ $anuncio->telefono }}</p>
        <p><strong>Nacionalidad:</strong> {{ $anuncio->nacionalidad ? $anuncio->nacionalidad->nombre_nacionalidad : 'No especificada' }}</p>
        <p><strong>Servicios:</strong> {{ $anuncio->servicios->pluck('nombre_servicio')->join(', ') }}</p>
        <p><strong>Municipio:</strong> {{ $anuncio->municipio ? $anuncio->municipio->nombre_municipio : 'No especificado' }}</p>
        <p><strong>Lugar de atención:</strong> {{ $anuncio->lugar_atiendo }}</p>
        <p><strong>Horarios de atención:</strong> {{ $anuncio->horarios_atiendo }}</p>
        <p><strong>Descripción:</strong> {{ $anuncio->descripcion }}</p>
        <p><strong>Medidas:</strong> {{ $anuncio->medidas }}</p>
        <p><strong>Altura:</strong> {{ $anuncio->altura }}</p>
        <p><strong>Peso:</strong> {{ $anuncio->peso }}</p>
        <p><strong>Fuma:</strong> {{ $anuncio->fumas == 1 ? 'Sí' : 'No' }}</p>
    </div>
</div>
@endsection