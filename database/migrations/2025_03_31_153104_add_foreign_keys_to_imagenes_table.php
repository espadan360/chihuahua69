<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToImagenesTable extends Migration
{
    public function up()
    {
        Schema::table('imagenes', function (Blueprint $table) {
            // Agregar la clave foránea para la relación con `anuncios`
            $table->foreign('id_anuncio')->references('id')->on('anuncios')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('imagenes', function (Blueprint $table) {
            // Eliminar la clave foránea
            $table->dropForeign(['id_anuncio']);
        });
    }
}
