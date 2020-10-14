<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSnmpHostInterfacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snmp_host_interfaces', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('snmp_host_id');
            $table->foreign('snmp_host_id')->references('id')->on('snmp_hosts');
            $table->string('ifindex', 250)->nullable();
            $table->string('ifdescr', 250)->nullable();
            $table->string('iftype', 250)->nullable();
            $table->string('ifspeed', 250)->nullable();
            $table->string('ifphysaddress', 250)->nullable();
            $table->string('ifadminstatus', 250)->nullable();
            $table->string('ifoperstatus', 250)->nullable();
            $table->string('ifname', 250)->nullable();
            $table->string('ifalias', 250)->nullable();
            $table->string('portid', 250)->nullable();
            $table->boolean('is_trunk')->default(false);
            $table->timestamps();
            $table->unique(array('snmp_host_id', 'ifindex'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('snmp_host_interfaces');
    }
}
