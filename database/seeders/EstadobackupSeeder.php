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
          $eb = Estadobackup::create(['estado_backup' => 'DISPONIBLE']);
          $eb = Estadobackup::create(['estado_backup' => 'PENDIENTE']);
          $eb = Estadobackup::create(['estado_backup' => 'OBSOLETO']);
    }
}
