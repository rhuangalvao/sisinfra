<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSnmpDeviceClassSysoidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snmp_device_class_sysoids', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('function_name', 250);
            $table->bigInteger('snmp_device_class_id');
            $table->foreign('snmp_device_class_id')->references('id')->on('snmp_device_classes');
            $table->bigInteger('snmp_function_id');
            $table->foreign('snmp_function_id')->references('id')->on('snmp_functions');
            $table->string('oid', 250);
            $table->string('regex', 250)->nullable();
            $table->timestamps();
        });
        DB::statement("SELECT setval('public.snmp_device_class_sysoids_id_seq', 10000, true);");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('snmp_device_class_sysoids');
    }
}
