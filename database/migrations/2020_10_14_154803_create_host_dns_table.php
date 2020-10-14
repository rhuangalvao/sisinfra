<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostDnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('host_dns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('host_id');
            $table->foreign('host_id')->references('id')->on('hosts');
            $table->string('name', 250)->unique();
            $table->boolean('is_main')->default(true);
            $table->integer('version');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE host_dns ADD CONSTRAINT host_dns_check_version CHECK (version = 4 or version = 6);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('host_dns');
    }
}
