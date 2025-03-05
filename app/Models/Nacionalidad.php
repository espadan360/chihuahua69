<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nacionalidad extends Model
{
    use HasFactory;

    // Aquí puedes definir la tabla si no sigue las convenciones de nombre de Laravel
    protected $table = 'nacionalidades';

    // Define los campos que pueden ser asignados masivamente
    protected $fillable = ['nombre_nacionalidad'];

    // Relación con el modelo Anuncio
    public function anuncios()
    {
        return $this->hasMany(Anuncio::class, 'id_nacionalidad');
    }
}
