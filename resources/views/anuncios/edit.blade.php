@extends('layouts.app')
@vite(['resources/css/mainAnuncio.css'])
@section('content')
<div class="container">
    <h1 class="my-4">Editar Anuncio</h1>
    <form action="{{ route('anuncios.update', $anuncio) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre', $anuncio->nombre) }}">
            @error('nombre')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="genero">Genero</label>
            <select class="form-control @error('id_genero') is-invalid @enderror" id="genero" name="id_genero">
                @foreach ($generos as $genero)
                <option value="{{ $genero->id }}"
                    {{ (old('id_genero', $anuncio->id_genero) == $genero->id) ? 'selected' : '' }}>
                    {{ $genero->nombre_genero }}
                </option>
                @endforeach
            </select>
            @error('id_genero')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="edad">Edad</label>
            <input type="number" class="form-control @error('edad') is-invalid @enderror" id="edad" name="edad" value="{{ old('edad', $anuncio->edad) }}">
            @error('edad')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="fumas">¿Fumas?</label>
            <select class="form-control @error('fumas') is-invalid @enderror" id="fumas" name="fumas" required>
                <option value="1" {{ (old('fumas', $anuncio->fumas) == '1') ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ (old('fumas', $anuncio->fumas) == '0') ? 'selected' : '' }}>No</option>
            </select>
            @error('fumas')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ old('telefono', $anuncio->telefono) }}">
            @error('telefono')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="tarifa_hora">Tarifa hora</label>
            <input type="text" class="form-control @error('tarifa_hora') is-invalid @enderror" id="tarifa_hora" name="tarifa_hora" value="{{ old('tarifa_hora', $anuncio->tarifa_hora) }}" required>
            @error('tarifa_hora')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="tarifa_general">Otras tarifas</label>
            <textarea class="form-control @error('tarifa_general') is-invalid @enderror" id="tarifa_general" name="tarifa_general">{{ old('tarifa_general', $anuncio->tarifa_general) }}</textarea>
            @error('tarifa_general')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="nacionalidad">Nacionalidad</label>
            <select class="form-control @error('id_nacionalidad') is-invalid @enderror" id="nacionalidad" name="id_nacionalidad">
                @foreach ($nacionalidades as $nacionalidad)
                <option value="{{ $nacionalidad->id }}"
                    {{ (old('id_nacionalidad', $anuncio->id_nacionalidad) == $nacionalidad->id) ? 'selected' : '' }}>
                    {{ $nacionalidad->nombre_nacionalidad }}
                </option>
                @endforeach
            </select>
            @error('id_nacionalidad')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="servicios">Servicios</label>
            <div id="servicios">
                @foreach ($servicios as $servicio)
                <div class="servicio-box" data-id="{{ $servicio->id }}" onclick="toggleServiceSelection('{{ $servicio->id }}')">
                    <p>{{ $servicio->nombre_servicio }}</p>
                    <!-- El input hidden no está aquí por defecto -->
                </div>
                @endforeach
            </div>
            @error('servicios')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="municipio">Municipio</label>
            <select class="form-control @error('id_municipio') is-invalid @enderror" id="municipio" name="id_municipio">
                @foreach ($municipios as $municipio)
                <option value="{{ $municipio->id }}"
                    {{ (old('id_municipio', $anuncio->id_municipio) == $municipio->id) ? 'selected' : '' }}>
                    {{ $municipio->nombre_municipio }}
                </option>
                @endforeach
            </select>
            @error('id_municipio')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="lugar_atiendo">Lugar que atiende</label>
            <input type="text" class="form-control @error('lugar_atiendo') is-invalid @enderror" id="lugar_atiendo" name="lugar_atiendo" value="{{ old('lugar_atiendo', $anuncio->lugar_atiendo) }}">
            @error('lugar_atiendo')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="horarios_atiendo">Horarios que atiende</label>
            <input type="text" class="form-control @error('horarios_atiendo') is-invalid @enderror" id="horarios_atiendo" name="horarios_atiendo" value="{{ old('horarios_atiendo', $anuncio->horarios_atiendo) }}">
            @error('horarios_atiendo')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="medidas">Medidas</label>
            <input type="text" class="form-control @error('medidas') is-invalid @enderror" id="medidas" name="medidas" value="{{ old('medidas', $anuncio->medidas) }}">
            @error('medidas')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="altura">Altura</label>
            <input type="text" class="form-control @error('altura') is-invalid @enderror" id="altura" name="altura" value="{{ old('altura', $anuncio->altura) }}">
            @error('altura')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="peso">Peso</label>
            <input type="text" class="form-control @error('peso') is-invalid @enderror" id="peso" name="peso" value="{{ old('peso', $anuncio->peso) }}">
            @error('peso')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion">{{ old('descripcion', $anuncio->descripcion) }}</textarea>
            @error('descripcion')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="imagenes">Imágenes actuales:</label>
            <div class="row">
                @foreach($anuncio->imagenes as $imagen)
                <div class="col-md-3">
                    <img src="{{ asset('storage/' . $imagen->ruta) }}" class="img-thumbnail" alt="Imagen del anuncio">
                    <br>
                    <label>
                        <input type="checkbox" name="eliminar_imagenes[]" value="{{ $imagen->id }}">
                        Eliminar esta imagen
                    </label>
                    <br>
                    <!-- Checkbox para seleccionar imagen principal -->
                    <label>
                        <input type="radio" name="imagen_principal" value="{{ $imagen->id }}" {{ $imagen->principal ? 'checked' : '' }}>
                        Esta es la imagen principal
                    </label>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Subir nuevas imágenes -->
        <div class="form-group">
            <label for="imagenes">Subir nuevas imágenes (opcional):</label>
            <input type="file" class="form-control @error('imagenes') is-invalid @enderror" id="imagenes" name="imagenes[]" multiple>
            @error('imagenes')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <input type="hidden" name="id_usuario" value="{{ $anuncio->id_usuario }}">


        <button type="submit" class="btn btn-warning">Actualizar Anuncio</button>
    </form>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const selectedServices = @json(old('servicios', $anuncio->servicios->pluck('id')->toArray()));

        selectedServices.forEach(serviceId => {
            const box = document.querySelector(`.servicio-box[data-id='${serviceId}']`);
            if (box) {
                box.classList.add('selected');
                // Agregar el input correspondiente al servicio
                addInput(serviceId);
            }
        });
    });

    function toggleServiceSelection(serviceId) {
        const serviceBox = document.querySelector(`.servicio-box[data-id='${serviceId}']`);
        const inputExists = document.querySelector(`#servicio_${serviceId}`);

        if (serviceBox.classList.contains('selected')) {
            // Si la caja está seleccionada, la deseleccionamos
            serviceBox.classList.remove('selected');
            if (inputExists) {
                inputExists.parentElement.removeChild(inputExists);
            }
        } else {
            // Si la caja no está seleccionada, la seleccionamos
            serviceBox.classList.add('selected');
            addInput(serviceId);
        }
    }

    function addInput(serviceId) {
        const serviceBox = document.querySelector(`.servicio-box[data-id='${serviceId}']`);
        // Crear un input oculto para el servicio seleccionado
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'servicios[]';
        input.value = serviceId;
        input.id = `servicio_${serviceId}`;
        serviceBox.appendChild(input);
    }

document.getElementById('imagenes').addEventListener('change', function(event) {
    const files = event.target.files;
    const maxSize = 5 * 1024 * 1024; // 5MB
    let totalSize = 0;
    let invalid = false;

    for (let i = 0; i < files.length; i++) {
        totalSize += files[i].size;
        if (files[i].size > maxSize) {
            invalid = true;
        }
    }

    if (totalSize > maxSize) {
        invalid = true;
    }

    if (invalid) {
        alert('Las imágenes deben ser menores a 5MB.');
        event.target.value = ''; 
    }
});

</script>
@endsection