<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEscuelaEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Escuela-Empresa', function (Blueprint $table) {
            $table->decimal('crmit_claveescuelaempresacrm',10, 0);
            $table->string('TerritoryId');
            $table->string('Name');
            $table->string('crmit_calidadid');
            $table->string('crmit_descturno1');
            $table->string('crmit_empresaescuela');
            $table->string('crmit_descturno3');
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
        Schema::dropIfExists('Escuela-Empresa');
    }
}
