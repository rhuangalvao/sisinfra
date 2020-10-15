<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('host_maps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('host_id')->unique();
            $table->foreign('host_id')->references('id')->on('hosts');

            $table->bigInteger('snmp_host_id')->nullable()->unique();
            $table->foreign('snmp_host_id')->references('id')->on('snmp_hosts');

            $table->bigInteger('snmp_host_remote_id')->nullable()->unique();
            $table->foreign('snmp_host_remote_id')->references('id')->on('snmp_host_remotes');
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
        Schema::dropIfExists('host_maps');
    }
}
