<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Os;

class OsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $os = Os::create(['OS' => 'AIX']);
        $os = Os::create(['OS' => 'LINUX']);
        $os = Os::create(['OS' => 'WINDOWS']);
    }
}
