<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostIpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('host_ips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('host_id');
            $table->foreign('host_id')->references('id')->on('hosts');
            $table->string('ip_address',39);
            $table->integer('mask');
            $table->string('gateway', 39)->nullable();
            $table->integer('version');
            $table->boolean('is_main')->default(true);
            $table->string('mac_address', 12)->nullable();
            $table->timestamps();
        });
        DB::statement('ALTER TABLE host_ips ADD CONSTRAINT host_ip_check_version CHECK (version = 4 or version = 6);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('host_ips');
    }
}
