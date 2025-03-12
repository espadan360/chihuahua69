@extends('layouts.appPublic')

@section('content')
<div class="container">
    <h1 class="my-4">Chihuahua69: acompañantes y escorts</h1>

    @if(isset($message))
    <p>{{ $message }}</p>
    @else

    <!-- Formulario de Filtros -->
    <form method="GET" action="{{ route('welcome.index') }}">
        <div class="row">
            <!-- Filtros principales -->
            <div class="col-md-3">
                <label for="genero">Género</label>
                <select name="genero" class="form-control">
                    <option value="">Todos</option>
                    @foreach($generos as $genero)
                    <option value="{{ $genero->id }}" {{ request('genero') == $genero->id ? 'selected' : '' }}>
                        {{ $genero->nombre_genero }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label for="municipio">Municipio</label>
                <select name="municipio" class="form-control">
                    <option value="">Todos</option>
                    @foreach($municipios as $municipio)
                    <option value="{{ $municipio->id }}" {{ request('municipio') == $municipio->id ? 'selected' : '' }}>
                        {{ $municipio->nombre_municipio }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Sección de filtros adicionales (ocultos por defecto) -->
        <div id="additional-filters" style="display: none;">
            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="nacionalidad">Nacionalidad</label>
                    <select name="nacionalidad" class="form-control">
                        <option value="">Todas</option>
                        @foreach($nacionalidades as $nacionalidad)
                        <option value="{{ $nacionalidad->id }}" {{ request('nacionalidad') == $nacionalidad->id ? 'selected' : '' }}>
                            {{ $nacionalidad->nombre_nacionalidad }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="edad">Edad</label>
                    <input type="string" name="edad" class="form-control" value="{{ request('edad') }}">
                </div>

                <div class="col-md-3">
                    <label for="telefono">Teléfono</label>
                    <input type="text" name="telefono" class="form-control" value="{{ request('telefono') }}">
                </div>

                <div class="col-md-3">
                    <label for="fumas">¿Fumas?</label>
                    <select name="fumas" class="form-control">
                        <option value="">Todos</option>
                        <option value="1" {{ request('fumas') == '1' ? 'selected' : '' }}>Sí</option>
                        <option value="0" {{ request('fumas') == '0' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="precio_min">Precio Mínimo</label>
                    <input type="number" name="precio_min" class="form-control" value="{{ request('precio_min') }}">
                </div>

                <div class="col-md-3">
                    <label for="precio_max">Precio Máximo</label>
                    <input type="number" name="precio_max" class="form-control" value="{{ request('precio_max') }}">
                </div>

                <div class="col-md-3">
                    <label for="servicio">Servicio</label>
                    <select name="servicio" class="form-control">
                        <option value="">Todos</option>
                        @foreach($servicios as $servicio)
                        <option value="{{ $servicio->id }}" {{ request('servicio') == $servicio->id ? 'selected' : '' }}>
                            {{ $servicio->nombre_servicio }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Botones de filtrado -->
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <button type="button" class="btn btn-secondary" onclick="toggleFilters()">Más filtros</button>
        </div>
    </form>

    <p>Escorts en Chihuahua estado disponibles ahora mismo para encuentro:</p>

    <!-- Contenedor para las tarjetas -->

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($anuncios as $anuncio)
        <div class="col">
            <a href="{{ route('anuncio', ['id_anuncio' => $anuncio->id]) }}" class="">
                <!-- Tarjeta de anuncio -->
                <div class="card h-100">
                    @php
                    $imagen = $anuncio->imagenPrincipal ? $anuncio->imagenPrincipal : (object)['ruta' => 'https://via.placeholder.com/300x200'];
                    @endphp
                    <img src="{{ asset('storage/' . $imagen->ruta) }}" class="card-img-top" alt="Imagen del anuncio">
                    <div class="card-body">
                        <h5 class="card-title">{{ $anuncio->nombre }} </h5>
                        <p class="card-text">
                            <strong>Nacionalidad:</strong> {{ $anuncio->nacionalidad ? $anuncio->nacionalidad->nombre_nacionalidad : 'No especificada' }}<br>
                            <strong>Servicios:</strong> {{ $anuncio->servicios->pluck('nombre_servicio')->join(', ') }}<br>
                            <strong>Municipio:</strong> {{ $anuncio->municipio ? $anuncio->municipio->nombre_municipio : 'No especificado' }} <br>
                            <strong>Genero: </strong> {{ $anuncio->genero ? $anuncio->genero->nombre_genero : 'No especificada' }}
                        </p>
                    </div>
                    <div class="card-footer text-center">
                        {{ $anuncio->telefono }}
                    </div>
                </div>
            </a>
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