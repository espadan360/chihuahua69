<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFumasToAnunciosTable extends Migration
{
    public function up()
    {
        Schema::table('anuncios', function (Blueprint $table) {
            $table->integer('fumas')->after('precio')->nullable(); // Usamos nullable en caso de que no quieras obligar a rellenar este campo
        });
    }

    public function down()
    {
        Schema::table('anuncios', function (Blueprint $table) {
            $table->dropColumn('fumas');
        });
    }
}
