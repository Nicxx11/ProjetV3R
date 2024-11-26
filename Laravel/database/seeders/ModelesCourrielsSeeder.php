<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelesCourrielsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('modeles_courriels')->insert([
            [
                'NomModele' => 'Accusé de réception',
                'ObjetModele' => 'Accusé de réception de votre demande d\'ajout au bottin central',
                'MessageModele' => "Madame, Monsieur,

                Nous vous remercions d'avoir contacté la Ville de Trois-Rivières et d'avoir exprimé votre intérêt à être ajouté à 
                notre bottin central en tant que fournisseur potentiel.
                Nous accusons réception de votre demande ainsi que des documents et informations que vous avez soumis.
                Nous tenons à vous assurer que votre demande sera traitée avec l'attention et la diligence requises. 
                Notre processus d'évaluation implique une revue détaillée des informations fournies, ainsi qu'une analyse de la 
                compatibilité de vos produits et services avec les besoins de la Ville. Ce processus peut prendre un certain 
                temps, et nous nous engageons à vous fournir une réponse définitive dans les meilleurs délais.
                Nous vous remercions de votre patience et de votre compréhension, et nous sommes impatients d'explorer les 
                possibilités d'une collaboration fructueuse. 
                        
                Cordialement, 
                        
                John Doe 
                Ville de Trois-Rivières 
                "
            ]
         ]);
    }
}
