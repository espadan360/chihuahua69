<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use App\Models\Genero;
use App\Models\Municipio;
use App\Models\Servicio;
use App\Models\Nacionalidad;
use Illuminate\Http\Request;
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
            ->when($request->filled('edad'), fn($query) => $query->where('edad', $request->edad))
            ->when($request->filled('telefono'), fn($query) => $query->where('telefono', 'like', '%' . $request->telefono . '%'))
            ->when($request->filled('lugar_atiendo'), fn($query) => $query->where('lugar_atiendo', 'like', '%' . $request->lugar_atiendo . '%'))
            ->when($request->filled('horarios_atiendo'), fn($query) => $query->where('horarios_atiendo', 'like', '%' . $request->horarios_atiendo . '%'))
            ->when($request->filled('medidas'), fn($query) => $query->where('medidas', 'like', '%' . $request->medidas . '%'))
            ->when($request->filled('altura'), fn($query) => $query->where('altura', $request->altura))
            ->when($request->filled('peso'), fn($query) => $query->where('peso', $request->peso))
            ->when($request->filled('descripcion'), fn($query) => $query->where('descripcion', 'like', '%' . $request->descripcion . '%'))
            ->when($request->filled('me_gusta'), fn($query) => $query->where('me_gusta', $request->me_gusta))
            ->when($request->filled('fumas'), fn($query) => $query->where('fumas', (int) $request->fumas))
            ->when($request->filled('precio_min'), fn($query) => $query->where('precio', '>=', $request->precio_min))
            ->when($request->filled('precio_max'), fn($query) => $query->where('precio', '<=', $request->precio_max))
            ->when($request->filled('servicio'), function ($query) use ($request) {
                $query->whereHas('servicios', function ($q) use ($request) {
                    $q->where('servicios.id', $request->servicio); // Se asegura de que el anuncio tenga este servicio
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
                $imagenPrincipal = (object)['ruta' => 'https://via.placeholder.com/300x200'];
            }

            $anuncio->imagenPrincipal = $imagenPrincipal;
        }

        // Pasar los datos a la vista
        return view('welcome', compact('anuncios', 'generos', 'municipios', 'nacionalidades', 'servicios'));
    }


    public function show($id)
    {
        // Obtener el anuncio con sus imágenes y relaciones
        $anuncio = Anuncio::with(['imagenes', 'nacionalidad', 'municipio', 'genero'])->findOrFail($id);

        // Verificar si el anuncio tiene imágenes
        if ($anuncio->imagenes->isEmpty()) {
            return redirect()->route('welcome')->with('message', 'Este anuncio no tiene imágenes.');
        }

        // Pasar el anuncio a la vista de detalles
        return view('anuncio', compact('anuncio'));
    }
}
