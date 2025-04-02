@extends('layouts.appPublic')
@vite(['resources/css/contacto.css'])
@vite(['resources/css/botones.css'])
@section('content')

<div class="container">
    <h1>Contacto</h1>
    <form action="{{route('contactanos.store')}}" method="POST">
        @csrf
            <label>
                Nombre
                <br>
                <input type="text" name="name" value="{{old('name')}}">
            </label>
        <br>
        @error('name')
        <p><strong>{{$message}}</strong></p>
        <br>
        @enderror
        <label>
            Correo
            <br>
            <input type="email" name="correo" value="{{old('correo')}}">
        </label>
        <br>
        @error('correo')
        <p><strong>{{$message}}</strong></p>
        <br>
        @enderror
        <label>
            Mensaje
            <br>
            <textarea name="mensaje" value="{{old('mensaje')}}"></textarea>
        </label>
        <br>
        @error('mensaje')
        <p><strong>{{$message}}</strong></p>
        <br>
        @enderror
        <br>
        <button type="submit" class="btn enviar">Enviar mensaje</button>
    </form>
</div>
@if(session('info'))
<script>
    alert("{{session('info')}}");
</script>

@endif
@endsection