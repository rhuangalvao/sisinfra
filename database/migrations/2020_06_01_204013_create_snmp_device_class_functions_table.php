<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSnmpDeviceClassFunctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snmp_device_class_functions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('snmp_device_class_id');
            $table->foreign('snmp_device_class_id')->references('id')->on('snmp_device_classes');
            $table->bigInteger('snmp_function_id');
            $table->foreign('snmp_function_id')->references('id')->on('snmp_functions');
            $table->string('function_name', 250);
            $table->unique(array('snmp_device_class_id', 'function_name'));
            $table->timestamps();
        });
        DB::statement("SELECT setval('public.snmp_device_class_functions_id_seq', 10000, true);");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('snmp_device_class_functions');
    }
}
