<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceInstancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_instances', function (Blueprint $table) {
            $table->id('id');
            $table->integer('host_id');
            $table->integer('service_id');
            $table->integer('host_ip_id');
            $table->integer('host_dns_id');
            $table->String('descr');
            $table->integer('password_id');
            $table->timestamps();

//            $table->foreign('host_id')->references('id')->on('hosts');
//            $table->foreign('service_id')->references('id')->on('services');
//            $table->foreign('host_ip_id')->references('id')->on('host_ips');
//            $table->foreign('password_id')->references('id')->on('passwords');
//            $table->foreign('host_dns_id')->references('id')->on('host_dns');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_instances');
    }
}
