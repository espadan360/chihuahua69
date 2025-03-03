@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Bienvenidos a los Anuncios</h1>
    
    <div class="row">
        @foreach ($anuncios as $anuncio)
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('storage/'.$anuncio->imagen) }}" class="card-img-top" alt="Imagen del anuncio">
                    <div class="card-body">
                        <h5 class="card-title">{{ $anuncio->genero }} - {{ $anuncio->edad }} años</h5>
                        <p class="card-text">{{ Str::limit($anuncio->descripcion, 100) }}</p>
                        <a href="{{ route('anuncios.show', $anuncio->id) }}" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
