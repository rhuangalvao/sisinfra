<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSnmpHostIparpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snmp_host_iparps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('snmp_host_id');
            $table->foreign('snmp_host_id')->references('id')->on('snmp_hosts');
            $table->string('ip_address', 250)->nullable();
            $table->string('mac_address', 250)->nullable();
            $table->string('vlan_index', 250)->nullable();
            $table->integer('count')->default(0);
            $table->integer('version')->default(4);
            $table->timestamps();
            $table->unique(array('snmp_host_id', 'ip_address', 'mac_address', 'vlan_index'));
        });
        DB::statement('ALTER TABLE snmp_host_iparps ADD CONSTRAINT snmp_host_iparp_check_version CHECK (version = 4 or version = 6);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('snmp_host_iparps');
    }
}
