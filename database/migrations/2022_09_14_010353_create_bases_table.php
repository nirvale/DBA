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
            $table->string('base');
            $table->integer('cve_rdbms')->references('id')->on('rdbms')->onDelete('restrict')->onUpdate('cascade');
            $table->string('version');
            $table->integer('cve_os')->references('id')->on('os')->onDelete('restrict')->onUpdate('cascade');
            $table->string('os_version');
            $table->integer('cve_datacenter')->references('id')->on('datacenters')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('cve_tipo')->references('id')->on('tipos')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
            $table->foreign('cve_rdbms')->references('id')->on('rdbms');
            $table->foreign('cve_os')->references('id')->on('os');
            $table->foreign('cve_tipo')->references('id')->on('tipos');
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
