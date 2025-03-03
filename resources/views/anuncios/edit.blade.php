@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Editar Anuncio</h1>

    <form action="{{ route('anuncios.update', $anuncio) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Género -->
        <div class="form-group">
            <label for="genero">Género</label>
            <input type="text" class="form-control @error('genero') is-invalid @enderror" id="genero" name="genero" value="{{ old('genero', $anuncio->genero) }}">
            @error('genero')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Edad -->
        <div class="form-group">
            <label for="edad">Edad</label>
            <input type="number" class="form-control @error('edad') is-invalid @enderror" id="edad" name="edad" value="{{ old('edad', $anuncio->edad) }}">
            @error('edad')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Teléfono -->
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ old('telefono', $anuncio->telefono) }}">
            @error('telefono')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Nacionalidad -->
        <div class="form-group">
            <label for="nacionalidad">Nacionalidad</label>
            <input type="text" class="form-control @error('nacionalidad') is-invalid @enderror" id="nacionalidad" name="nacionalidad" value="{{ old('nacionalidad', $anuncio->nacionalidad) }}">
            @error('nacionalidad')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Servicios -->
        <div class="form-group">
            <label for="servicios">Servicios</label>
            <input type="text" class="form-control @error('servicios') is-invalid @enderror" id="servicios" name="servicios" value="{{ old('servicios', $anuncio->servicios) }}">
            @error('servicios')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Municipio -->
        <div class="form-group">
            <label for="municipio">Municipio</label>
            <input type="text" class="form-control @error('municipio') is-invalid @enderror" id="municipio" name="municipio" value="{{ old('municipio', $anuncio->municipio) }}">
            @error('municipio')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Lugar que atiende -->
        <div class="form-group">
            <label for="lugar_atiendo">Lugar que atiende</label>
            <input type="text" class="form-control @error('lugar_atiendo') is-invalid @enderror" id="lugar_atiendo" name="lugar_atiendo" value="{{ old('lugar_atiendo', $anuncio->lugar_atiendo) }}">
            @error('lugar_atiendo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Horarios que atiende -->
        <div class="form-group">
            <label for="horarios_atiendo">Horarios que atiende</label>
            <input type="text" class="form-control @error('horarios_atiendo') is-invalid @enderror" id="horarios_atiendo" name="horarios_atiendo" value="{{ old('horarios_atiendo', $anuncio->horarios_atiendo) }}">
            @error('horarios_atiendo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Medidas -->
        <div class="form-group">
            <label for="medidas">Medidas</label>
            <input type="text" class="form-control @error('medidas') is-invalid @enderror" id="medidas" name="medidas" value="{{ old('medidas', $anuncio->medidas) }}">
            @error('medidas')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Altura -->
        <div class="form-group">
            <label for="altura">Altura</label>
            <input type="text" class="form-control @error('altura') is-invalid @enderror" id="altura" name="altura" value="{{ old('altura', $anuncio->altura) }}">
            @error('altura')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Peso -->
        <div class="form-group">
            <label for="peso">Peso</label>
            <input type="text" class="form-control @error('peso') is-invalid @enderror" id="peso" name="peso" value="{{ old('peso', $anuncio->peso) }}">
            @error('peso')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Descripción -->
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion">{{ old('descripcion', $anuncio->descripcion) }}</textarea>
            @error('descripcion')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        <!-- El campo 'id_usuario' no debe ser editable por el usuario -->
        <input type="hidden" name="id_usuario" value="{{ $anuncio->id_usuario }}">

        <button type="submit" class="btn btn-warning">Actualizar Anuncio</button>
    </form>
</div>
@endsection
