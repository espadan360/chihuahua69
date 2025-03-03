<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnunciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anuncios', function (Blueprint $table) {
            $table->id();
            $table->string('genero');
            $table->integer('edad');
            $table->integer('telefono');
            $table->string('nacionalidad');
            $table->string('servicios');
            $table->string('municipio');
            $table->string('lugar_atiendo');
            $table->string('horarios_atiendo');
            $table->string('medidas');
            $table->string('altura');
            $table->string('peso');
            $table->text('descripcion');
            $table->string('imagen');
            $table->integer('me_gusta')->default(0);
            $table->foreignId('id_usuario')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anuncios');
    }
}
