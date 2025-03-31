<?php
// database/migrations/xxxx_xx_xx_xxxxxx_add_foreign_keys_to_anuncio_servicio_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAnuncioServicioTable extends Migration
{
    public function up()
    {
        Schema::table('anuncio_servicio', function (Blueprint $table) {
            // Agregar claves foráneas con la opción `onDelete('cascade')`
            $table->foreign('id_anuncio')->references('id')->on('anuncios')->onDelete('cascade');
            $table->foreign('id_servicio')->references('id')->on('servicios')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('anuncio_servicio', function (Blueprint $table) {
            // Eliminar claves foráneas
            $table->dropForeign(['id_anuncio']);
            $table->dropForeign(['id_servicio']);
        });
    }
}
