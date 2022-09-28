<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Base;

class BaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $base = Base::create(['BASE' => 'DBGRID','CVE_RDBMS' => '1','VERSION' => '18C 18.0.0.0.0','CVE_OS' => '2','OS_VERSION' => 'ORACLE LINUX 7','CVE_DATACENTER' => '1','CVE_TIPO' => '3']);
      $base = Base::create(['BASE' => 'DESARROLLO','CVE_RDBMS' => '1','VERSION' => '19C 18.0.0.0.0','CVE_OS' => '2','OS_VERSION' => 'ORACLE LINUX 7','CVE_DATACENTER' => '1','CVE_TIPO' => '1']);
      $base = Base::create(['BASE' => 'HERMES SEDAGRO','CVE_RDBMS' => '1','VERSION' => '18C 18.0.0.0.0','CVE_OS' => '2','OS_VERSION' => 'ORACLE LINUX 7','CVE_DATACENTER' => '1','CVE_TIPO' => '2']);
      $base = Base::create(['BASE' => 'VALHALLA SEDAGRO','CVE_RDBMS' => '1','VERSION' => '18C 18.0.0.0.0','CVE_OS' => '2','OS_VERSION' => 'ORACLE LINUX 7','CVE_DATACENTER' => '1','CVE_TIPO' => '2']);
      $base = Base::create(['BASE' => 'HERMES HW-CLOUD','CVE_RDBMS' => '1','VERSION' => '19C 18.0.0.0.0','CVE_OS' => '2','OS_VERSION' => 'ORACLE LINUX 7','CVE_DATACENTER' => '2','CVE_TIPO' => '3']);
      $base = Base::create(['BASE' => 'VALHALLA HW-CLOUD','CVE_RDBMS' => '1','VERSION' => '19C 18.0.0.0.0','CVE_OS' => '2','OS_VERSION' => 'ORACLE LINUX 7','CVE_DATACENTER' => '2','CVE_TIPO' => '3']);

    }
}
