<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('imagenes', function (Blueprint $table) {
            $table->boolean('principal')->default(false); // Cambiar a true para la imagen principal
        });
    }
    
    public function down()
    {
        Schema::table('imagenes', function (Blueprint $table) {
            $table->dropColumn('principal');
        });
    }
    
};
