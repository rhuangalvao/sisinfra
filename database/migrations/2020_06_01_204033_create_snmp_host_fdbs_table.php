<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSnmpHostFdbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snmp_host_fdbs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('snmp_host_id');
            $table->foreign('snmp_host_id')->references('id')->on('snmp_hosts');
            $table->string('mac_address', 250)->nullable();
            $table->string('ifindex', 250)->nullable();
            $table->string('vlan_index', 250)->nullable();
            $table->integer('count')->default(0);
            $table->bigInteger('discovery_protocol_id')->default(1);
            $table->foreign('discovery_protocol_id')->references('id')->on('discovery_protocols');
            $table->timestamps();
            $table->unique(array('snmp_host_id', 'mac_address', 'ifindex', 'vlan_index'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('snmp_host_fdbs');
    }
}
