<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;

class WelcomeController extends Controller
{
    public function index()
    {
        // Obtener todos los anuncios
        $anuncios = Anuncio::all();

        // Verificar si hay anuncios
        if ($anuncios->isEmpty()) {
            return view('welcome')->with('message', 'No hay anuncios disponibles.');
        }

        // Pasar los anuncios a la vista 'welcome'
        return view('welcome', compact('anuncios'));
    }
}
