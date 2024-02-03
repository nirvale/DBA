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
        Schema::create('os_versions', function (Blueprint $table) {
            $table->id();
            $table->integer('cve_distribucion');
            $table->string('osversion');
            $table->timestamps();
            $table->foreign('cve_distribucion')->references('id')->on('distribuciones')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('os_versions');
    }
};
