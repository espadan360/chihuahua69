<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;

class WelcomeController extends Controller
{
    public function index()
    {
        // Obtener todos los anuncios con sus imágenes
        $anuncios = Anuncio::with('imagenes')->get();

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
