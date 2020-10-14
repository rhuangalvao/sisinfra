<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSnmpFunctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snmp_functions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('function_name', 250)->nullable();
            $table->string('oid_name', 250)->nullable();
            $table->string('oid', 250)->nullable();
            $table->string('descr', 250)->nullable();
            $table->integer('p1')->nullable();
            $table->integer('p2')->nullable();
            $table->integer('p3')->nullable();
            $table->string('regex', 250)->nullable();
            $table->timestamps();
            $table->unique(array('function_name', 'oid_name', 'oid'));
        });
        DB::statement("SELECT setval('public.snmp_functions_id_seq', 10000, true);");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('snmp_functions');
    }
}
