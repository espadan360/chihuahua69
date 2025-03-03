<?php
namespace App\Http\Controllers;

use App\Models\Anuncio;
use Illuminate\Http\Request;
use App\Models\Imagen;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

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
        // Validaciones del anuncio
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
            'imagenes' => 'nullable|array',
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $request->merge(['id_usuario' => Auth::id()]);
    
        $anuncio = Anuncio::create($request->all());
    
        // Subimos las imágenes
        if ($request->hasFile('imagenes')) {
            $imagenes = $request->file('imagenes');
            $rutaDirectorio = 'anuncios/' . $anuncio->id;
    
            $isPrincipalSet = false;
    
            foreach ($imagenes as $imagen) {
                $ruta = $imagen->store($rutaDirectorio, 'public');
    
                // Si aún no hemos asignado una imagen como principal, la primera imagen será la principal
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
        return view('anuncios.edit', compact('anuncio'));
    }

    public function update(Request $request, Anuncio $anuncio)
    {
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
            'imagenes' => 'nullable|array',
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'eliminar_imagenes' => 'nullable|array',
            'eliminar_imagenes.*' => 'exists:imagenes,id',
        ]);
    
        // Actualizar el anuncio
        $anuncio->update($request->all());
    
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
    
    

    public function destroy(Anuncio $anuncio)
    {
        $anuncio->delete();
        return redirect()->route('anuncios.index');
    }
}
