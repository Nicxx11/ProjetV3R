<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CategoriesRbqsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("categories_rbqs")->insert([
            [
                'Categorie' => 'Général',
                'Code_Sous_Categorie' => '1.1.1 Bâtiments résidentiels neufs visés par un plan de garantie classe I'
            ],
            [
                'Categorie'=> 'Général',
                'Code_Sous_Categorie'=> '1.1.2 Bâtiments résidentiels neufs visés par un plan de garantie classe II'
            ],
            [
                'Categorie'=> 'Général',
                'Code_Sous_Categorie'=> '1.2 Petits bâtiments'
            ],
            [
                'Categorie'=> 'Général',
                'Code_Sous_Categorie'=> '1.3 Bâtiments de tout genre'
            ],
            [
                'Categorie'=> 'Général',
                'Code_Sous_Categorie'=> '1.4 Routes et canalisation'
            ],
            [
                'Categorie'=> 'Général',
                'Code_Sous_Categorie'=> '1.5 Structures d\'ouvrages de génie civil'
            ],
            [
                'Categorie'=> 'Général',
                'Code_Sous_Categorie'=> '1.6 ouvrages de génie civil immergés'
            ],
            [
                'Categorie'=> 'Général',
                'Code_Sous_Categorie'=> '1.7 Télécommunication, transport, transformation et distribution d\'énergie électrique'
            ],
            [
                'Categorie'=> 'Général',
                'Code_Sous_Categorie'=> '1.8 Installation d\'équipement pétrolier'
            ],
            [
                'Categorie'=> 'Général',
                'Code_Sous_Categorie'=> '1.9 Mécanique du bâtiment'
            ],
            [
                'Categorie'=> 'Général',
                'Code_Sous_Categorie'=> '1.10 Remontées mécaniques'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '2.1 Puits forés'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '2.2 Ouvrages de captage d\'eau non forés'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '2.3 Systèmes de pompage des eaux souterraines'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '2.4 Systèmes d\'assainissement autonome'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '2.5 Excavation et terrassement'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '2.6 Pieux et fondations spéciales'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '2.7 Travaux d\'emplacement'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '2.8 Sautage'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '3.1 Structures de béton'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '3.2 Petits ouvrages de béton'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '4.1 Structures de maçonnerie'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '4.2 Travaux de maçonnerie non structurale marbre et céramique'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '5.1 Structures métallique et éléments préfabriqués de béton'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '5.2 Ouvrages métalliques'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '6.1 Charpentes de bois'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '6.2 Travaux de bois et plastique'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '7 Isolation, étanchéité, couvertures et revêtement extérieur'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '8 Portes et fenêtres'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '9 Travaux de finition'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '10 Systèmes de chauffage localisé à combustion solide'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '11.1 Tuyauterie industrielle ou institutionnelle sous pression'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '11.2 Équipements et produits spéciaux'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '12 Armoires et comptoirs usinés'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '13.1 Protection contre la foudre'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '13.2 Systèmes d\'alarme incendie'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '13.3 Systèmes d\'extinction d\'incendie'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '13.4 Systèmes localisés d\'extinction incendie'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '13.5 Installations spéciales ou préfabriquées'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '14.1 Ascenseurs et montecharges'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '14.2 Appareils élévateurs pour personnes handicapées'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '14.3 Autres types d\'appareils élévateurs'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '15.1 Systèmes de chauffage à air pulsé'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '15.1.1 Systèmes de chauffage à air pulsé pour certains travaux qui ne sont pas réservés exclusivement aux maîtres mécaniciens en tuyauterie'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '15.2 Systèmes de brûleurs au gaz naturel'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '15.2.1 Systèmes de brûleurs au gaz naturel pour certains travaux qui ne sont pas réservés exclusivement aux maîtres mécaniciens en tuyauterie'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '15.3 Systèmes de brûleurs à l\'huile'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '15.3.1 Systèmes de brûleurs à l\'huile pour certains travaux qui ne sont pas réservés exclusivement aux maîtres mécaniciens en tuyauterie'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '15.4 Systèmes de chauffage hydronique'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '15.4.1 Systèmes de chauffage hydronique pour certains travaux qui ne sont pas réservés exclusivement aux maîtres mécaniciens en tuyauterie'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '15.5 Plomberie'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '15.5.1 Plomberie pour certains travaux qui ne sont pas réservés exclusivement aux maîtres mécaniciens en tuyauterie'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '15.6 Propane'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '15.7 Ventilation résidentielle'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '15.8 Ventilation'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '15.9 Petits systèmes de réfrigération'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '15.10 Réfrigération'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '16 Électricité'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '17.1 Instrumentation, contrôle et régulation'
            ],
            [
                'Categorie'=> 'Spécialisé',
                'Code_Sous_Categorie'=> '17.2 Intercommunication, téléphonie et surveillance'
            ]
        ]);
    }
}
