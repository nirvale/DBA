<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Adscripcion;

class AdscripcionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adscripcion=Adscripcion::create(['cve_usuario' => '1', 'cve_oficina'  => '1','cve_estado' => '1']);
    }
}
