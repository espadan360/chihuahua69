<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    use HasFactory;

    protected $fillable = [
        'genero', 'edad', 'telefono', 'nacionalidad', 'servicios', 
        'municipio', 'lugar_atiendo', 'horarios_atiendo', 'horas',
        'medidas', 'altura', 'peso', 'descripcion', 'imagen', 
        'me_gusta', 'id_usuario'
    ];
}
