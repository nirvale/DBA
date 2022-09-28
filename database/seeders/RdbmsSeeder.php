<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rdbms;

class RdbmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rdbms = Rdbms::create(['RDBMS' => 'ORACLE']);
        $rdbms = Rdbms::create(['RDBMS' => 'MYSQL']);
        $rdbms = Rdbms::create(['RDBMS' => 'MARIADB']);
        $rdbms = Rdbms::create(['RDBMS' => 'POSTGRES']);
        $rdbms = Rdbms::create(['RDBMS' => 'SQLSERVER']);
    }
}
