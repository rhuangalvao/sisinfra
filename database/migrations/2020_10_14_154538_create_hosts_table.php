<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hosts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('os_id');
            $table->foreign('os_id')->references('id')->on('operating_systems');
            $table->bigInteger('host_type_id');
            $table->foreign('host_type_id')->references('id')->on('host_types');
            $table->bigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('host_statuses');
            $table->string('tag',128)->unique();
            $table->string('hostname',128);
            $table->string('domain_suffix',128)->nullable();
            $table->boolean('monitoring')->default(true);
            $table->boolean('enabled')->default(true);
            $table->text('descr')->nullable()->comment('short description');
            $table->text('obs')->nullable()->comment('full description');
            $table->string('chassis_id',128)->nullable();
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
        Schema::dropIfExists('hosts');
    }
}
