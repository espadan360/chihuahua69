<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyAnunciosTableForMunicipios extends Migration
{
    public function up()
    {
        Schema::table('anuncios', function (Blueprint $table) {
            // Cambiar el nombre de la columna y establecer como foreign key
            $table->dropColumn('municipio');
            $table->unsignedBigInteger('id_municipio')->after('id_nacionalidad')->nullable();

            $table->foreign('id_municipio')
                  ->references('id')
                  ->on('municipios')
                  ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('anuncios', function (Blueprint $table) {
            $table->dropForeign(['id_municipio']);
            $table->dropColumn('id_municipio');
            $table->string('municipio')->nullable();  // Restaura el campo original si se revierte la migración
        });
    }
}
