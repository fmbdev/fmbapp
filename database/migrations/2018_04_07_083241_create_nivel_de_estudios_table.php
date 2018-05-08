<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNivelDeEstudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Nivel_de_Estudios', function (Blueprint $table) {
            $table->string('crmit_codigounico', 40);
            $table->string('crmit_name', 100);
            $table->primary('crmit_codigounico');
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
        Schema::dropIfExists('Nivel_de_Estudios');
    }
}
