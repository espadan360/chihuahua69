<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAnunciosTable extends Migration
{
    public function up()
    {
        Schema::table('anuncios', function (Blueprint $table) {
            // Añadir el campo tarifa_hora de tipo entero (3 cifras)
            $table->integer('tarifa_hora')->nullable()->unsigned()->default(0);

            // Modificar el campo precio a tarifa_general
            $table->renameColumn('precio', 'tarifa_general');
        });
    }

    public function down()
    {
        Schema::table('anuncios', function (Blueprint $table) {
            // Eliminar el campo tarifa_hora
            $table->dropColumn('tarifa_hora');

            // Volver a cambiar el nombre de tarifa_general a precio
            $table->renameColumn('tarifa_general', 'precio');
        });
    }
}
