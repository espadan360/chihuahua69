<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNombreToAnunciosTable extends Migration
{
    public function up()
    {
        Schema::table('anuncios', function (Blueprint $table) {
            $table->string('nombre', 100)->after('id')->nullable(); // Asumiendo que quieres que sea opcional
        });
    }

    public function down()
    {
        Schema::table('anuncios', function (Blueprint $table) {
            $table->dropColumn('nombre');
        });
    }
}
