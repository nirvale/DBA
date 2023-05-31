<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateBdiariariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bdiarias', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->integer('cve_esquema')->references('id')->on('esquemas')->onDelete('restrict')->onUpdate('cascade');
            //$table->integer('CVE_BASE')->references('bases')->on('id')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('cve_estadobackup')->references('id')->on('estadobackups')->onDelete('restrict')->onUpdate('cascade');
            $table->json('archivos');
            $table->text('observaciones');
            $table->integer('cve_user')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
            $table->foreign('cve_esquema')->references('id')->on('esquemas')->onUpdate('cascade');
            $table->foreign('cve_estadobackup')->references('id')->on('estadobackups')->onUpdate('cascade');
            $table->foreign('cve_user')->references('id')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bdiarias');
    }
}
