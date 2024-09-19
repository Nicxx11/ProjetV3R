<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModificationsFournisseursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('modifications_fournisseurs')->insert([
            [
                'Date_Modification' => '2024-04-30 15:29:00',
                'Modification' => 'MotDePasse',
                'No_Fournisseur' => 1
            ],
            [
                'Date_Modification' => '2023-11-18 15:20:00',
                'Modification' => 'MotDePasse',
                'No_Fournisseur' => 2
            ],
            [
                'Date_Modification' => '2022-02-28 14:19:00',
                'Modification' => 'MotDePasse',
                'No_Fournisseur' => 3
            ],
            [
                'Date_Modification' => '2024-04-30 15:29:00',
                'Modification' => 'MotDePasse',
                'No_Fournisseur' => 4
            ],
            [
                'Date_Modification' => '2024-04-30 07:29:00',
                'Modification' => 'MotDePasse',
                'No_Fournisseur' => 5
            ],
            [
                'Date_Modification' => '2024-05-01 09:29:00',
                'Modification' => 'MotDePasse',
                'No_Fournisseur' => 1
            ],
            [
                'Date_Modification' => '2024-05-04 11:59:00',
                'Modification' => 'MotDePasse',
                'No_Fournisseur' => 1
            ],
         ]);
    }
}
