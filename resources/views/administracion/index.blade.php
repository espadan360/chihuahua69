@extends('layouts.app')
@vite(['resources/css/botones.css'])
@section('content')
<div class="container">
    <h1>Administración de Anuncios Pendientes</h1>
    <br>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Género</th>
                <th>Nacionalidad</th>
                <th>Municipio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($anunciosPendientes as $anuncio)
                <tr>
                    <td>{{ $anuncio->id }}</td>
                    <td>{{ $anuncio->nombre }}</td>
                    <!-- Verificar si la relación genero está cargada -->
                    <td>{{ $anuncio->genero ? $anuncio->genero->nombre_genero : 'No disponible' }}</td>
                    <!-- Verificar si la relación nacionalidad está cargada -->
                    <td>{{ $anuncio->nacionalidad ? $anuncio->nacionalidad->nombre_nacionalidad : 'No disponible' }}</td>
                    <!-- Verificar si la relación municipio está cargada -->
                    <td>{{ $anuncio->municipio ? $anuncio->municipio->nombre_municipio : 'No disponible' }}</td>
                    <td>
                        <a href="{{ route('administracion.permitir', $anuncio) }}" class="btn crear">Permitir</a>
                        <a href="{{ route('administracion.denegar', $anuncio) }}" class="btn eliminar">Denegar</a>
                        <a href="{{ route('anuncio', ['nombre' => \Illuminate\Support\Str::slug($anuncio->nombre), 'id_anuncio' => $anuncio->id]) }}"class="btn editar">Ver</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
