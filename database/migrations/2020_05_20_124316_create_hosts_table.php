<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hosts', function (Blueprint $table) {
            $table->id('id');
            $table->integer('os_id');
            $table->integer('host_type_id');
            $table->integer('status_id');
            $table->String('tag');
            $table->String('hostname');
            $table->String('domain_suffix');
            $table->String('descr');
            $table->String('obs');
            $table->String('chassis_id');
            $table->timestamps();

//            $table->foreign('status_id')->references('id')->on('host_statuses');
//            $table->foreign('host_type_id')->references('id')->on('host_types');
//            $table->foreign('os_id')->references('id')->on('operating_systems');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hosts');
    }
}
