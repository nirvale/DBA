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
        $datacenter = Datacenter::create(['DATACENTER' => 'A - SEDAGRO','CVE_TIPODC' => '1','DESC_DATACENTER' => 'CENTRO DE DATOS DE LA CGG']);
        $datacenter = Datacenter::create(['DATACENTER' => 'B - HUAWEI','CVE_TIPODC' => '2','DESC_DATACENTER' => 'TENANT EN HUAWEI CLOUD']);
    }
}
