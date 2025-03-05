<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyAnunciosTableForNacionalidades extends Migration
{
    public function up()
    {
        Schema::table('anuncios', function (Blueprint $table) {
            // Cambiar el tipo de columna de nacionalidad a id_nacionalidad y establecer como foreign key
            $table->dropColumn('nacionalidad');
            $table->unsignedBigInteger('id_nacionalidad')->after('id');  // Puedes colocarlo donde prefieras en la tabla

            $table->foreign('id_nacionalidad')
                  ->references('id')
                  ->on('nacionalidades')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('anuncios', function (Blueprint $table) {
            $table->dropForeign(['id_nacionalidad']);
            $table->dropColumn('id_nacionalidad');
            $table->string('nacionalidad')->nullable();  // Restaura el campo original si se revierte la migración
        });
    }
}
