@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Listado de Anuncios</h1>

    <a href="{{ route('anuncios.create') }}" class="btn btn-primary mb-3">Crear Nuevo Anuncio</a>

    <table class="table table-bordered">
        <thead>
            <tr>
            <th>Imagen</th>
                <th>Nombre</th>
                <th>Género</th>
                <th>Edad</th>
                <th>Nacionalidad</th>
                <th>Servicios</th>
                <th>Municipio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($anuncios as $anuncio)
            <tr>
                 <td>
                    @if(isset($anuncio->imagenPrincipal->ruta) && $anuncio->imagenPrincipal->ruta !== 'public/storage/LogoChihuahua.png')
                        <img src="{{ asset('storage/' . $anuncio->imagenPrincipal->ruta) }}" class="img-thumbnail" alt="Imagen del anuncio" width="100">
                    @else
                        ImgLogoDefecto <!-- Mensaje predeterminado si no tiene imagen -->
                    @endif
                </td>
                <td>{{ $anuncio->nombre }}</td>
                <td>{{ $anuncio->genero->nombre_genero ?? ' ' }}</td>
                <td>{{ $anuncio->edad }}</td>
                <td>{{ $anuncio->nacionalidad->nombre_nacionalidad ?? ' ' }}</td>
                <td>{{ $anuncio->servicios->pluck('nombre_servicio')->join(', ') }}</td>
                <td>{{ $anuncio->municipio->nombre_municipio ?? ' ' }}</td>
                <td>
                    <a href="{{ route('anuncios.edit', $anuncio) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('anuncios.cambiarEstado', $anuncio) }}" method="POST" style="display: inline-block;">
                        @csrf
                        <button type="submit" class="btn btn-info btn-sm">
                            {{ $anuncio->estado == 1 ? 'Desactivar' : 'Activar' }}
                        </button>
                    </form>
                    <form action="{{ route('anuncios.destroy', $anuncio) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar este anuncio?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection