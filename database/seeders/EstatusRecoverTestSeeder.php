<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EstatusRecoverTest;


class EstatusRecoverTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

          $estatusrecovert = EstatusRecoverTest::create(['id' => '1','estatusrecovert' => 'CORRECTA']);
          $estatusrecovert = EstatusRecoverTest::create(['id' => '2','estatusrecovert' => 'FALLÓ']);
          $estatusrecovert = EstatusRecoverTest::create(['id' => '2','estatusrecovert' => 'EN PROCESO']);

    }
}
