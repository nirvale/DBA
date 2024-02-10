<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tecremotadisco;

class TecremotadiscoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $tecremotadisco = Tecremotadisco::create(['tecremotadisco' => 'NAS/NFS']);
      $tecremotadisco = Tecremotadisco::create(['tecremotadisco' => 'SAN']);
      $tecremotadisco = Tecremotadisco::create(['tecremotadisco' => 'CLOUD']);
    }
}
