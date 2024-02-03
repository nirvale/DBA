<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatacentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datacenters', function (Blueprint $table) {
            $table->id();
            $table->string('datacenter');
            $table->integer('cve_tipodc')->references('id')->on('tipodcs')->onDelete('restrict')->onUpdate('cascade');
            $table->text('desc_datacenter')->nullable();
            $table->timestamps();
            $table->foreign('cve_tipodc')->references('id')->on('tipodcs')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datacenters');
    }
}
