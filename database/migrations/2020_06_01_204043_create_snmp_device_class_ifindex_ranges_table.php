<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSnmpDeviceClassIfindexRangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snmp_device_class_ifindex_ranges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('snmp_device_class_id');
            $table->foreign('snmp_device_class_id')->references('id')->on('snmp_device_classes');
            $table->string('regex');
            $table->integer('iftype');
            $table->string('regex_portid');
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
        Schema::dropIfExists('snmp_device_class_ifindex_ranges');
    }
}
