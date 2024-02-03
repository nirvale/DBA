<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tdisco;

class TdiscoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $tdisco = Tdisco::create(['tdisco' => 'LOCAL']);
      $tdisco = Tdisco::create(['tdisco' => 'REMOTO']);
    }
}
