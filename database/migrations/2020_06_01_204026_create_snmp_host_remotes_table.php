<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSnmpHostRemotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snmp_host_remotes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('snmp_host_id');
            $table->foreign('snmp_host_id')->references('id')->on('snmp_hosts');
            $table->string('chassisidsubtype',250)->nullable();
            $table->string('chassisid',250)->nullable();
            $table->string('sysname',500)->nullable();
            $table->string('sysdesc',250)->nullable();
            $table->string('syscapsupported',250)->nullable();
            $table->string('syscapenabled',250)->nullable();
            $table->string('lldpxmed_rem_hw',250)->nullable();
            $table->string('lldpxmed_rem_fw',250)->nullable();
            $table->string('lldpxmed_rem_sw',250)->nullable();
            $table->string('lldpxmed_rem_serial',250)->nullable();
            $table->string('lldpxmed_rem_mfgname',250)->nullable();
            $table->string('lldpxmed_rem_model',250)->nullable();
            $table->string('lldpxmed_rem_assetid',250)->nullable();
            $table->bigInteger('discovery_protocol_id')->default(1);
            $table->foreign('discovery_protocol_id')->references('id')->on('discovery_protocols');
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
        Schema::dropIfExists('snmp_host_remotes');
    }
}
