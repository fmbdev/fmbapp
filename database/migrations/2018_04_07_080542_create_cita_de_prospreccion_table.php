<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitaDeProspreccionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Cita_de_Prospreccion', function (Blueprint $table) {
            $table->string('RegardingObjectId');
            $table->date('crmit_fechacierre');
            $table->date('ScheduledStar');
            $table->date('ScheduledEnd');
            $table->decimal('crmit_nocita', 10, 0);
            $table->string('Subject');
            $table->integer('statuscode');
            $table->integer('id');
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
        Schema::dropIfExists('Cita_de_Prospreccion');
    }
}
