<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactsFournisseursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contacts_fournisseurs')->insert([
            [
                'Prenom' => 'Samuel',
                'Nom' => 'Wankowski',
                'Fonction' => 'Directeur de machandising',
                'Courriel' => 'administration@walmart.ca',
                'TypeTelephone' => 'Bureau',
                'Numero' => '8192224560',
                'Poste' => '',
                'No_Fournisseur' => 1
            ],
            [
                'Prenom' => 'Bob',
                'Nom' => 'Graton',
                'Fonction' => 'Directeur de machandising',
                'Courriel' => 'administration@walmart.ca',
                'TypeTelephone' => 'Bureau',
                'Numero' => '8192224560',
                'Poste' => '',
                'No_Fournisseur' => 1
            ],
            [
                'Prenom' => 'Lawrence',
                'Nom' => 'Rossy',
                'Fonction' => 'Président',
                'Courriel' => 'administration@dollarama.ca',
                'TypeTelephone' => 'Cellulaire',
                'Numero' => '8192693155',
                'Poste' => '',
                'No_Fournisseur' => 2
            ],
            [
                'Prenom' => 'Bernard',
                'Nom' => 'Stern',
                'Fonction' => 'Président',
                'Courriel' => 'administration@pizzahut.ca',
                'TypeTelephone' => 'Bureau',
                'Numero' => '8192227756',
                'Poste' => '22',
                'No_Fournisseur' => 3
            ],
            [
                'Prenom' => 'Layden',
                'Nom' => 'Kevin',
                'Fonction' => 'Président',
                'Courriel' => 'administration@bestbuy.ca',
                'TypeTelephone' => 'Bureau',
                'Numero' => '8192692445',
                'Poste' => '111',
                'No_Fournisseur' => 4
            ],
            [
                'Prenom' => 'Yvan',
                'Nom' => 'Caron',
                'Fonction' => 'Président',
                'Courriel' => 'administration@edward-ia.ca',
                'TypeTelephone' => 'Bureau',
                'Numero' => '8192222020',
                'Poste' => '20',
                'No_Fournisseur' => 5
            ]
         ]);
    }
}
