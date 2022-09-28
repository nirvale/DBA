<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEsquemasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('esquemas', function (Blueprint $table) {
            $table->id();
            $table->string('ESQUEMA');
            $table->integer('CVE_USUARIO')->references('users')->on('id')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('CVE_BASE')->references('bases')->on('id')->onDelete('restric')->onUpdate('cascade');
            $table->integer('CVE_DEPENDENCIA')->references('dependencias')->on('CVE_DEPENDENCIA')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('CVE_PROGRAMA')->references('programas')->on('CVE_PROGRAMA')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('CVE_BACKUP')->references('backups')->on('id')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('CVE_TIPO')->references('tipo')->on('id')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('CVE_ESTADOESQUEMA')->references('estadoesquemas')->on('id')->onDelete('restrict')->onUpdate('cascade');
            $table->text('PWD');
            $table->text('OBSERVACIONES');
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
        Schema::dropIfExists('esquemas');
    }
}
