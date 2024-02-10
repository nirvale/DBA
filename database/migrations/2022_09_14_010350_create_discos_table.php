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
        Schema::create('discos', function (Blueprint $table) {
            $table->id();
            $table->integer('cve_servidor');
            $table->string('disco');
            $table->integer('cve_tdisco');
            $table->integer('cve_tecremotadisco')->nullable();
            $table->string('pmontaje');
            $table->string('formato');
            $table->string('capacidad');
            $table->string('usado');
            $table->string('disponible');
            $table->text('descripcion');
            $table->timestamps();
            $table->foreign('cve_servidor')->references('id')->on('servidores')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cve_tdisco')->references('id')->on('tdiscos')->onUpdate('cascade');
            $table->foreign('cve_tecremotadisco')->references('id')->on('tecremotadiscos')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discos');
    }
};
