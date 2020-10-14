<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('host_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50);
            $table->char('tag_prefix', 10)->nullable();
            $table->timestamps();
        });
        DB::statement("SELECT setval('public.host_types_id_seq', 10000, true);");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('host_types');
    }
}
