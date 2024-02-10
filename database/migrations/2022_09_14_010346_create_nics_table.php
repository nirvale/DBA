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
        Schema::create('nics', function (Blueprint $table) {
            $table->id();
            $table->integer('cve_servidor');
            $table->string('nic');
            $table->integer('cve_tnic');
            $table->string('ip');
            $table->string('dns1');
            $table->string('dns2');
            $table->string('dns3');
            $table->string('gateway');
            $table->string('mac');
            $table->string('netmask');
            $table->text('descripcion');
            $table->timestamps();
            $table->foreign('cve_servidor')->references('id')->on('servidores')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cve_tnic')->references('id')->on('tnics')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nics');
    }
};
