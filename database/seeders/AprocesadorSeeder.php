<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Aprocesador;

class AprocesadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $aprocesador = Aprocesador::create(['aprocesador' => 'X86_64']);
      $aprocesador = Aprocesador::create(['aprocesador' => 'X86_32']);
      $aprocesador = Aprocesador::create(['aprocesador' => 'PowerPC']);
      $aprocesador = Aprocesador::create(['aprocesador' => 'RISC']);
    }
}
