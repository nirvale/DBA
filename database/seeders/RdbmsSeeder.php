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
        $rdbms = Rdbms::create(['rdbms' => 'ORACLE']);
        $rdbms = Rdbms::create(['rdbms' => 'MYSQL']);
        $rdbms = Rdbms::create(['rdbms' => 'MARIADB']);
        $rdbms = Rdbms::create(['rdbms' => 'POSTGRES']);
        $rdbms = Rdbms::create(['rdbms' => 'SQLSERVER']);
    }
}
