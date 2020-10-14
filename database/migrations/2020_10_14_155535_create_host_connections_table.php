<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostConnectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('host_connections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('host_interface_id_a');
            $table->foreign('host_interface_id_a')->references('id')->on('host_interfaces');
            $table->bigInteger('host_interface_id_b');
            $table->foreign('host_interface_id_b')->references('id')->on('host_interfaces');
            $table->string('connection_status', 250)->nullable();
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
        Schema::dropIfExists('host_connections');
    }
}
