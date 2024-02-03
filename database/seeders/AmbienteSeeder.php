<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ambiente;

class AmbienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          $ambiente = Ambiente::create(['ambiente' => 'FÍSICO']);
          $ambiente = Ambiente::create(['ambiente' => 'VIRTUAL']);

    }
}
