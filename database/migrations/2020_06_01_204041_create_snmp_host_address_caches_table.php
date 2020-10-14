<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSnmpHostAddressCachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snmp_host_address_caches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('address', 250);
            $table->bigInteger('snmp_cmm_id');
            $table->foreign('snmp_cmm_id')->references('id')->on('snmp_cmms');
            $table->integer('status')->nullable()->comment('0=fail; 1=ok');
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
        Schema::dropIfExists('snmp_host_address_caches');
    }
}
