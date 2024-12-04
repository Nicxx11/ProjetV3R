<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FournisseursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('fournisseurs')->insert([
            [
                'NEQ' => null,
                'Courriel' => 'administration@walmart.ca',
                'Entreprise' => 'Walmart',
                'MotDePasse' => hash('sha1', 'MotDePasse1$'),
                'Details' => 'Exploitation d\'un grand magasin de vente au détail',
                'No_TPS' => null,
                'No_TVQ' => null,
                'Conditions_paiement' => null,
                'Devise' => null,
                'Mode_Communication' => null,
                'Etat_Demande' => 'Refusée',
                'Date_Changement_Etat' => '2024-04-25 10:37:00',
                'Date_Creation' => '2024-04-21 11:14:00',
                'Date_Derniere_Modification' => '2024-04-30 15:29:00'
            ],
            [
                'NEQ' => '1142121434',
                'Courriel' => 'administration@dollarama.ca',
                'Entreprise' => '9199-3899 QUÉBEC INC.',
                'MotDePasse' => hash('sha1', 'MotDePasse1$'),
                'Details' => 'Grands magasins',
                'No_TPS' => null,
                'No_TVQ' => null,
                'Conditions_paiement' => null,
                'Devise' => null,
                'Mode_Communication' => null,
                'Etat_Demande' => 'En attente',
                'Date_Changement_Etat' => '2023-09-25 10:01:00',
                'Date_Creation' => '2023-08-04 11:10:00',
                'Date_Derniere_Modification' => '2023-11-18 15:20:00'
            ],
            [
                'NEQ' => '1180063977',
                'Courriel' => 'administration@pizzahut.com',
                'Entreprise' => '9522-1883 Québec inc.',
                'MotDePasse' => hash('sha1', 'MotDePasse1$'),
                'Details' => 'Restaurants sans permis d\'alcool',
                'No_TPS' => '4321206',
                'No_TVQ' => '1420091',
                'Conditions_paiement' => 'ZT60',
                'Devise' => 'CAD',
                'Mode_Communication' => 'Par courriel',
                'Etat_Demande' => 'Acceptée',
                'Date_Changement_Etat' => '2022-02-10 06:37:00',
                'Date_Creation' => '2022-02-21 14:11:00',
                'Date_Derniere_Modification' => '2022-02-28 14:19:00'
            ],
            [
                'NEQ' => '1163697742',
                'Courriel' => 'administration@bestbuy.ca',
                'Entreprise' => 'MAGASINS BEST BUY LTÉE',
                'MotDePasse' => hash('sha1', 'MotDePasse1$'),
                'Details' => 'Vente au détail et en ligne (matériel de bureau, appareils, divertissement) PRODUCTS, APPLIANCES, COMMUNICATIONS, EQUIPMENT, MUSIC & VIDEO SOFTWARE',
                'No_TPS' => '77801238',
                'No_TVQ' => '2347081',
                'Conditions_paiement' => 'Z210',
                'Devise' => 'CAD',
                'Mode_Communication' => 'Par courriel',
                'Etat_Demande' => 'Acceptée',
                'Date_Changement_Etat' => '2023-09-25 10:01:00',
                'Date_Creation' => '2023-02-21 14:11:00',
                'Date_Derniere_Modification' => '2024-04-30 15:29:00'
                
            ],
            [
                'NEQ' => '1178135605',
                'Courriel' => 'administration@edward-ia.ca',
                'Entreprise' => 'Edward IA Canada Inc.',
                'MotDePasse' => hash('sha1', 'MotDePasse1$'),
                'Details' => '',
                'No_TPS' => '365846325',
                'No_TVQ' => '0454032',
                'Conditions_paiement' => 'Z001',
                'Devise' => 'CAD',
                'Mode_Communication' => 'Par courriel',
                'Etat_Demande' => 'Acceptée',
                'Date_Changement_Etat' => '2024-04-25 08:37:00',
                'Date_Creation' => '2024-04-21 07:14:00',
                'Date_Derniere_Modification' => '2024-04-30 07:29:00'
            ]
         ]);
    }
}
