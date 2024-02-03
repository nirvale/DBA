<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('servidores', function (Blueprint $table) {
            $table->id();
            $table->string('hostname')->unique();
            $table->string('memoria');
            //$table->text('almacenamiento');
            $table->integer('procesadores');
            $table->integer('nucleos');
            $table->string('modelo_procesador');
            $table->string('velocidad_procesador');
            $table->integer('cve_mprocesador');
            $table->integer('cve_aprocesador');
            $table->integer('cve_os');
            $table->integer('cve_distribucion');
            $table->integer('cve_ambiente');
            $table->integer('cve_datacenter');
            $table->integer('cve_tipo');
            $table->integer('cve_virtualizador')->nullable();
            $table->integer('cve_mhardware');
            $table->integer('cve_dominio');
            // $table->text('rpwd')->nullable();
            // $table->string('u1')->nullable();
            // $table->text('u1pwd')->nullable();
            // $table->string('u2')->nullable();
            // $table->text('u2pwd')->nullable();
            // $table->string('u3')->nullable();
            // $table->text('u3pwd')->nullable();
            $table->text('descripcion');
            $table->timestamps();
            $table->foreign('cve_os')->references('id')->on('os')->onUpdate('cascade');
            $table->foreign('cve_ambiente')->references('id')->on('ambientes')->onUpdate('cascade');
            $table->foreign('cve_datacenter')->references('id')->on('datacenters')->onUpdate('cascade');
            $table->foreign('cve_tipo')->references('id')->on('tipos')->onUpdate('cascade');
            $table->foreign('cve_mprocesador')->references('id')->on('mprocesadores')->onUpdate('cascade');
            $table->foreign('cve_virtualizador')->references('id')->on('virtualizadores')->onUpdate('cascade');
            $table->foreign('cve_mhardware')->references('id')->on('mhardwares')->onUpdate('cascade');
            $table->foreign('cve_aprocesador')->references('id')->on('aprocesadores')->onUpdate('cascade');
            $table->foreign('cve_distribucion')->references('id')->on('distribuciones')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servidores');
    }
};
