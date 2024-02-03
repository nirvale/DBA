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
        Schema::create('distribuciones', function (Blueprint $table) {
            $table->id();
            $table->integer('cve_os');
            $table->string('distribucion')->unique();
            $table->foreign('cve_os')->references('id')->on('os')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distribucions');
    }
};
