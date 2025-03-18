<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use Illuminate\Http\Request;

class AdministracionController extends Controller
{
    public function index()
    {
        $anunciosPendientes = Anuncio::with('genero', 'nacionalidad', 'municipio')
            ->where('estado', 3)
            ->get();
    
        return view('administracion.index', compact('anunciosPendientes'));
    }

    public function permitir(Anuncio $anuncio)
    {
        // Cambiar el estado a 1 (permitido)
        $anuncio->update(['estado' => 1]);

        return redirect()->route('administracion.index')->with('success', 'Anuncio permitido');
    }

    public function denegar(Anuncio $anuncio)
    {
        // Cambiar el estado a 4 (denegado)
        $anuncio->update(['estado' => 4]);

        return redirect()->route('administracion.index')->with('success', 'Anuncio denegado');
    }

    public function show($id)
    {
        // Obtener el anuncio con sus imágenes y relaciones
        $anuncio = Anuncio::with(['imagenes', 'nacionalidad', 'municipio', 'genero'])->findOrFail($id);
    
        // Verificar si el anuncio tiene imágenes
        $imagenPrincipal = $anuncio->imagenes->isEmpty() 
                            ? (object)['ruta' => '/ImgAnuncio.png'] // Ruta por defecto si no tiene imágenes
                            : $anuncio->imagenes->first(); // Si tiene imágenes, obtener la primera
    
        // Pasar el anuncio y la imagen principal a la vista de detalles
        return view('anuncio', compact('anuncio', 'imagenPrincipal'));
    }
}
