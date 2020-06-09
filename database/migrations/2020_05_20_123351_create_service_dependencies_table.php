<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceDependenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_dependencies', function (Blueprint $table) {
            $table->id('id');
            $table->integer('service_instance_id');
            $table->integer('service_instance_id_dep');
            $table->timestamps();

//            $table->foreign('service_instance_id')->references('id')->on('service_instances');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_dependencies');
    }
}
