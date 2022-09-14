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
            $table->String('CVE_USUARIO')->index()->references('users')->on('id')->onDelete('cascade')->onUpdate('cascade');
            $table->String('CVE_OFICINA')->references('oficinas')->on('CVE_OFICINA')->onDelete('cascade')->onUpdate('cascade');
            $table->String('CVE_ESTADO')->references('estados')->on('CVE_ESTADO')->onDelete('cascade')->onUpdate('cascade');
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
