<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuxVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aux_vendors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 250);
            $table->timestamps();
        });
        DB::statement("SELECT setval('public.aux_vendors_id_seq', 10000, true);");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aux_vendors');
    }
}
