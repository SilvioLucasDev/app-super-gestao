<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usuario = new User();
        $usuario->name = 'Silvio Lucas';
        $usuario->email = 'silviolucas_santos@hotmail.com';
        $usuario->password = '1234';
        $usuario->save();
    }
}
