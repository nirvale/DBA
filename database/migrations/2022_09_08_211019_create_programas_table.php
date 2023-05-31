<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programas', function (Blueprint $table) {
            //$table->id();
            $table->String('cve_dependencia')->references('cve_dependencia')->on('dependencias')->onDelete('restrict')->onUpdate('cascade');
            $table->String('cve_programa')->primary();
            $table->String('programa');
            $table->timestamps();
            $table->foreign('cve_dependencia')->references('cve_dependencia')->on('dependencias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programas');
    }
}
