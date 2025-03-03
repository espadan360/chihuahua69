<?php
namespace App\Http\Controllers;

use App\Models\Anuncio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Asegúrate de importar la clase Auth

class AnuncioController extends Controller
{
    public function index()
    {
        $anuncios = Anuncio::where('id_usuario', Auth::id())->get();
        return view('anuncios.index', compact('anuncios'));
    }

    public function create()
    {
        return view('anuncios.create');
    }

    public function store(Request $request)
    {
        // Eliminamos las validaciones de 'required' para el campo 'id_usuario'
        $request->validate([
            'genero' => 'string',
            'edad' => 'integer',
            'telefono' => 'string',
            'nacionalidad' => 'string',
            'servicios' => 'string',
            'municipio' => 'string',
            'lugar_atiendo' => 'string',
            'horarios_atiendo' => 'string',
            'medidas' => 'string',
            'altura' => 'string',
            'peso' => 'string',
            'descripcion' => 'string',
            'me_gusta' => 'integer',
        ]);

        // Agregamos el ID del usuario autenticado al campo 'id_usuario'
        $request->merge(['id_usuario' => Auth::id()]); // Asignamos el ID del usuario actual

        // Guardamos el anuncio en la base de datos
        Anuncio::create($request->all());

        // Redirigimos al índice de anuncios
        return redirect()->route('anuncios.index');
    }

    public function edit(Anuncio $anuncio)
    {
        return view('anuncios.edit', compact('anuncio'));
    }

    public function update(Request $request, Anuncio $anuncio)
    {
        // Eliminamos las validaciones de 'required' para el campo 'id_usuario'
        $request->validate([
            'genero' => 'string',
            'edad' => 'integer',
            'telefono' => 'string',
            'nacionalidad' => 'string',
            'servicios' => 'string',
            'municipio' => 'string',
            'lugar_atiendo' => 'string',
            'horarios_atiendo' => 'string',
            'medidas' => 'string',
            'altura' => 'string',
            'peso' => 'string',
            'descripcion' => 'string',
            'me_gusta' => 'integer',
        ]);

        // Actualizamos el anuncio
        $anuncio->update($request->all());

        // Redirigimos al índice de anuncios
        return redirect()->route('anuncios.index');
    }

    public function destroy(Anuncio $anuncio)
    {
        $anuncio->delete();
        return redirect()->route('anuncios.index');
    }
}
