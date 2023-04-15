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
      $estado = Estado::create (['cve_estado' => '0', 'estado'  => 'INACTIVO']);
      $estado = Estado::create (['cve_estado' => '1', 'estado'  => 'ACTIVO']);
    }
}
