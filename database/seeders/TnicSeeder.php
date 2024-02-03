<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tnic;

class TnicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tnic = Tnic::create(['tnic' => 'FÍSICA']);
        $tnic = Tnic::create(['tnic' => 'VIRTUAL']);
    }
}
