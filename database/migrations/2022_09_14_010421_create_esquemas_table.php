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
            $table->integer('cve_usuario')->references('users')->on('id')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('cve_base')->references('bases')->on('id')->onDelete('restric')->onUpdate('cascade');
            $table->string('cve_dependencia')->references('dependencias')->on('cve_dependencia')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('cve_programa')->references('programas')->on('cve_programa')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('cve_backup')->references('backups')->on('id')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('cve_tipo')->references('tipo')->on('id')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('cve_estadoesquema')->references('estadoesquemas')->on('id')->onDelete('restrict')->onUpdate('cascade');
            $table->text('pwd');
            $table->text('observaciones');
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
