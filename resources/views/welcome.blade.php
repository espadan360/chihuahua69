@extends('layouts.appPublic')
@vite(['resources/css/botones.css'])
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
                    <label for="precio_min">Tarifa mínimo hora</label>
                    <input type="number" name="precio_min" class="form-control" value="{{ request('precio_min') }}">
                </div>

                <div class="col-md-3">
                    <label for="precio_max">tarifa máximo hora</label>
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
        <div class="mt-3 botones">
            <button type="submit" class="boton filtrar">Filtrar</button>
            <button type="button" class="boton masfiltro" onclick="toggleFilters()">Más filtros</button>
            <a href="{{ route('welcome.index') }}" class="boton eliminarfiltro">Eliminar filtros</a>
        </div>
    </form>

    <p>Escorts en Chihuahua estado disponibles ahora mismo para encuentro:</p>
<br>
<div class="row row-cols-2 row-cols-md-4 g-4 anuncioIndividual">
    @foreach($anuncios as $anuncio)
    <div class="col">
        <a href="{{ route('anuncio', ['nombre' => \Illuminate\Support\Str::slug($anuncio->nombre), 'id_anuncio' => $anuncio->id]) }}">
            <!-- Tarjeta de anuncio -->
            <div class="card h-100">
                @php
                $imagen = $anuncio->imagenPrincipal ? $anuncio->imagenPrincipal : (object)['ruta' => '/'];
                @endphp
                <img src="{{ asset('storage/' . $imagen->ruta) }}" class="card-img-top" alt="Imagen del anuncio">
                <div class="card-body">
                    <h5 class="card-title">{{ $anuncio->nombre }}</h5>
                    <p class="card-text">
                    {{ \Illuminate\Support\Str::limit($anuncio->descripcion, 70) }}<br>
                    <strong>Servicios:</strong> 
                    {{ \Illuminate\Support\Str::limit($anuncio->servicios->pluck('nombre_servicio')->join(', '), 50) }}<br>
                        <strong>Municipio:</strong> {{ $anuncio->municipio ? $anuncio->municipio->nombre_municipio : 'No especificado' }} <br>
                        <strong>{{ $anuncio->tarifa_hora }}€/hora<br></strong> 
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

    <br>
    @endif
    <div class="textoSeo">
        <h2>
            Cita erótica con sexoservidoras en Chihuahua estado
        </h2>
        <p>
            ¿Buscas la mejor cita erótica dentro del estado de Chihuahua con sexoservidoras? En la web Chihuahua69 podrás encontrar las mejores profesionales eróticas, escorts y acompañantes, dispuestas a hacer realidad todas vuestras fantasías de manera ardiente.

            Un portal completamente gratuito donde puedes poner tu anuncio para conocer nuevas personas, o directamente contactar a las mejores sexoservidoras. Chihuahua69 es un portal creado para acompañantes y escorts de todo el estado federal que buscan encontrar interesados en sus servicios.
        </p>
        <br>
        <div class="parallax">
            <h2> Encuentra Putas en Chihuahua 69</h2>
            <p>Esta web de contactos está creada para que en un vistazo puedas conocer a putas en Chihuahua estado.</p>
            <p>Podrás ponerte en contacto con escorts independientes, que anuncian sus servicios de forma libre y sin coacciones en Internet. Una posibilidad real de hacer tus deseos realidad, combinando pasión y placer.</p>
            <p>En Chihuahua69 no toleramos la falta de respeto. Si eres una persona curiosa o interesada, pedimos que respetes las normas, así como en tu encuentro junto con putas en Chihuahua las trates como te gustaría que te tratarán a ti. Esto es una web de contacto, en la cual simplemente damos la posibilidad en que profesional e interesado se conozcan, pero aún así nos regimos por unos códigos éticos que pedimos cumplir.</p>
            <br>
            <h2>Contacta ya con las escorts en Chihuahua 69</h2>
            <p>¿Quieres una conocer a escorts en Chihuahua? Contacta ya con las preciosas escorts en Chihuahua 69, aquí conseguirás de verdad tener esa cita tan deseada de forma real y sin engaños. Una web de contactos de las que no quedan, exclusiva del estado de Chihuahua.</p>
            <p>Ten en cuenta que está página es en exclusiva para profesionales del sector erótico que viven o se encuentran en el estado de Chihuahua en México. Sabemos que es un estado muy reconocido, tanto por la propia identidad como por el encanto y la belleza de las chihuahuenses. Ahora si quieres dar un paso más y disfrutar del placer, ya sabes donde encontrar las mejores sexoservidoras.</p>
            <p>Chihuahua69 es la mejor web donde escorts y putas independientes pueden anunciarse. Disfruta ya del momento y consigue el contacto de auténticas profesionales con las que hacer realidad juntos vuestras fantasías. El placer te espera.</p>
        </div>
        <br>
        <div class="image-container ">
            <img src="http://127.0.0.1:8000/storage/chicas.png" alt="">
        </div>
    </div>
    <br>
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