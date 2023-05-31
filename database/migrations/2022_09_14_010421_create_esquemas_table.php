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
            $table->string('esquema');
            $table->integer('cve_usuario')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('cve_base')->references('id')->on('bases')->onDelete('restric')->onUpdate('cascade');
            $table->string('cve_dependencia')->references('cve_dependencia')->on('dependencias')->onDelete('restrict')->onUpdate('cascade');
            $table->string('cve_programa')->references('cve_programa')->on('programas')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('cve_backup')->references('id')->on('backups')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('cve_tipo')->references('id')->on('tipos')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('cve_estadoesquema')->references('id')->on('estadoesquemas')->onDelete('restrict')->onUpdate('cascade');
            $table->text('pwd');
            $table->text('observaciones');
            $table->timestamps();
            $table->foreign('cve_usuario')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('cve_base')->references('id')->on('bases')->onUpdate('cascade');
            $table->foreign('cve_dependencia')->references('cve_dependencia')->on('dependencias')->onUpdate('cascade');
            $table->foreign('cve_programa')->references('cve_programa')->on('programas')->onUpdate('cascade');
            $table->foreign('cve_backup')->references('id')->on('backups')->onUpdate('cascade');
            $table->foreign('cve_tipo')->references('id')->on('tipos')->onUpdate('cascade');
            $table->foreign('cve_estadoesquema')->references('id')->on('estadoesquemas')->onUpdate('cascade');
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
