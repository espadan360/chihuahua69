<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        // Obtener solo los anuncios con estado = 1 (activados)
        $query = Anuncio::with('imagenes')->where('estado', 1);
    
        // Aplicar filtros si están presentes en la solicitud
        if ($request->has('genero') && $request->genero != '') {
            $query->where('genero', $request->genero);
        }
    
        if ($request->has('nacionalidad') && $request->nacionalidad != '') {
            $query->where('nacionalidad', $request->nacionalidad);
        }
    
        if ($request->has('servicios') && $request->servicios != '') {
            $query->where('servicios', 'like', '%' . $request->servicios . '%');
        }
    
        if ($request->has('municipio') && $request->municipio != '') {
            $query->where('municipio', $request->municipio);
        }
    
        // Filtrar el campo precio para coincidencias parciales
        if ($request->has('precio') && $request->precio != '') {
            // Solo hacer un filtro de coincidencias parciales sin manipular la entrada
            $query->where('precio', 'like', '%' . $request->precio . '%');
        }
    
        // Ejecutar la consulta y obtener los anuncios
        $anuncios = $query->get();
    
        // Verificar si hay anuncios
        if ($anuncios->isEmpty()) {
            return view('welcome')->with('message', 'No hay anuncios disponibles.');
        }
    
        // Procesar las imágenes para cada anuncio
        foreach ($anuncios as $anuncio) {
            // Buscar la imagen principal
            $imagenPrincipal = $anuncio->imagenes->where('principal', 1)->first();
    
            // Si no hay imagen principal, seleccionar una aleatoria
            if (!$imagenPrincipal && $anuncio->imagenes->count() > 0) {
                $imagenPrincipal = $anuncio->imagenes->random();
            }
    
            // Asignar la imagen principal al anuncio
            $anuncio->imagenPrincipal = $imagenPrincipal;
        }
    
        // Pasar los anuncios a la vista 'welcome'
        return view('welcome', compact('anuncios'));
    }
    

    public function show($id)
    {
        // Obtener el anuncio con sus imágenes
        $anuncio = Anuncio::with('imagenes')->findOrFail($id);

        // Verificar si el anuncio tiene imágenes
        if ($anuncio->imagenes->isEmpty()) {
            return redirect()->route('welcome')->with('message', 'Este anuncio no tiene imágenes.');
        }

        // Pasar el anuncio a la vista de detalles
        return view('anuncio', compact('anuncio'));
    }
}
