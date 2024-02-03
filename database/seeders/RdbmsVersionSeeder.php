<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RdbmsVersion;

class RdbmsVersionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rdbmsversion = Rdbmsversion::create(['cve_rdbms' => '1','rdbmsversion' => '12.0.2.0.4 EE']);
        $rdbmsversion = Rdbmsversion::create(['cve_rdbms' => '1','rdbmsversion' => '18.7.0.0.0 EE']);
        $rdbmsversion = Rdbmsversion::create(['cve_rdbms' => '1','rdbmsversion' => '19.13.0.0.0 EE']);
        $rdbmsversion = Rdbmsversion::create(['cve_rdbms' => '3','rdbmsversion' => '10.6.15-MariaDB']);
        $rdbmsversion = Rdbmsversion::create(['cve_rdbms' => '4','rdbmsversion' => 'Cambiar versión postgress']);

    }
}
