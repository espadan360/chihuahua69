<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use Illuminate\Http\Request;
use App\Models\Imagen;
use App\Models\Nacionalidad;
use App\Models\Municipio;
use App\Models\Servicio;
use App\Models\Genero;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AnuncioController extends Controller
{
    public function index()
    {
        $anuncios = Anuncio::with('nacionalidad', 'municipio', 'genero', 'servicios')->where('id_usuario', Auth::id())->get();
        return view('anuncios.index', compact('anuncios'));
    }

    public function create()
    {
        $nacionalidades = Nacionalidad::all();
        $municipios = Municipio::all();
        $generos = Genero::all();
        $servicios = Servicio::all();
        return view('anuncios.create', compact('nacionalidades', 'municipios', 'generos', 'servicios'));
    }


    public function store(Request $request)
    {
        // Validaciones del anuncio
        $request->validate([
            'id_genero' => 'required|exists:generos,id',
            'edad' => 'integer',
            'nombre' => 'string',
            'precio' => 'string',
            'fumas' => 'required|integer|in:0,1',
            'telefono' => 'string',
            'id_nacionalidad' => 'required|exists:nacionalidades,id',
            'id_municipio' => 'required|exists:municipios,id',
            'lugar_atiendo' => 'string',
            'horarios_atiendo' => 'string',
            'medidas' => 'string',
            'altura' => 'string',
            'peso' => 'string',
            'descripcion' => 'string',
            'me_gusta' => 'integer',
            'imagenes' => 'nullable|array',
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'servicios' => 'required|array',
            'servicios.*' => 'exists:servicios,id',
        ]);


        $request->merge(['id_usuario' => Auth::id()]);

        $anuncio = Anuncio::create($request->except('servicios'));

        // Guardar servicios en la tabla pivote
        $anuncio->servicios()->sync($request->servicios);

        if ($request->hasFile('imagenes')) {
            $imagenes = $request->file('imagenes');
            $rutaDirectorio = 'anuncios/' . $anuncio->id;

            $isPrincipalSet = false;

            foreach ($imagenes as $imagen) {
                $ruta = $imagen->store($rutaDirectorio, 'public');

                $principal = $isPrincipalSet ? null : 1;
                $isPrincipalSet = true;

                Imagen::create([
                    'id_anuncio' => $anuncio->id,
                    'ruta' => $ruta,
                    'principal' => $principal,
                ]);
            }
        }

        return redirect()->route('anuncios.index');
    }



    public function edit(Anuncio $anuncio)
    {
        $nacionalidades = Nacionalidad::all();
        $municipios = Municipio::all();
        $generos = Genero::all();
        $servicios = Servicio::all();

        return view('anuncios.edit', compact('anuncio', 'nacionalidades', 'municipios', 'generos', 'servicios'));
    }


    public function update(Request $request, Anuncio $anuncio)
    {
        $request->validate([
            'id_genero' => 'required|exists:generos,id',
            'edad' => 'integer',
            'nombre' => 'string',
            'telefono' => 'string',
            'id_nacionalidad' => 'required|exists:nacionalidades,id',
            'id_municipio' => 'required|exists:municipios,id',
            'lugar_atiendo' => 'string',
            'horarios_atiendo' => 'string',
            'medidas' => 'string',
            'fumas' => 'required|integer|in:0,1',
            'altura' => 'string',
            'peso' => 'string',
            'descripcion' => 'string',
            'me_gusta' => 'integer',
            'precio' => 'string',
            'imagenes' => 'nullable|array',
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'eliminar_imagenes' => 'nullable|array',
            'eliminar_imagenes.*' => 'exists:imagenes,id',
            'servicios' => 'required|array',
            'servicios.*' => 'exists:servicios,id',
        ]);

        $anuncio->update($request->except('servicios'));
        $anuncio->servicios()->sync($request->servicios); // Actualizar servicios en la tabla pivote

        // Eliminar imágenes seleccionadas
        if ($request->has('eliminar_imagenes')) {
            foreach ($request->eliminar_imagenes as $imagenId) {
                $imagen = Imagen::find($imagenId);
                if ($imagen && $imagen->id_anuncio == $anuncio->id) {
                    Storage::disk('public')->delete($imagen->ruta);
                    $imagen->delete();
                }
            }
        }

        // Marcar como principal la imagen seleccionada
        if ($request->has('imagen_principal')) {
            // Establecer principal en null para todas las imágenes
            Imagen::where('id_anuncio', $anuncio->id)->update(['principal' => null]);

            // Establecer la imagen seleccionada como principal
            $imagenPrincipal = Imagen::find($request->imagen_principal);
            if ($imagenPrincipal) {
                $imagenPrincipal->update(['principal' => 1]);
            }
        }

        // Subir nuevas imágenes
        if ($request->hasFile('imagenes')) {
            $imagenes = $request->file('imagenes');
            $rutaDirectorio = 'anuncios/' . $anuncio->id;

            $isPrincipalSet = false;

            foreach ($imagenes as $imagen) {
                $ruta = $imagen->store($rutaDirectorio, 'public');

                $principal = $isPrincipalSet ? null : 1;
                $isPrincipalSet = true;

                Imagen::create([
                    'id_anuncio' => $anuncio->id,
                    'ruta' => $ruta,
                    'principal' => $principal,
                ]);
            }
        }

        return redirect()->route('anuncios.index');
    }

    public function cambiarEstado(Anuncio $anuncio)
    {
        $newEstado = ($anuncio->estado == 1) ? 2 : 1;
        $anuncio->update(['estado' => $newEstado]);

        return redirect()->route('anuncios.index');
    }


    public function destroy(Anuncio $anuncio)
    {
        $anuncio->delete();
        return redirect()->route('anuncios.index');
    }
}
