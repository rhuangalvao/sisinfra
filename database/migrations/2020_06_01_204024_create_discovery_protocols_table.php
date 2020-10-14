<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscoveryProtocolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discovery_protocols', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('order')->nullable();
            $table->timestamps();
        });
        DB::statement("SELECT setval('public.discovery_protocols_id_seq', 10000, true);");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discovery_protocols');
    }
}
