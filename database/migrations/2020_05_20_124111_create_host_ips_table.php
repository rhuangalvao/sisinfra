<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostIpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('host_ips', function (Blueprint $table) {
            $table->id('id');
            $table->integer('host_id');
            $table->String('ip_address');
            $table->integer('mask');
            $table->String('gateway');
            $table->integer('version');
            $table->String('mac_address');
            $table->timestamps();

//            $table->foreign('host_id')->references('id')->on('hosts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('host_ips');
    }
}
