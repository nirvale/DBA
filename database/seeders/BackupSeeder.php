<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Backup;

class BackupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $backup = Backup::create(['BACKUP' => 'AUTOMÁTICO DIARIO (L-V)','DESC_BACKUP' => 'RESPALDO AUTOMATIZADO PARA EJECUTARSE DE LUNES A VIERNES A LAS 22:00 HORAS']);
        $backup = Backup::create(['BACKUP' => 'AUTOMÁTICO SEMANAL (S)','DESC_BACKUP' => 'RESPALDO AUTOMATIZADO PARA EJECUTARSE LOS DIAS SÁBADOS A LAS 22:00 HORAS']);
        $backup = Backup::create(['BACKUP' => 'MANUAL','DESC_BACKUP' => 'RESPALDO MANUAL A PETICIÓN DEL USUARIO']);
        $backup = Backup::create(['BACKUP' => 'NINGUNO','DESC_BACKUP' => 'ESQUEMA DE PRUEBAS O DESARROLLO, SIN BACKUP']);
    }
}
