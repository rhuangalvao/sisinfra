<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSnmpCmmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snmp_cmms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('version', 5);
            $table->integer('port')->default(161);
            $table->integer('timeout')->default(1000)->comment('timeout in milliseconds');
            $table->string('community_name', 250)->nullable();
            $table->bigInteger('password_id')->nullable();
            $table->foreign('password_id')->references('id')->on('passwords');
            $table->string('auth_protocol', 250)->nullable();
            $table->string('privacy_pass', 250)->nullable();
            $table->string('privacy_proto', 250)->nullable();
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
        Schema::dropIfExists('snmp_cmms');
    }
}
