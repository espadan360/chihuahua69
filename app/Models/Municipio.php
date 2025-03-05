<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla si no sigue la convención de nombres de Laravel
    protected $table = 'municipios';

    // Especifica los campos que pueden ser asignados masivamente
    protected $fillable = ['nombre_municipio'];

    // Relación con el modelo Anuncio
    public function anuncios()
    {
        return $this->hasMany(Anuncio::class, 'id_municipio');
    }
}
