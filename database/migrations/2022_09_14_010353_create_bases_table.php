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
            $table->integer('cve_rdbms')->references('rdbms')->on('id')->onDelete('restrict')->onUpdate('cascade');
            $table->string('version');
            $table->integer('cve_os')->references('os')->on('id')->onDelete('restrict')->onUpdate('cascade');
            $table->string('os_version');
            $table->integer('cve_datacenter')->references('datacenters')->on('id')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('cve_tipo')->references('tipos')->on('id')->onDelete('restrict')->onUpdate('cascade');
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
