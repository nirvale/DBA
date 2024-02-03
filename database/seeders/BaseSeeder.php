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
      // $base = Base::create(['base' => 'DBGRID','cve_rdbms' => '1','version' => '18C 18.0.0.0.0','CVE_OS' => '2','os_version' => 'ORACLE LINUX 7','cve_datacenter' => '1','cve_tipo' => '3']);
      // $base = Base::create(['base' => 'DESARROLLO','cve_rdbms' => '1','version' => '19C 18.0.0.0.0','CVE_OS' => '2','os_version' => 'ORACLE LINUX 7','cve_datacenter' => '1','cve_tipo' => '1']);
      // $base = Base::create(['base' => 'HERMES SEDAGRO','cve_rdbms' => '1','version' => '18C 18.0.0.0.0','CVE_OS' => '2','os_version' => 'ORACLE LINUX 7','cve_datacenter' => '1','cve_tipo' => '2']);
      // $base = Base::create(['base' => 'VALHALLA SEDAGRO','cve_rdbms' => '1','version' => '18C 18.0.0.0.0','CVE_OS' => '2','os_version' => 'ORACLE LINUX 7','cve_datacenter' => '1','cve_tipo' => '2']);
      // $base = Base::create(['base' => 'HERMES HW-CLOUD','cve_rdbms' => '1','version' => '19C 18.0.0.0.0','CVE_OS' => '2','os_version' => 'ORACLE LINUX 7','cve_datacenter' => '2','cve_tipo' => '3']);
      // $base = Base::create(['base' => 'VALHALLA HW-CLOUD','cve_rdbms' => '1','version' => '19C 18.0.0.0.0','CVE_OS' => '2','os_version' => 'ORACLE LINUX 7','cve_datacenter' => '2','cve_tipo' => '3']);
        $base = Base::create(['id' => '1','base' => 'DBGRID GEM0 PRO','cve_rdbms' => '1','version' => '18C 18.0.0.0.0','CVE_OS' => '2','os_version' => 'ORACLE LINUX 7','cve_datacenter' => '1','cve_tipo' => '3']);
        $base = Base::create(['id' => '3','base' => 'HERMES GEM0 PRO X4','cve_rdbms' => '1','version' => '18C 18.0.0.0.0','CVE_OS' => '2','os_version' => 'ORACLE LINUX 7','cve_datacenter' => '1','cve_tipo' => '3']);
        $base = Base::create(['id' => '4','base' => 'VLHLLA GEM0 PRO X4','cve_rdbms' => '1','version' => '18C 18.0.0.0.0','CVE_OS' => '2','os_version' => 'ORACLE LINUX 7','cve_datacenter' => '1','cve_tipo' => '3']);
        $base = Base::create(['id' => '5','base' => 'HERMES GEM0 PRO X5','cve_rdbms' => '1','version' => '19C 19.0.0.0.0','CVE_OS' => '2','os_version' => 'ORACLE LINUX 7','cve_datacenter' => '1','cve_tipo' => '3']);
        $base = Base::create(['id' => '6','base' => 'VLHLLA GEM0 PRO X5','cve_rdbms' => '1','version' => '19C 19.0.0.0.0','CVE_OS' => '2','os_version' => 'ORACLE LINUX 7','cve_datacenter' => '1','cve_tipo' => '3']);
        $base = Base::create(['id' => '10','base' => 'ARES00 GEM0 DEV','cve_rdbms' => '1','version' => '19C 19.0.0.0.0','CVE_OS' => '2','os_version' => 'ORACLE LINUX 7','cve_datacenter' => '1','cve_tipo' => '1']);
        $base = Base::create(['id' => '11','base' => 'SMSARA HWC0 DEV','cve_rdbms' => '1','version' => '19C 19.0.0.0.0','CVE_OS' => '2','os_version' => 'ORACLE LINUX 7','cve_datacenter' => '2','cve_tipo' => '1']);
        $base = Base::create(['id' => '12','base' => 'ALGE90 GEM0 PRO','cve_rdbms' => '3','version' => '10.6.15','CVE_OS' => '2','os_version' => 'OPENSUSE LEAP 15.5','cve_datacenter' => '1','cve_tipo' => '3']);
        $base = Base::create(['id' => '13','base' => 'ANDROM GEM0 PRO','cve_rdbms' => '4','version' => '13.11-1','CVE_OS' => '2','os_version' => 'CENTOS 9','cve_datacenter' => '1','cve_tipo' => '3']);


    }
}
