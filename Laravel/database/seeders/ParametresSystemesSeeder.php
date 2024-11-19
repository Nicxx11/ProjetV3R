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
                'Approvisionnement' => 'projetv3r2024@gmail.com',
                'DelaiRevision' => '24',
                'TailleMaxBrochures' => '75',
                'Finances' => 'projetv3r2024@gmail.com'
            ]
         ]);
    }
}
