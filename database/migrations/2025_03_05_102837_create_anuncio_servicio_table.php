<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('anuncio_servicio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_anuncio')->constrained('anuncios')->onDelete('cascade');
            $table->foreignId('id_servicio')->constrained('servicios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('anuncio_servicio');
    }
};
