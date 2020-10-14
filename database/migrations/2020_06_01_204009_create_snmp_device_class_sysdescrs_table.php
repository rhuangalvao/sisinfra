<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSnmpDeviceClassSysdescrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snmp_device_class_sysdescrs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('snmp_device_class_id');
            $table->foreign('snmp_device_class_id')->references('id')->on('snmp_device_classes');
            $table->string('regex');
            $table->integer('order');
            $table->boolean('enabled')->default(true);
            $table->timestamps();
        });
        DB::statement("SELECT setval('public.snmp_device_class_sysdescrs_id_seq', 10000, true);");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('snmp_device_class_sysdescrs');
    }
}
