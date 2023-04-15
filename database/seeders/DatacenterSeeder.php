<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Datacenter;

class DatacenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datacenter = Datacenter::create(['datacenter' => 'A - SEDAGRO','cve_tipodc' => '1','desc_datacenter' => 'CENTRO DE DATOS DE LA CGG']);
        $datacenter = Datacenter::create(['datacenter' => 'B - HUAWEI','cve_tipodc' => '2','desc_datacenter' => 'TENANT EN HUAWEI CLOUD']);
    }
}
