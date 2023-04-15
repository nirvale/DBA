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
            $table->integer('cve_esquema')->references('esquemas')->on('id')->onDelete('restrict')->onUpdate('cascade');
            //$table->integer('CVE_BASE')->references('bases')->on('id')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('cve_estadobackup')->references('estadobackups')->on('id')->onDelete('restrict')->onUpdate('cascade');
            $table->json('archivos');
            $table->text('observaciones');
            $table->integer('cve_user')->references('users')->on('id')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('bdiarias');
    }
}
