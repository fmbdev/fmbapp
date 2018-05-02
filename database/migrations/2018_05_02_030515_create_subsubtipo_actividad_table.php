<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubsubtipoActividadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subsubtipo_actividad', function (Blueprint $table) {
            $table->increments('id');
            $table->string('crmit_subsubname');
            $table->string('crmit_subtipoactividadid');
            $table->string('crmit_codigounico');
            $table->string('crmit_subname');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subsubtipo_actividad');
    }
}
