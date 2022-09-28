<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tipo;

class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipo = Tipo::create(['TIPO' => 'DESARROLLO']);
        $tipo = Tipo::create(['TIPO' => 'PRUEBAS']);
        $tipo = Tipo::create(['TIPO' => 'PRODUCCIÓN']);
    }
}
