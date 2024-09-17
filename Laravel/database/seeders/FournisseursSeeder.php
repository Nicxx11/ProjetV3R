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
                'NEQ' => '1141037813',
                'Courriel' => 'administration@walmart.ca',
                'Entreprise' => 'Walmart',
                'MotDePasse' => Hash::make('MotDePasse1$'),
                'Details' => 'Exploitation d\'un grand magasin de vente au détail',
                'No_TPS' => '321465',
                'No_TVQ' => '9888754',
                'Conditions_paiement' => 'Z001',
                'Devise' => 'CAD',
                'Mode_Communication' => 'Par courriel',
                'Etat_Demande' => 'Acceptée',
            ],
            [
                'NEQ' => '1142121434',
                'Courriel' => 'administration@dollarama.ca',
                'Entreprise' => '9199-3899 QUÉBEC INC.',
                'MotDePasse' => Hash::make('MotDePasse1$'),
                'Details' => 'Grands magasins',
                'No_TPS' => '4321108',
                'No_TVQ' => '722094',
                'Conditions_paiement' => 'Z001',
                'Devise' => 'CAD',
                'Mode_Communication' => 'Par courriel',
                'Etat_Demande' => 'En attente',
             ],
             [
                 'NEQ' => '1180063977',
                 'Courriel' => 'administration@pizzahut.com',
                 'Entreprise' => '9522-1883 Québec inc.',
                 'MotDePasse' => Hash::make('MotDePasse1$'),
                 'Details' => 'Restaurants sans permis d\'alcool',
                 'No_TPS' => '4321206',
                 'No_TVQ' => '1420091',
                 'Conditions_paiement' => 'ZT60',
                 'Devise' => 'CAD',
                 'Mode_Communication' => 'Par courriel',
                 'Etat_Demande' => 'Acceptée',
              ],
              [
                  'NEQ' => '1163697742',
                  'Courriel' => 'administration@bestbuy.ca',
                  'Entreprise' => 'MAGASINS BEST BUY LTÉE',
                  'MotDePasse' => Hash::make('MotDePasse1$'),
                  'Details' => 'Vente au détail et en ligne (matériel de bureau, appareils, divertissement) PRODUCTS, APPLIANCES, COMMUNICATIONS, EQUIPMENT, MUSIC & VIDEO SOFTWARE',
                  'No_TPS' => '77801238',
                  'No_TVQ' => '2347081',
                  'Conditions_paiement' => 'Z210',
                  'Devise' => 'CAD',
                  'Mode_Communication' => 'Par courriel',
                  'Etat_Demande' => 'Acceptée',
               ],
               [
                   'NEQ' => '1180063977',
                   'Courriel' => 'administration@edward-ia.ca',
                   'Entreprise' => 'Edward IA Canada Inc.',
                   'MotDePasse' => Hash::make('MotDePasse1$'),
                   'Details' => '',
                   'No_TPS' => '365846325',
                   'No_TVQ' => '0454032',
                   'Conditions_paiement' => 'Z001',
                   'Devise' => 'CAD',
                   'Mode_Communication' => 'Par courriel',
                   'Etat_Demande' => 'Acceptée',
                ]
         ]);
    }
}
