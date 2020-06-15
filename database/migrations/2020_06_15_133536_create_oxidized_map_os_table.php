<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOxidizedMapOsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oxidized_map_os', function (Blueprint $table) {
            $table->id('id');
            $table->integer('oxidized_instance_id');
            $table->integer('operating_system_id');
            $table->String('oxidized_os');
            $table->timestamps();

            //$table->foreign('oxidized_instance_id')->references('id')->on('oxidized_instance');
            //$table->foreign('operating_system_id')->references('id')->on('operating_system');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oxidized_map_os');
    }
}
