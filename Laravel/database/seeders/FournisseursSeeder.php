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
                'Courriel' => 'test@test.com',
                'Entreprise' => 'DeLaVie',
                'MotDePasse' => Hash::make('password1234'),
                'Details' => 'Beaucoup de details',
                'No_TPS' => '321465',
                'No_TVQ' => '9888754',
                'Conditions_paiement' => 'Z123',
                'Devise' => 'CAD',
                'Mode_Communication' => 'Celluphone Tellulaire',
                'Etat_Demande' => 'En attente',
            ],
            [
                'NEQ' => null,
                'Courriel' => 'test@test.com',
                'Entreprise' => 'DeLaVie',
                'MotDePasse' => Hash::make('password1234'),
                'Details' => 'Beaucoup de details',
                'No_TPS' => '321465',
                'No_TVQ' => '9888754',
                'Conditions_paiement' => 'Z123',
                'Devise' => 'CAD',
                'Mode_Communication' => 'Celluphone Tellulaire',
                'Etat_Demande' => 'En attente',
             ]
         ]);
    }
}
