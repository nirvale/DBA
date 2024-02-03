<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Distribucion;

class DistribucionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $distribucion = Distribucion::create(['cve_os' => '1','distribucion' => 'NO APLICA']);
      $distribucion = Distribucion::create(['cve_os' => '2','distribucion' => 'CENTOS']);
      $distribucion = Distribucion::create(['cve_os' => '2','distribucion' => 'OPENSUSE']);
      $distribucion = Distribucion::create(['cve_os' => '2','distribucion' => 'ORACLE LINUX']);
      $distribucion = Distribucion::create(['cve_os' => '2','distribucion' => 'UBUNTU SERVER']);
      $distribucion = Distribucion::create(['cve_os' => '3','distribucion' => 'SERVER']);
    }
}
