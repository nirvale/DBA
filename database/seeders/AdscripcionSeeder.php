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
        $adscripcion=Adscripcion::create(['CVE_USUARIO' => '1', 'CVE_OFICINA'  => '1','CVE_ESTADO' => '1']);
    }
}
