<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estadobackup;

class EstadobackupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $eb = Estadobackup::create(['ESTADO_BACKUP' => 'DISPONIBLE']);
          $eb = Estadobackup::create(['ESTADO_BACKUP' => 'PENDIENTE']);
          $eb = Estadobackup::create(['ESTADO_BACKUP' => 'OBSOLETO']);
    }
}
