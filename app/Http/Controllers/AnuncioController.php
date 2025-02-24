<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use Illuminate\Http\Request;

class AnuncioController extends Controller
{
    public function index()
    {
        $anuncios = Anuncio::all();
        return view('anuncios.index', compact('anuncios'));
    }

    public function create()
    {
        return view('anuncios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'genero' => 'required|string',
            'edad' => 'required|integer',
            // Agregar las validaciones necesarias...
        ]);

        Anuncio::create($request->all());
        return redirect()->route('anuncios.index');
    }

    public function edit(Anuncio $anuncio)
    {
        return view('anuncios.edit', compact('anuncio'));
    }

    public function update(Request $request, Anuncio $anuncio)
    {
        $request->validate([
            'genero' => 'required|string',
            // Agregar validaciones...
        ]);

        $anuncio->update($request->all());
        return redirect()->route('anuncios.index');
    }

    public function destroy(Anuncio $anuncio)
    {
        $anuncio->delete();
        return redirect()->route('anuncios.index');
    }
}
