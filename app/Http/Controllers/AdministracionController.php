<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdministracionController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->nivel_acceso != 1) {
            return redirect()->route('dashboard')->with('error', 'No tienes permiso para acceder.');
        }

        $anunciosPendientes = Anuncio::with('genero', 'nacionalidad', 'municipio')
            ->where('estado', 3)
            ->get();

        return view('administracion.index', compact('anunciosPendientes'));
    }



    public function permitir(Anuncio $anuncio)
    {
        if (Auth::check() && Auth::user()->nivel_acceso != 1) {
            return redirect()->route('dashboard')->with('error', 'No tienes permiso para acceder.');
        }
        $anuncio->update(['estado' => 1]);

        return redirect()->route('administracion.index')->with('success', 'Anuncio permitido');
    }


    public function denegar(Anuncio $anuncio)
    {
        if (Auth::check() && Auth::user()->nivel_acceso != 1) {
            return redirect()->route('dashboard')->with('error', 'No tienes permiso para acceder.');
        }
        // Cambiar el estado a 4 (denegado)
        $anuncio->update(['estado' => 4]);

        return redirect()->route('administracion.index')->with('success', 'Anuncio denegado');
    }

    public function show($id)
    {
        if (Auth::check() && Auth::user()->nivel_acceso != 1) {
            return redirect()->route('dashboard')->with('error', 'No tienes permiso para acceder.');
        }
        $anuncio = Anuncio::with(['imagenes', 'nacionalidad', 'municipio', 'genero'])->findOrFail($id);

        $imagenPrincipal = $anuncio->imagenes->isEmpty()
            ? (object)['ruta' => '/ImgAnuncio.png'] // Ruta por defecto si no tiene imágenes
            : $anuncio->imagenes->first(); 

        return view('anuncio', compact('anuncio', 'imagenPrincipal'));
    }
}
