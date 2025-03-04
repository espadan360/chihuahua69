<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrecioToAnunciosTable extends Migration
{
    /**
     * Ejecuta la migración.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('anuncios', function (Blueprint $table) {
            // Añadir el campo 'precio' a la tabla anuncios
            $table->decimal('precio', 8, 2)->nullable()->after('municipio');
        });
    }

    /**
     * Deshacer la migración.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('anuncios', function (Blueprint $table) {
            // Eliminar el campo 'precio' en caso de rollback
            $table->dropColumn('precio');
        });
    }
}
