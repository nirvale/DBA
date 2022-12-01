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
            $table->integer('CVE_ESQUEMA');
            $table->integer('CVE_ESTADOBACKUP');
            $table->json('ARCHIVOS');
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
        Schema::dropIfExists('bdiarias');
    }
}
