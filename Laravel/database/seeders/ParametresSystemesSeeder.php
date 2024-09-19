<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParametresSystemesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('parametres_systemes')->insert([
            [
                'Approvisionnement' => 'approvisionnement@v3r.net',
                'DelaiRevision' => '24',
                'TailleMaxBrochures' => '75',
                'Finances' => 'finances@v3r.net'
            ]
         ]);
    }
}
