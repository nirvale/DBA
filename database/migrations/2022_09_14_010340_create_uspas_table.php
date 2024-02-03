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
        Schema::create('uspas', function (Blueprint $table) {
            $table->id();
            $table->integer('cve_usp');
            $table->integer('cve_user');
            $table->timestamps();
            $table->foreign('cve_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cve_usp')->references('id')->on('usps')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uspas');
    }
};
