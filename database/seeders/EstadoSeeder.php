<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estado;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $estado = Estado::create (['CVE_ESTADO' => '0', 'ESTADO'  => 'INACTIVO']);
      $estado = Estado::create (['CVE_ESTADO' => '1', 'ESTADO'  => 'ACTIVO']);
    }
}
