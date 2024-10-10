<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoordonneesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('coordonnees')->insert([
            [
                'NoCivique'=>'15700',
                'Rue'=>'Boulevard Bécancour',
                'Ville'=>'Bécancour',
                'Province'=>'Québec',
                'CodePostal'=>'G9H2M1',
                'CodeRegionAdministrative'=>'04',
                'RegionAdministrative'=>'Mauricie',
                'SiteInternet'=>'toto.com',
                'TypeTelephone'=>'Bureau',
                'Numero'=>'8192225176',
                'Poste'=>'222',
                'No_Fournisseur'=>1
            ],
            [
                'NoCivique'=>'15700',
                'Rue'=>'Boulevard Bécancour',
                'Ville'=>'Trois-Rivières',
                'Province'=>'Québec',
                'CodePostal'=>'G9H2M1',
                'CodeRegionAdministrative'=>'04',
                'RegionAdministrative'=>'Mauricie',
                'SiteInternet'=>'toto.com',
                'TypeTelephone'=>'Bureau',
                'Numero'=>'8192225176',
                'Poste'=>'111',
                'No_Fournisseur'=>2
            ],
            [
                'NoCivique'=>'15700',
                'Rue'=>'Boulevard Bécancour',
                'Ville'=>'Trois-Rivières',
                'Province'=>'Québec',
                'CodePostal'=>'G9H2M1',
                'CodeRegionAdministrative'=>'04',
                'RegionAdministrative'=>'Mauricie',
                'SiteInternet'=>'toto.com',
                'TypeTelephone'=>'Bureau',
                'Numero'=>'8192225176',
                'Poste'=>'222',
                'No_Fournisseur'=>3
            ],
            [
                'NoCivique'=>'15700',
                'Rue'=>'Boulevard Bécancour',
                'Ville'=>'Trois-Rivières',
                'Province'=>'Québec',
                'CodePostal'=>'G9H2M1',
                'CodeRegionAdministrative'=>'04',
                'RegionAdministrative'=>'Mauricie',
                'SiteInternet'=>'toto.com',
                'TypeTelephone'=>'Bureau',
                'Numero'=>'8192225176',
                'Poste'=>'222',
                'No_Fournisseur'=>4
            ],
            [
                'NoCivique'=>'15700',
                'Rue'=>'Boulevard Bécancour',
                'Ville'=>'Trois-Rivières',
                'Province'=>'Québec',
                'CodePostal'=>'G9H2M1',
                'CodeRegionAdministrative'=>'04',
                'RegionAdministrative'=>'Mauricie',
                'SiteInternet'=>'toto.com',
                'TypeTelephone'=>'Bureau',
                'Numero'=>'8192225176',
                'Poste'=>'222',
                'No_Fournisseur'=>5
            ],
         ]);
    }
}
