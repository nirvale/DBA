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
            //$table->integer('CVE_BASE')->references('bases')->on('id')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('cve_estatusrecovertest')->references('id')->on('estadobackups')->onDelete('restrict')->onUpdate('cascade');
            $table->json('archivos')->nullable();
            $table->text('observaciones');
            $table->integer('cve_user')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('cve_esquema')->references('id')->on('esquemas');
            $table->foreign('cve_backup')->references('id')->on('backups');
            $table->foreign('cve_user')->references('id')->on('users');
            $table->foreign('cve_estatusrecovertest')->references('id')->on('estadobackups');
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
