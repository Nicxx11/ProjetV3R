<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LicencesRBQsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('licences_rbqs')->insert([
            [
                'No_Licence_RBQ' => '2156445518',
                'Statut' => 'Valide',
                'TypeLicence' => 'Entrepreneur',
                'Categorie' => 'Spécialisé',
                'Code_Sous_Categorie' => '4.2',
                'Travaux_Permis' => 'Travaux de maçonnerie non structurale marbre et céramique',
                'No_Fournisseur' => 1
            ],
            [
                'No_Licence_RBQ' => '2156445518',
                'Statut' => 'Valide',
                'TypeLicence' => 'Entrepreneur',
                'Categorie' => 'Spécialisé',
                'Code_Sous_Categorie' => '9',
                'Travaux_Permis' => 'Travaux de finition',
                'No_Fournisseur' => 1
            ],
            [
                'No_Licence_RBQ' => '5707680401',
                'Statut' => 'Valide',
                'TypeLicence' => 'Entrepreneur',
                'Categorie' => 'Spécialisé',
                'Code_Sous_Categorie' => '4.2',
                'Travaux_Permis' => 'Travaux de maçonnerie non structurale marbre et céramique',
                'No_Fournisseur' => 2
            ],
            [
                'No_Licence_RBQ' => '5707680401',
                'Statut' => 'Valide',
                'TypeLicence' => 'Entrepreneur',
                'Categorie' => 'Spécialisé',
                'Code_Sous_Categorie' => '6.2',
                'Travaux_Permis' => 'Travaux de bois et plastique',
                'No_Fournisseur' => 2
            ],
            [
                'No_Licence_RBQ' => '5707680401',
                'Statut' => 'Valide',
                'TypeLicence' => 'Entrepreneur',
                'Categorie' => 'Spécialisé',
                'Code_Sous_Categorie' => '4.2',
                'Travaux_Permis' => 'Travaux de finition',
                'No_Fournisseur' => 3
            ]
         ]);
    }
}
