<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Campus', function (Blueprint $table) {
            $table->string('crmit_tb_campusid', 40);
            $table->decimal('crmit_codigounico', 10, 0);
            $table->string('crmi_name');
            $table->primary('crmit_tb_campusid');
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
        Schema::dropIfExists('Campus');
    }
}
