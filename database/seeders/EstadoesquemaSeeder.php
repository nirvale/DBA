<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estadoesquema;

class EstadoesquemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estadoesquema = Estadoesquema::create(['ESTADOESQUEMA' => 'ACTIVO']);
        $estadoesquema = Estadoesquema::create(['ESTADOESQUEMA' => 'INACTIVO']);
        $estadoesquema = Estadoesquema::create(['ESTADOESQUEMA' => 'BORRADO']);
    }
}
