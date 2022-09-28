<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;




class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            DependenciaSeeder::class,
            ProgramaSeeder::class,
            OficinaSeeder::class,
            EstadoSeeder::class,
            AdscripcionSeeder::class,
            BackupSeeder::class,
            EstadoesquemaSeeder::class,
            TipodcSeeder::class,
            TipoSeeder::class,
            RdbmsSeeder::class,
            OsSeeder::class,
            DatacenterSeeder::class,
            BaseSeeder::class,

        ]);
    }
}
