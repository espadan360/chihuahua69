<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla si no sigue la convención de nombres de Laravel
    protected $table = 'generos';

    // Define los campos que pueden ser asignados masivamente
    protected $fillable = ['nombre_genero'];

    // Relación con el modelo Anuncio
    public function anuncios()
    {
        return $this->hasMany(Anuncio::class, 'id_genero');
    }
}
