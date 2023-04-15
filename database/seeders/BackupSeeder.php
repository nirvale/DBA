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
        $backup = Backup::create(['backup' => 'AUTOMÁTICO DIARIO (L-V)','desc_backup' => 'RESPALDO AUTOMATIZADO PARA EJECUTARSE DE LUNES A VIERNES A LAS 22:00 HORAS']);
        $backup = Backup::create(['backup' => 'AUTOMÁTICO SEMANAL (S)','desc_backup' => 'RESPALDO AUTOMATIZADO PARA EJECUTARSE LOS DIAS SÁBADOS A LAS 22:00 HORAS']);
        $backup = Backup::create(['backup' => 'MANUAL','desc_backup' => 'RESPALDO MANUAL A PETICIÓN DEL USUARIO']);
        $backup = Backup::create(['backup' => 'NINGUNO','desc_backup' => 'ESQUEMA DE PRUEBAS O DESARROLLO, SIN BACKUP']);
    }
}
