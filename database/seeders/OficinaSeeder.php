<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Oficina;
class OficinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $oficina = Oficina::create (['CVE_OFICINA' => '1', 'OFICINA'  => 'COORDINACIÓN DE GESTIÓN GUBERNAMENTAL']);
        $oficina = Oficina::create (['CVE_OFICINA' => '2', 'OFICINA'  => 'DIRECCIÓN GENERAL DE TECNOLOGÍAS PARA LA GESTIÓN']);
        $oficina = Oficina::create (['CVE_OFICINA' => '3', 'OFICINA'  => 'INFRAESTRUCTURA TECNOLÓGICA']);
        $oficina = Oficina::create (['CVE_OFICINA' => '4', 'OFICINA'  => 'ADMINISTRACIÓN DE PROYECTOS']);
        $oficina = Oficina::create (['CVE_OFICINA' => '5', 'OFICINA'  => 'PROYECTOS ESTRATÉGICOS']);
        $oficina = Oficina::create (['CVE_OFICINA' => '6', 'OFICINA'  => 'PROYECTOS ESPECIALES']);
        $oficina = Oficina::create (['CVE_OFICINA' => '7', 'OFICINA'  => 'ARQUITECTURA TECNOLÓGICA DE PROGRAMAS']);
    }
}
