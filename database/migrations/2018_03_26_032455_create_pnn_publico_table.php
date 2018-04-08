<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePnnPublicoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pnn_publico', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nir');
            $table->string('serie');
            $table->string('numeracion_inicial');
            $table->string('numeracion_final');
            $table->string('_serie');
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
        Schema::dropIfExists('pnn_publico');
    }
}
