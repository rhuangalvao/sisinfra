<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSnmpDeviceClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snmp_device_classes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('aux_vendor_id');
            $table->foreign('aux_vendor_id')->references('id')->on('aux_vendors');
            $table->bigInteger('operating_system_id');
            $table->foreign('operating_system_id')->references('id')->on('operating_systems');
            $table->bigInteger('host_type_id');
            $table->foreign('host_type_id')->references('id')->on('host_types');
            $table->string('name', 250);
            $table->string('partnumber', 250)->nullable();
            $table->timestamps();
        });
        DB::statement("SELECT setval('public.snmp_device_classes_id_seq', 10000, true);");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('snmp_device_classes');
    }
}
