<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mprocesador;

class MprocesadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $mprocesador = Mprocesador::create(['mprocesador' => 'AMD']);
      $mprocesador = Mprocesador::create(['mprocesador' => 'INTEL']);
      $mprocesador = Mprocesador::create(['mprocesador' => 'IBM']);
      $mprocesador = Mprocesador::create(['mprocesador' => 'SUN/ORACLE']);
    }
}
