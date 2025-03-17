<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Anuncio extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_genero',
        'edad',
        'telefono',
        'id_nacionalidad',
        'id_municipio',
        'lugar_atiendo',
        'horarios_atiendo',
        'medidas',
        'altura',
        'peso',
        'descripcion',
        'me_gusta',
        'id_usuario',
        'estado',
        'tarifa_general',
        'nombre',
        'fumas',
        'tarifa_hora'
    ];

    // Relación con las imágenes
    public function imagenes()
    {
        return $this->hasMany(Imagen::class, 'id_anuncio'); 
    }
    public function nacionalidad()
    {
        return $this->belongsTo(Nacionalidad::class, 'id_nacionalidad');
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'id_municipio');
    }

    public function genero()
    {
        return $this->belongsTo(Genero::class, 'id_genero');
    }

    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'anuncio_servicio', 'id_anuncio', 'id_servicio');
    }
}
