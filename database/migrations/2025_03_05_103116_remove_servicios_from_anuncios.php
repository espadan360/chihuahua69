<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('anuncios', function (Blueprint $table) {
            $table->dropColumn('servicios'); // Eliminar columna innecesaria
        });
    }

    public function down()
    {
        Schema::table('anuncios', function (Blueprint $table) {
            $table->string('servicios', 255); // En caso de rollback, se puede restaurar
        });
    }
};
