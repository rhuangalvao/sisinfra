<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNetworkTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('network_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50);
            $table->text('descr');
            $table->timestamps();
        });
        DB::statement("SELECT setval('public.network_types_id_seq', 10000, true);");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('network_types');
    }
}
