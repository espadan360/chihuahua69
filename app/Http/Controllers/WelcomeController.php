<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use App\Models\Genero;
use App\Models\Municipio;
use App\Models\Servicio;
use App\Models\Nacionalidad;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\QueryBuilder\QueryBuilder;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        // Obtener los datos de los filtros
        $generos = Genero::all();
        $municipios = Municipio::all();
        $nacionalidades = Nacionalidad::all();
        $servicios = Servicio::all();  // Agregar servicios para el filtro

        // Aplicar filtros
        $anuncios = QueryBuilder::for(Anuncio::class)
            ->with(['imagenes', 'nacionalidad', 'municipio', 'genero', 'servicios'])
            ->where('estado', 1)
            ->when($request->filled('genero'), fn($query) => $query->where('id_genero', $request->genero))
            ->when($request->filled('municipio'), fn($query) => $query->where('id_municipio', $request->municipio))
            ->when($request->filled('nacionalidad'), fn($query) => $query->where('id_nacionalidad', $request->nacionalidad))
            ->when($request->filled('edad_min'), fn($query) => $query->where('edad', '>=', $request->edad_min))
            ->when($request->filled('edad_max'), fn($query) => $query->where('edad', '<=', $request->edad_max))
            ->when($request->filled('telefono'), fn($query) => $query->where('telefono', 'like', '%' . $request->telefono . '%'))
            ->when($request->filled('lugar_atiendo'), fn($query) => $query->where('lugar_atiendo', 'like', '%' . $request->lugar_atiendo . '%'))
            ->when($request->filled('horarios_atiendo'), fn($query) => $query->where('horarios_atiendo', 'like', '%' . $request->horarios_atiendo . '%'))
            ->when($request->filled('medidas'), fn($query) => $query->where('medidas', 'like', '%' . $request->medidas . '%'))
            ->when($request->filled('altura'), fn($query) => $query->where('altura', $request->altura))
            ->when($request->filled('peso'), fn($query) => $query->where('peso', $request->peso))
            ->when($request->filled('descripcion'), fn($query) => $query->where('descripcion', 'like', '%' . $request->descripcion . '%'))
            ->when($request->filled('me_gusta'), fn($query) => $query->where('me_gusta', $request->me_gusta))
            ->when($request->filled('fumas'), fn($query) => $query->where('fumas', (int) $request->fumas))
            ->when($request->filled('precio_min'), fn($query) => $query->where('tarifa_hora', '>=', $request->precio_min))
            ->when($request->filled('precio_max'), fn($query) => $query->where('tarifa_hora', '<=', $request->precio_max))
            ->when($request->filled('servicio'), function ($query) use ($request) {
                $serviciosSeleccionados = explode(',', $request->servicio); // Obtener los IDs de los servicios seleccionados
                $query->whereHas('servicios', function ($q) use ($serviciosSeleccionados) {
                    $q->whereIn('servicios.id', $serviciosSeleccionados);
                });
            })

            ->get();

        // Procesar las imágenes para cada anuncio
        foreach ($anuncios as $anuncio) {
            $imagenPrincipal = $anuncio->imagenes->where('principal', 1)->first();

            if (!$imagenPrincipal && $anuncio->imagenes->isNotEmpty()) {
                $imagenPrincipal = $anuncio->imagenes->random();
            } elseif (!$imagenPrincipal) {
                // Imagen por defecto si no tiene imágenes
                $imagenPrincipal = (object)['ruta' => '/ImgLogoDefecto.png'];
            }

            $anuncio->imagenPrincipal = $imagenPrincipal;
        }

        // Pasar los datos a la vista
        return view('welcome', compact('anuncios', 'generos', 'municipios', 'nacionalidades', 'servicios'));
    }

    public function show($nombre, $id_anuncio)
    {
        $anuncio = Anuncio::with(['imagenes', 'nacionalidad', 'municipio', 'genero'])->findOrFail($id_anuncio);
        if (Str::slug($anuncio->nombre) !== $nombre) {
            return redirect()->route('anuncio', [
                'nombre' => Str::slug($anuncio->nombre),
                'id_anuncio' => $anuncio->id
            ], 301);
        }

        $anunciosRelacionados = $this->obtenerAnunciosRelacionados($anuncio);

        $imagenPrincipal = $anuncio->imagenes->isEmpty()
            ? (object)['ruta' => '/ImgAnuncio.png']
            : $anuncio->imagenes->first();

        return view('anuncio', compact('anuncio', 'imagenPrincipal', 'anunciosRelacionados'));
    }

    // Función para obtener anuncios relacionados
    private function obtenerAnunciosRelacionados($anuncio)
    {
        $anunciosRelacionados = Anuncio::with('imagenes', 'nacionalidad', 'municipio', 'genero')
            ->where('estado', 1)
            ->where('id_municipio', $anuncio->id_municipio)
            ->where('id', '!=', $anuncio->id)
            ->limit(3)
            ->get();
        if ($anunciosRelacionados->isEmpty()) {
            $anunciosRelacionados = Anuncio::with('imagenes', 'nacionalidad', 'municipio', 'genero')
                ->where('estado', 1)
                ->where('id_nacionalidad', $anuncio->id_nacionalidad)
                ->where('id', '!=', $anuncio->id)
                ->limit(3)
                ->get();
        }
        if ($anunciosRelacionados->isEmpty()) {
            $anunciosRelacionados = Anuncio::with('imagenes', 'nacionalidad', 'municipio', 'genero')
                ->where('estado', 1)
                ->where('id_genero', $anuncio->id_genero)
                ->where('id', '!=', $anuncio->id)
                ->limit(3)
                ->get();
        }
        if ($anunciosRelacionados->count() < 3) {
            $cantidadFaltante = 3 - $anunciosRelacionados->count();
            $anunciosAleatorios = Anuncio::with('imagenes', 'nacionalidad', 'municipio', 'genero')
                ->where('estado', 1)
                ->where('id', '!=', $anuncio->id) 
                ->inRandomOrder() 
                ->limit($cantidadFaltante) 
                ->get();
            $anunciosRelacionados = $anunciosRelacionados->merge($anunciosAleatorios);
        }


        return $anunciosRelacionados;
    }
}
