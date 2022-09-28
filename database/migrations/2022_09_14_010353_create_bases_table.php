<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bases', function (Blueprint $table) {
            $table->id();
            $table->string('BASE');
            $table->integer('CVE_RDBMS')->references('rdbms')->on('id')->onDelete('restrict')->onUpdate('cascade');
            $table->string('VERSION');
            $table->integer('CVE_OS')->references('os')->on('id')->onDelete('restrict')->onUpdate('cascade');
            $table->string('OS_VERSION');
            $table->integer('CVE_DATACENTER')->references('datacenters')->on('id')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('CVE_TIPO')->references('tipos')->on('id')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('bases');
    }
}
