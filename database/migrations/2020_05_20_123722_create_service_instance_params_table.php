<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceInstanceParamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_instance_params', function (Blueprint $table) {
            $table->id('id');
            $table->integer('service_instance_id');
            $table->String('param_name');
            $table->String('param_value');
            $table->timestamps();

            $table->foreign('service_instance_id')->references('id')->on('service_instances');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_instance_params');
    }
}
