<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostInterfacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('host_interfaces', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('host_id')->nullable()->unique();
            $table->foreign('host_id')->references('id')->on('hosts');
            $table->string('ifname', 250)->nullable();
            $table->string('iftype', 250)->nullable();
            $table->string('ifspeed', 250)->nullable();
            $table->string('ifphysaddress', 250)->nullable();
            $table->string('ifoperstatus', 250)->nullable();
            $table->string('ifalias', 250)->nullable();
            $table->boolean('is_mgmt')->default(false);
            $table->bigInteger('discovery_protocol_id')->default(1);
            $table->foreign('discovery_protocol_id')->references('id')->on('discovery_protocols');

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
        Schema::dropIfExists('host_interfaces');
    }
}
