<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdscripcionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adscripciones', function (Blueprint $table) {
            $table->id();
            $table->integer('cve_usuario')->index()->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->String('cve_oficina')->references('cve_oficina')->on('oficinas')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('cve_estado')->references('cve_estado')->on('estados')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
            $table->foreign('cve_usuario')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('cve_oficina')->references('cve_oficina')->on('oficinas')->onUpdate('cascade');
            $table->foreign('cve_estado')->references('cve_estado')->on('estados')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adscripciones');
    }
}
