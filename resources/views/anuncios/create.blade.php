@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Crear Nuevo Anuncio</h1>

    <form action="{{ route('anuncios.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            @error('nombre')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <!-- Genero -->
        <div class="form-group">
            <label for="genero">Genero</label>
            <select class="form-control @error('genero') is-invalid @enderror" id="genero" name="id_genero">
                @foreach ($generos as $genero)
                <option value="{{ $genero->id }}" {{ (old('id_genero') == $genero->id ? 'selected' : '') }}>
                    {{ $genero->nombre_genero }}
                </option>
                @endforeach
            </select>
            @error('genero')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="edad">Edad</label>
            <input type="number" class="form-control @error('edad') is-invalid @enderror" id="edad" name="edad" value="{{ old('edad') }}" required>
            @error('edad')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo Fumas -->
        <div class="form-group">
            <label for="fumas">¿Fumas?</label>
            <select class="form-control @error('fumas') is-invalid @enderror" id="fumas" name="fumas" required>
                <option value="" disabled selected>Selecciona una opción</option>
                <option value="1" {{ old('fumas') == '1' ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ old('fumas') == '0' ? 'selected' : '' }}>No</option>
            </select>
            @error('fumas')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="number" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ old('telefono') }}" required>
            @error('telefono')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="text" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio" value="{{ old('precio') }}" required>
            @error('precio')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Nacionalidad -->
        <div class="form-group">
            <label for="nacionalidad">Nacionalidad</label>
            <select class="form-control @error('nacionalidad') is-invalid @enderror" id="nacionalidad" name="id_nacionalidad">
                @foreach ($nacionalidades as $nacionalidad)
                <option value="{{ $nacionalidad->id }}" {{ (old('id_nacionalidad') == $nacionalidad->id ? 'selected' : '') }}>
                    {{ $nacionalidad->nombre_nacionalidad }}
                </option>
                @endforeach
            </select>
            @error('nacionalidad')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Servicios -->
        <div class="form-group">
            <label for="servicios">Servicios</label>
            <select class="form-control @error('servicios') is-invalid @enderror" id="servicios" name="servicios[]" multiple>
                @foreach ($servicios as $servicio)
                <option value="{{ $servicio->id }}">{{ $servicio->nombre_servicio }}</option>
                @endforeach
            </select>
            @error('servicios')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Municipio -->
        <div class="form-group">
            <label for="municipio">Municipio</label>
            <select class="form-control @error('municipio') is-invalid @enderror" id="municipio" name="id_municipio">
                @foreach ($municipios as $municipio)
                <option value="{{ $municipio->id }}" {{ (old('id_municipio') == $municipio->id ? 'selected' : '') }}>
                    {{ $municipio->nombre_municipio }}
                </option>
                @endforeach
            </select>
            @error('municipio')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="lugar_atiendo">Lugar de atención</label>
            <input type="text" class="form-control @error('lugar_atiendo') is-invalid @enderror" id="lugar_atiendo" name="lugar_atiendo" value="{{ old('lugar_atiendo') }}" required>
            @error('lugar_atiendo')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="horarios_atiendo">Horarios de atención</label>
            <input type="text" class="form-control @error('horarios_atiendo') is-invalid @enderror" id="horarios_atiendo" name="horarios_atiendo" value="{{ old('horarios_atiendo') }}" required>
            @error('horarios_atiendo')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="medidas">Medidas</label>
            <input type="text" class="form-control @error('medidas') is-invalid @enderror" id="medidas" name="medidas" value="{{ old('medidas') }}" required>
            @error('medidas')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="altura">Altura (cm)</label>
            <input type="number" class="form-control @error('altura') is-invalid @enderror" id="altura" name="altura" value="{{ old('altura') }}" required>
            @error('altura')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="peso">Peso (kg)</label>
            <input type="number" class="form-control @error('peso') is-invalid @enderror" id="peso" name="peso" value="{{ old('peso') }}" required>
            @error('peso')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="4" required>{{ old('descripcion') }}</textarea>
            @error('descripcion')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="imagenes">Imágenes</label>
            <input type="file" class="form-control @error('imagenes') is-invalid @enderror" id="imagenes" name="imagenes[]" multiple>
            @error('imagenes')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Crear Anuncio</button>
    </form>
</div>
@endsection