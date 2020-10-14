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
            $table->bigIncrements('id');
            $table->bigInteger('service_instance_id');
            $table->foreign('service_instance_id')->references('id')->on('service_instances');
            $table->string('param_name',250);
            $table->string('param_value',250);
            $table->boolean('enabled')->default(true);
            $table->timestamps();
            $table->unique(array('service_instance_id', 'param_name'));
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
