@extends('layouts.appPublic')

@section('content')

@vite(['resources/css/anuncios.css'])
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
                    <label for="edad_min">Edad Mínima</label>
                    <input type="number" name="edad_min" class="form-control" value="{{ request('edad_min') }}">
                </div>

                <div class="col-md-3">
                    <label for="edad_max">Edad Máxima</label>
                    <input type="number" name="edad_max" class="form-control" value="{{ request('edad_max') }}">
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

                <!-- Filtro de servicio con cajas -->
                <div class="col-md-12">
                    <label for="servicio">Servicio</label>
                    <div class="d-flex flex-wrap">
                        @foreach($servicios as $servicio)
                        <div class="servicio-box"
                            data-id="{{ $servicio->id }}"
                            style="border: 1px solid #ccc; padding: 10px; margin: 5px; cursor: pointer; border-radius: 5px;">
                            {{ $servicio->nombre_servicio }}
                        </div>
                        @endforeach
                    </div>
                    <input type="hidden" name="servicio" id="servicio-input" value="{{ request('servicio') }}">
                </div>

            </div>
        </div>

        <!-- Botones de filtrado -->
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <button type="button" class="btn btn-secondary" onclick="toggleFilters()">Más filtros</button>
            <a href="{{ route('welcome.index') }}" class="btn btn-danger">Eliminar filtros</a>
        </div>
    </form>

    <p>Escorts en Chihuahua estado disponibles ahora mismo para encuentro:</p>

    <div class="row row-cols-1 row-cols-md-3 g-4 anuncioIndividual">
        @foreach($anuncios as $anuncio)
        <div class="col">
            <a href="{{ route('anuncio', ['id_anuncio' => $anuncio->id]) }}">
                <!-- Tarjeta de anuncio -->
                <div class="card h-100">
                    @php
                    $imagen = $anuncio->imagenPrincipal ? $anuncio->imagenPrincipal : (object)['ruta' => 'https://via.placeholder.com/300x200'];
                    @endphp
                    <img src="{{ asset('storage/' . $imagen->ruta) }}" class="card-img-top" alt="Imagen del anuncio">
                    <div class="card-body">
                        <h5 class="card-title">{{ $anuncio->nombre }}</h5>
                        <p class="card-text">
                            {{ $anuncio->descripcion }}<br>
                            <strong>Servicios:</strong> {{ $anuncio->servicios->pluck('nombre_servicio')->join(', ') }}<br>
                            <strong>Municipio:</strong> {{ $anuncio->municipio ? $anuncio->municipio->nombre_municipio : 'No especificado' }} <br>
                            <strong>Nacionalidad:</strong> {{ $anuncio->nacionalidad ? $anuncio->nacionalidad->nombre_nacionalidad : 'No especificada' }}
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


    document.addEventListener('DOMContentLoaded', function() {
        // Verificar si hay un valor ya seleccionado en el backend
        const servicioSeleccionado = document.getElementById('servicio-input').value;

        if (servicioSeleccionado) {
            document.querySelectorAll('.servicio-box').forEach(box => {
                if (box.getAttribute('data-id') === servicioSeleccionado) {
                    box.classList.add('selected');
                }
            });
        }

        // Función para manejar la selección de una caja
        document.querySelectorAll('.servicio-box').forEach(box => {
            box.addEventListener('click', function() {
                // Alternar la clase 'selected' para marcar o desmarcar la caja
                box.classList.toggle('selected');

                // Actualizar el campo oculto con el id del servicio seleccionado
                const selectedBoxes = document.querySelectorAll('.servicio-box.selected');
                const servicioIds = Array.from(selectedBoxes).map(selectedBox => selectedBox.getAttribute('data-id'));
                document.getElementById('servicio-input').value = servicioIds.join(',');
            });
        });
    });
</script>