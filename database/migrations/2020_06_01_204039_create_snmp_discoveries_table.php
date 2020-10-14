<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSnmpDiscoveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snmp_discoveries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('network_id');
            $table->foreign('network_id')->references('id')->on('networks');
            $table->bigInteger('snmp_cmm_id');
            $table->foreign('snmp_cmm_id')->references('id')->on('snmp_cmms');
            $table->boolean('enabled')->default(true);
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
        Schema::dropIfExists('snmp_discoveries');
    }
}
