<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Virtualizador;

class VirtualizadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $virtualizador = Virtualizador::create(['virtualizador' => 'REDHAT KVM/RHKVM']);
      $virtualizador = Virtualizador::create(['virtualizador' => 'VMWARE']);
      $virtualizador = Virtualizador::create(['virtualizador' => 'WINDOWS HYPER-V']);
      $virtualizador = Virtualizador::create(['virtualizador' => 'XEN']);
      $virtualizador = Virtualizador::create(['virtualizador' => 'ORACLE VM/OVCA']);
    }
}
