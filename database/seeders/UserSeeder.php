<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = User::create([
         'name' => 'Administrador de Sistema',
         'email' => 'admindba@cggedomex.gob.mx',
         'password' => Hash::make('caperucitaputa'),
         'id' => 1
     ])->syncRoles(['God']);
    }
}
