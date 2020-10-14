<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuxMacsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aux_macs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('mac',6);
            $table->string('mfr', 250);
            $table->string('mfr_short', 50)->nullable();
            $table->string('logo', 250)->nullable();
            $table->timestamps();
        });
        DB::statement("SELECT setval('public.aux_macs_id_seq', 10000, true);");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aux_macs');
    }
}
