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
      $base = Base::create(['base' => 'DBGRID','cve_rdbms' => '1','version' => '18C 18.0.0.0.0','CVE_OS' => '2','os_version' => 'ORACLE LINUX 7','cve_datacenter' => '1','cve_tipo' => '3']);
      $base = Base::create(['base' => 'DESARROLLO','cve_rdbms' => '1','version' => '19C 18.0.0.0.0','CVE_OS' => '2','os_version' => 'ORACLE LINUX 7','cve_datacenter' => '1','cve_tipo' => '1']);
      $base = Base::create(['base' => 'HERMES SEDAGRO','cve_rdbms' => '1','version' => '18C 18.0.0.0.0','CVE_OS' => '2','os_version' => 'ORACLE LINUX 7','cve_datacenter' => '1','cve_tipo' => '2']);
      $base = Base::create(['base' => 'VALHALLA SEDAGRO','cve_rdbms' => '1','version' => '18C 18.0.0.0.0','CVE_OS' => '2','os_version' => 'ORACLE LINUX 7','cve_datacenter' => '1','cve_tipo' => '2']);
      $base = Base::create(['base' => 'HERMES HW-CLOUD','cve_rdbms' => '1','version' => '19C 18.0.0.0.0','CVE_OS' => '2','os_version' => 'ORACLE LINUX 7','cve_datacenter' => '2','cve_tipo' => '3']);
      $base = Base::create(['base' => 'VALHALLA HW-CLOUD','cve_rdbms' => '1','version' => '19C 18.0.0.0.0','CVE_OS' => '2','os_version' => 'ORACLE LINUX 7','cve_datacenter' => '2','cve_tipo' => '3']);

    }
}
