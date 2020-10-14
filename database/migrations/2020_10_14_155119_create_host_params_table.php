<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostParamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('host_params', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('host_id');
            $table->foreign('host_id')->references('id')->on('hosts');
            $table->string('param_name',250);
            $table->string('param_value',250);
            $table->boolean('enabled')->default(true);
            $table->timestamps();
            $table->unique(array('host_id', 'param_name'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('host_params');
    }
}
