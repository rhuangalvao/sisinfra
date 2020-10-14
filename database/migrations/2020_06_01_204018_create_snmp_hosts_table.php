<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSnmpHostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snmp_hosts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sysdescr', 250)->nullable();
            $table->string('sysobjectid', 250)->nullable();
            $table->string('sysuptime', 250)->nullable();
            $table->string('syscontact', 250)->nullable();
            $table->string('sysname', 250)->nullable();
            $table->string('syslocation', 250)->nullable();
            $table->string('sysservices', 250)->nullable();
            $table->string('hostname', 250)->nullable();
            $table->string('serialnumber', 250)->nullable();
            $table->string('model', 250)->nullable();
            $table->string('softwareversion', 250)->nullable();
            $table->string('chassisid', 250)->nullable();
            $table->string('chassisidsubtype', 250)->nullable();
            $table->bigInteger('snmp_device_class_id')->nullable();
            $table->foreign('snmp_device_class_id')->references('id')->on('snmp_device_classes');
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
        Schema::dropIfExists('snmp_hosts');
    }
}
