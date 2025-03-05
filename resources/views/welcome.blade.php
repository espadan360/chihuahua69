@extends('layouts.appPublic')

@section('content')
<div class="container">
    <h1 class="my-4">Chihuahua69: acompañantes y escorts</h1>

    @if(isset($message))
    <p>{{ $message }}</p>
    @else
    <form method="GET" action="{{ route('welcome.index') }}">
        <div class="form-row mb-3">
            <div class="col">
                <input type="text" class="form-control" name="municipio" placeholder="Buscar por municipio">
            </div>
            <div class="col">
                <input type="text" class="form-control" name="nacionalidad" placeholder="Buscar por nacionalidad">
            </div>
            <div class="col">
                <input type="text" class="form-control" name="servicios" placeholder="Buscar por servicios">
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-info" onclick="toggleFilters()">Más filtros</button>
            </div>
        </div>
        <div id="additional-filters" style="display:none;">
            <!-- Agrega aquí tus filtros adicionales -->
            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" name="edad" placeholder="Buscar por edad">
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="genero" placeholder="Buscar por género">
                </div>
                <!-- Más filtros según necesites -->
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </div>
    </form>

    <!-- Contenedor para las tarjetas -->
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($anuncios as $anuncio)
        <div class="col">
            <!-- Tarjeta de anuncio -->
            <div class="card h-100">
                @php
                $imagen = $anuncio->imagenPrincipal ? $anuncio->imagenPrincipal : (object)['ruta' => 'https://via.placeholder.com/300x200'];
                @endphp
                <img src="{{ asset('storage/' . $imagen->ruta) }}" class="card-img-top" alt="Imagen del anuncio">
                <div class="card-body">
                    <h5 class="card-title">{{ $anuncio->genero ? $anuncio->genero->nombre_genero : 'No especificada' }}- {{ $anuncio->edad }} años</h5>
                    <p class="card-text">
                    <strong>Nacionalidad:</strong> {{ $anuncio->nacionalidad ? $anuncio->nacionalidad->nombre_nacionalidad : 'No especificada' }}<br>
                        <strong>Servicios:</strong> {{ $anuncio->servicios }}<br>
                        <strong>Municipio:</strong> {{ $anuncio->municipio ? $anuncio->municipio->nombre_municipio : 'No especificado' }}
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

<script>
    function toggleFilters() {
        var filters = document.getElementById('additional-filters');
        if (filters.style.display === 'none' || filters.style.display === '') {
            filters.style.display = 'block';
        } else {
            filters.style.display = 'none';
        }
    }
</script>