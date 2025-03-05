<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyAnunciosTableForGeneros extends Migration
{
    public function up()
    {
        Schema::table('anuncios', function (Blueprint $table) {
            $table->dropColumn('genero'); // Eliminar la columna actual de género
            $table->unsignedBigInteger('id_genero')->after('telefono')->nullable();
            $table->foreign('id_genero')->references('id')->on('generos')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('anuncios', function (Blueprint $table) {
            $table->dropForeign(['id_genero']);
            $table->dropColumn('id_genero');
            $table->string('genero')->nullable();  // Restaura la columna de género como estaba originalmente
        });
    }
}
