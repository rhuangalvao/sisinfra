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
            $table->bigIncrements('id');
            $table->bigInteger('host_id');
            $table->foreign('host_id')->references('id')->on('hosts');
            $table->bigInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services');
            $table->bigInteger('host_ip_id')->nullable();
            $table->foreign('host_ip_id')->references('id')->on('host_ips');
            $table->bigInteger('host_dns_id')->nullable();
            $table->foreign('host_dns_id')->references('id')->on('host_dns');
            $table->boolean('monitoring')->default(true);
            $table->text('descr')->nullable();
            $table->bigInteger('password_id');
            $table->foreign('password_id')->references('id')->on('passwords');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE service_instances ADD CONSTRAINT service_instance_ip_or_dns CHECK (((host_ip_id IS NULL) OR (host_dns_id IS NULL)) AND ((host_ip_id IS NOT NULL) OR (host_dns_id IS NOT NULL)));');
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
