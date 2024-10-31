<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->insert([
            [
                'Nature' => 'Travaux de construction',
                'Code_Categorie' => 'C01',
                'Categorie' => 'Ouvrages permanents',
                'UNSPSC' => '30220000',
                'Description' => 'Ouvrages permanents',
                'No_Fournisseur' => 1
            ],
            [
                'Nature' => 'Travaux de construction',
                'Code_Categorie' => 'C01',
                'Categorie' => 'Ouvrages commerciaux ou récréatifs',
                'UNSPSC' => '30221000',
                'Description' => 'Ouvrages commerciaux ou récréatifs/Ouvrages permanents',
                'No_Fournisseur' => 1
            ],
            [
                'Nature' => 'Travaux de licorne',
                'Code_Categorie' => 'L21',
                'Categorie' => 'Aventure magique',
                'UNSPSC' => '11111111',
                'Description' => 'Aventure vers le pays des licornes',
                'No_Fournisseur' => 1
            ],
            [
                'Nature' => 'Travaux de construction',
                'Code_Categorie' => 'C01',
                'Categorie' => 'Stationnements',
                'UNSPSC' => '30221002',
                'Description' => 'Stationnements/Ouvrages permanents',
                'No_Fournisseur' => 2
            ],
            [
                'Nature' => 'Travaux de construction',
                'Code_Categorie' => 'C01',
                'Categorie' => 'Cafétéria',
                'UNSPSC' => '30221003',
                'Description' => 'Cafétéria/Ouvrages permanents',
                'No_Fournisseur' => 3
            ],
            [
                'Nature' => 'Travaux de construction',
                'Code_Categorie' => 'C01',
                'Categorie' => 'Magasins commerciaux',
                'UNSPSC' => '30221004',
                'Description' => 'Magasins commerciaux/Ouvrages permanents',
                'No_Fournisseur' => 4
            ],
            [
                'Nature' => 'Travaux de construction',
                'Code_Categorie' => 'C01',
                'Categorie' => 'Centres commerciaux',
                'UNSPSC' => '30221005',
                'Description' => 'Centres commerciaux/Ouvrages permanents',
                'No_Fournisseur' => 5
            ],
         ]);
    }
}
