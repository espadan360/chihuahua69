<?php
namespace App\Models; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Anuncio;

class Servicio extends Model
{
    use HasFactory;

    protected $table = 'servicios';
    protected $fillable = ['nombre_servicio'];

    public function anuncios()
    {
        return $this->belongsToMany(Anuncio::class, 'anuncio_servicio', 'id_servicio', 'id_anuncio');
    }
}
