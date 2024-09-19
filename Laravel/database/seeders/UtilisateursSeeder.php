<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UtilisateursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('utilisateurs')->insert([
            [
                'Prenom' => 'Thomas',
                'Nom' => 'St-Amand',
                'Courriel' => 'thomasstamand1@gmail.com',
                'Role' => 'Administrateur',
                'MotDePasse' => hash('sha1','MotDePasse1$')
            ],
            [
                'Prenom' => 'Nicolas',
                'Nom' => 'Veilleux',
                'Courriel' => 'nicolasveilleux@gmail.com',
                'Role' => 'Administrateur',
                'MotDePasse' => hash('sha1','MotDePasse1$')
            ],
            [
                'Prenom' => 'Joseph',
                'Nom' => 'Laforce',
                'Courriel' => 'josephlaforce@gmail.com',
                'Role' => 'Responsable',
                'MotDePasse' => hash('sha1','MotDePasse1$')
            ],
            [
                'Prenom' => 'Louis',
                'Nom' => 'Dupuis',
                'Courriel' => 'louisdupuis@gmail.com',
                'Role' => 'Commis',
                'MotDePasse' => hash('sha1','MotDePasse1$')
            ],
            [
                'Prenom' => 'Carl',
                'Nom' => 'Lapointe',
                'Courriel' => 'carllapointe1997@gmail.com',
                'Role' => 'Commis',
                'MotDePasse' => hash('sha1','MotDePasse1$')
            ]
         ]);
    }
}
