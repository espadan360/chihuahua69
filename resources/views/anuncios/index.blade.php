@extends('layouts.app')
@vite(['resources/css/botones.css'])
@section('content')
<div class="container">
    <h1 class="my-4">Listado de Anuncios</h1>

    <a href="{{ route('anuncios.create') }}" class="btn crear">Crear anuncio</a>

    <div class="table-responsive">
        <br>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Edad</th>
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
                    <td>{{ $anuncio->edad }}</td>
                    <td>{{ $anuncio->municipio->nombre_municipio ?? ' ' }}</td>
                    <td>
                        <div class="btntabla">
                            <a href="{{ route('anuncios.edit', $anuncio) }}" class="btn editar">Editar</a>
                            <form action="{{ route('anuncios.cambiarEstado', $anuncio) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn activar">
                                    {{ $anuncio->estado == 1 ? 'Desactivar' : 'Activar' }}
                                </button>
                            </form>
                            <form action="{{ route('anuncios.destroy', $anuncio) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn eliminar" onclick="return confirm('¿Estás seguro de que quieres eliminar este anuncio?')">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection