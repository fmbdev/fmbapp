<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampusCarreraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Campus_Carrera', function (Blueprint $table) {
            $table->string('campusId', 40);
            $table->string('carreraId', 40);
            $table->string('nivelId', 40);
            $table->string('modalidadId', 40);
            $table->primary(['campusId', 'carreraId', 'nivelId', 'modalidadId']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campus_carreras');
    }
}
