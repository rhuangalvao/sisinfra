<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSnmpHostAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snmp_host_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('snmp_host_id');
            $table->foreign('snmp_host_id')->references('id')->on('snmp_hosts');
            $table->string('address', 250);
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
        Schema::dropIfExists('snmp_host_addresses');
    }
}
