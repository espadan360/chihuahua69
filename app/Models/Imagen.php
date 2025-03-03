<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    use HasFactory;

    protected $table = 'imagenes';

    protected $fillable = ['id_anuncio', 'ruta', 'principal']; // Agregamos 'principal' al fillable

    // Relación con el modelo Anuncio
    public function anuncio()
    {
        return $this->belongsTo(Anuncio::class, 'id_anuncio');
    }
}

