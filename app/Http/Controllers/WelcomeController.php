<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        // Configurar los filtros que quieres permitir
        $anuncios = QueryBuilder::for(Anuncio::class)
            ->with(['imagenes', 'nacionalidad', 'municipio', 'genero']) 
            ->where('estado', 1)
            ->allowedFilters([
                AllowedFilter::exact('municipio'),
                AllowedFilter::exact('nacionalidad'),
                AllowedFilter::exact('servicios'),
                AllowedFilter::partial('genero'),
                AllowedFilter::scope('edad'),
            ])
            ->get();

        // Verificar si hay anuncios
        if ($anuncios->isEmpty()) {
            return view('welcome')->with('message', 'No hay anuncios disponibles.');
        }

        // Procesar las imágenes para cada anuncio
        foreach ($anuncios as $anuncio) {
            $imagenPrincipal = $anuncio->imagenes->where('principal', 1)->first();
            if (!$imagenPrincipal && $anuncio->imagenes->count() > 0) {
                $imagenPrincipal = $anuncio->imagenes->random();
            }
            $anuncio->imagenPrincipal = $imagenPrincipal;
        }

        // Pasar los anuncios a la vista 'welcome'
        return view('welcome', compact('anuncios'));
    }


    public function show($id)
    {
        // Obtener el anuncio con sus imágenes
        $anuncio = Anuncio::with('imagenes', 'nacionalidad', 'municipio', 'genero')->findOrFail($id);

        // Verificar si el anuncio tiene imágenes
        if ($anuncio->imagenes->isEmpty()) {
            return redirect()->route('welcome')->with('message', 'Este anuncio no tiene imágenes.');
        }

        // Pasar el anuncio a la vista de detalles
        return view('anuncio', compact('anuncio'));
    }
}
