@extends('layouts.appPublic')
@vite(['resources/css/anuncios.css'])
<style>
    .imgDefecto img.d-block.w-100 {
        height: 55vh !important;
    }
</style>
@section('content')
<div class="container">
    <h1 class="my-4">Más sobre el anuncio</h1>

    <!-- Verificación si el anuncio tiene imágenes -->
    @if($anuncio->imagenes->isEmpty())
    <img src="{{ asset('storage/' . $imagenPrincipal->ruta) }}" class="d-block w-100 imgDefecto" alt="Imagen del anuncio">
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

    <br>
    <!-- Mostrar los anuncios relacionados -->
    @if($anunciosRelacionados->isNotEmpty())
    <h3>Anuncios relacionados</h3>
    <br>
    <div class="row row-cols-1 row-cols-md-3 g-4 anuncioIndividual">
        @foreach($anunciosRelacionados as $anuncioRelacionado)
        <div class="col">
            <a href="{{ route('anuncio', ['nombre' => \Illuminate\Support\Str::slug($anuncioRelacionado->nombre), 'id_anuncio' => $anuncioRelacionado->id]) }}">
                <div class="card h-100">
                    @php
                    $imagen = $anuncioRelacionado->imagenes->isNotEmpty() ? $anuncioRelacionado->imagenes->first() : (object)['ruta' => '/ImgAnuncio.png'];
                    @endphp
                    <img src="{{ asset('storage/' . $imagen->ruta) }}" class="card-img-top" alt="Imagen del anuncio">
                    <div class="card-body">
                        <h5 class="card-title">{{ $anuncioRelacionado->nombre }}</h5>
                        <p class="card-text">
                            {{ $anuncioRelacionado->descripcion }}<br>
                            <strong>Servicios:</strong> {{ $anuncioRelacionado->servicios->pluck('nombre_servicio')->join(', ') }}<br>
                            <strong>Municipio:</strong> {{ $anuncioRelacionado->municipio ? $anuncioRelacionado->municipio->nombre_municipio : 'No especificado' }} <br>
                            <strong>Nacionalidad:</strong> {{ $anuncioRelacionado->nacionalidad ? $anuncioRelacionado->nacionalidad->nombre_nacionalidad : 'No especificada' }} <br>
                            <strong>Tarifa por hora:</strong> {{ $anuncioRelacionado->tarifa_hora }}€/hora<br>
                        </p>
                    </div>
                    <div class="card-footer text-center">
                        {{ $anuncioRelacionado->telefono }}
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    @endif
<br>
</div>
@endsection