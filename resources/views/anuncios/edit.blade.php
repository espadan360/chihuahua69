
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Editar Anuncio</h1>

    <form action="{{ route('anuncios.update', $anuncio) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Campos como en la vista create pero con los valores pre-poblados -->
        <div class="form-group">
            <label for="genero">Género</label>
            <input type="text" class="form-control @error('genero') is-invalid @enderror" id="genero" name="genero" value="{{ old('genero', $anuncio->genero) }}" required>
            @error('genero')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Repite para el resto de campos -->

        <button type="submit" class="btn btn-warning">Actualizar Anuncio</button>
    </form>
</div>
@endsection
