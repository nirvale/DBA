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
            $table->String('cve_usuario')->index()->references('users')->on('id')->onDelete('cascade')->onUpdate('cascade');
            $table->String('cve_oficina')->references('oficinas')->on('cve_oficina')->onDelete('cascade')->onUpdate('cascade');
            $table->String('cve_estado')->references('estados')->on('cve_estado')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('adscripciones');
    }
}
