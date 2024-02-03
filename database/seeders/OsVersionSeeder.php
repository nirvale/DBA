<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OsVersion;

class OsVersionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $osversion = OsVersion::create(['cve_distribucion' => '1','osversion'=> '7.2']);
        $osversion = OsVersion::create(['cve_distribucion' => '2','osversion'=> '6']);
        $osversion = OsVersion::create(['cve_distribucion' => '2','osversion'=> '7']);
        $osversion = OsVersion::create(['cve_distribucion' => '2','osversion'=> '8']);
        $osversion = OsVersion::create(['cve_distribucion' => '3','osversion'=> '15.5']);
        $osversion = OsVersion::create(['cve_distribucion' => '4','osversion'=> '6']);
        $osversion = OsVersion::create(['cve_distribucion' => '4','osversion'=> '7']);
        $osversion = OsVersion::create(['cve_distribucion' => '4','osversion'=> '8']);
        $osversion = OsVersion::create(['cve_distribucion' => '5','osversion'=> '22.04 KARMIC KOALA']);
        $osversion = OsVersion::create(['cve_distribucion' => '6','osversion'=> '2012 R12']);
        $osversion = OsVersion::create(['cve_distribucion' => '6','osversion'=> '2012 R12']);
        $osversion = OsVersion::create(['cve_distribucion' => '6','osversion'=> '2016']);
        $osversion = OsVersion::create(['cve_distribucion' => '6','osversion'=> '2019']);
        $osversion = OsVersion::create(['cve_distribucion' => '6','osversion'=> '2022']);

    }
}
