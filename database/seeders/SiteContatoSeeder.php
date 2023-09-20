<?php

namespace Database\Seeders;

use App\Models\SiteContato;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteContatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SiteContato::factory(100)->create();
    }
}
