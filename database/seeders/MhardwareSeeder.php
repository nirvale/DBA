<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mhardware;

class MhardwareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $mhardware = Mhardware::create(['mhardware' => 'IBM']);
      $mhardware = Mhardware::create(['mhardware' => 'SUN/ORACLE']);
      $mhardware = Mhardware::create(['mhardware' => 'DELL']);
      $mhardware = Mhardware::create(['mhardware' => 'HP']);
    }
}
