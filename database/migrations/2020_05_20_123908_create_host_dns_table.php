<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostDnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('host_dns', function (Blueprint $table) {
            $table->id('id');
            $table->integer('host_id');
            $table->String('name');
            $table->integer('version');
            $table->boolean('is_main');
            $table->timestamps();

//            $table->foreign('host_id')->references('id')->on('hosts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('host_dns');
    }
}
