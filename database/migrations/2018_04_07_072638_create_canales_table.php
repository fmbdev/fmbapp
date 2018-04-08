<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCanalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Canales', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('crmit_codigounico', 9,2);
            $table->string('crmit_name');
            $table->decimal('crmit_quedefine');
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
        Schema::dropIfExists('Canales');
    }
}
