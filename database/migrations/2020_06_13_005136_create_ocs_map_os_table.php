<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOcsMapOsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ocs_map_os', function (Blueprint $table) {
            $table->id('id');
            $table->integer('operating_system_id');
            $table->String('ocs_os_name_match');
            $table->timestamps();

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
        Schema::dropIfExists('ocs_map_os');
    }
}
