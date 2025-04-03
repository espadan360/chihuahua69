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
        $anuncios = Anuncio::with('nacionalidad', 'municipio', 'genero', 'servicios', 'imagenes')->where('id_usuario', Auth::id())->get();
        foreach ($anuncios as $anuncio) {
            $imagenPrincipal = $anuncio->imagenes->firstWhere('principal', 1);

            // Si no tiene imagen principal, asignar una imagen por defecto
            if (!$imagenPrincipal && $anuncio->imagenes->isEmpty()) {
                $imagenPrincipal = (object)['ruta' => '/LogoChihuahua.png'];
            }

            // Asignamos la imagen principal (o la predeterminada) al anuncio
            $anuncio->imagenPrincipal = $imagenPrincipal;
        }

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
            'edad' => 'required|integer',
            'nombre' => 'required|string',
            'tarifa_general' => 'nullable|string',
            'fumas' => 'required|integer|in:0,1',
            'telefono' => 'required|string',
            'id_nacionalidad' => 'required|exists:nacionalidades,id',
            'id_municipio' => 'required|exists:municipios,id',
            'lugar_atiendo' => 'string',
            'horarios_atiendo' => 'string',
            'medidas' => 'nullable|string',
            'altura' => 'nullable|string',
            'peso' => 'nullable|string',
            'descripcion' => 'required|string|max:800',
            'me_gusta' => 'integer',
            'imagenes' => 'nullable|array',
            'imagenes.*' => 'image|mimes:jpeg,png,jpg|max:8000',
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
            'edad' => 'required|integer',
            'nombre' => 'required|string',
            'tarifa_general' => 'nullable|string',
            'fumas' => 'required|integer|in:0,1',
            'telefono' => 'required|string',
            'id_nacionalidad' => 'required|exists:nacionalidades,id',
            'id_municipio' => 'required|exists:municipios,id',
            'lugar_atiendo' => 'string',
            'horarios_atiendo' => 'string',
            'medidas' => 'nullable|string',
            'altura' => 'nullable|string',
            'peso' => 'nullable|string',
            'descripcion' => 'required|string|max:800',
            'me_gusta' => 'integer',
            'imagenes' => 'nullable|array',
            'imagenes.*' => 'image|mimes:jpeg,png,jpg|max:8000',
            'servicios' => 'required|array',
            'servicios.*' => 'exists:servicios,id',
        ]);

        $anuncio->update($request->except('servicios'));
        $anuncio->servicios()->sync($request->servicios);

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
        foreach ($anuncio->imagenes as $imagen) {
            Storage::disk('public')->delete($imagen->ruta);
            $imagen->delete();
        }
        $anuncio->servicios()->detach();
        $anuncio->delete();
        return redirect()->route('anuncios.index')->with('success', 'Anuncio eliminado correctamente.');
    }
}
