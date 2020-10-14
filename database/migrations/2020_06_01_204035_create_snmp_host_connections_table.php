<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSnmpHostConnectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snmp_host_connections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('snmp_host_id');
            $table->foreign('snmp_host_id')->references('id')->on('snmp_hosts');
            $table->string('remote_chassisid', 250)->nullable();
            $table->string('remote_portid', 250)->nullable();
            $table->string('remote_portidsubtype', 250)->nullable();
            $table->string('remote_portdescr', 250)->nullable();
            $table->string('local_portid', 250)->nullable();
            $table->integer('count')->default(0);
            $table->bigInteger('discovery_protocol_id')->default(1);
            $table->foreign('discovery_protocol_id')->references('id')->on('discovery_protocols');
            $table->timestamps();
            $table->unique(array('snmp_host_id', 'remote_chassisid', 'remote_portid', 'remote_portidsubtype', 'local_portid'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('snmp_host_connections');
    }
}
