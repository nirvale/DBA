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
            $table->date('FECHA');
            $table->integer('CVE_ESQUEMA')->references('esquemas')->on('id')->onDelete('restrict')->onUpdate('cascade');
            //$table->integer('CVE_BASE')->references('bases')->on('id')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('CVE_ESTADOBACKUP')->references('estadobackups')->on('id')->onDelete('restrict')->onUpdate('cascade');
            $table->json('ARCHIVOS');
            $table->text('OBSERVACIONES');
            $table->integer('CVE_USER')->references('users')->on('id')->onDelete('restrict')->onUpdate('cascade');
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
