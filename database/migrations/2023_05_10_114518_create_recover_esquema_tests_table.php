<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecoverEsquemaTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recover_esquema_tests', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->integer('cve_backup')->references('id')->on('backups')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('cve_esquema')->references('id')->on('esquemas')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('cve_dbitrecord')->nullable()->references('id')->on('bdiarias')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('cve_sbitrecord')->nullable()->references('id')->on('bsemanales')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('cve_estatusrecovertest')->references('id')->on('estatus_recover_tests')->onDelete('restrict')->onUpdate('cascade');
            $table->json('archivos')->nullable();
            $table->text('observaciones');
            $table->integer('cve_user')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('cve_esquema')->references('id')->on('esquemas')->onUpdate('cascade');
            $table->foreign('cve_backup')->references('id')->on('backups')->onUpdate('cascade');
            $table->foreign('cve_dbitrecord')->references('id')->on('bdiarias')->onUpdate('cascade');
            $table->foreign('cve_sbitrecord')->references('id')->on('bsemanales')->onUpdate('cascade');
            $table->foreign('cve_user')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('cve_estatusrecovertest')->references('id')->on('estatus_recover_tests')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recover_esquema_tests');
    }
}
