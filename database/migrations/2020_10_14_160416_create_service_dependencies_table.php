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
            $table->bigIncrements('id');

            $table->bigInteger('service_instance_id')->comment('Serviço que é o principal. Possui dependentes');
            $table->foreign('service_instance_id')->references('id')->on('service_instances');
            $table->bigInteger('service_instance_id_dep')->comment('Serviço dependente, que precisa do principal para funcionar');
            //$table->foreign('service_instance_id')->references('id')->on('service_instances');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE public.service_dependencies ADD CONSTRAINT service_dependency_service_instances_id_foreign2 FOREIGN KEY (service_instance_id_dep) REFERENCES service_instances(id);');
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
