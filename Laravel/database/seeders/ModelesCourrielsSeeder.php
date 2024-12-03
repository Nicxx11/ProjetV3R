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
                        
Ville de Trois-Rivières 
                "
            ],
            [
                'NomModele' => 'Confirmation acceptation',
                'ObjetModele' => 'Confirmation de l\'acceptation de votre demande d\'ajout au bottin central',
                'MessageModele' => 'Madame, Monsieur,

Nous avons le plaisir de vous informer que votre demande d\'ajout au bottin central de la Ville de Trois-Rivières a été acceptée.
                        
Afin de finaliser votre inscription, nous vous invitons à compléter les informations nécessaires relatives à votre compte. Vous pouvez accéder à votre profil et remplir les champs requis directement sur notre plateforme en ligne.
                        
Nous vous remercions de l\'intérêt que vous portez à la Ville de Trois-Rivières et nous sommes impatients de collaborer avec vous. Si vous avez des questions ou si vous avez besoin d\'assistance pour remplir vos informations, n\'hésitez pas à nous contacter.
                
Dans l\'attente de votre mise à jour, nous vous prions d\'agréer, Madame, Monsieur, l\'expression de nos salutations distinguées.
                        
Cordialement,
Ville de Trois-Rivières'
            ],
            [
                'NomModele' => 'Refus demande',
                'ObjetModele' => 'Refus de votre demande d\'ajout au bottin central',
                'MessageModele' => 'Madame, Monsieur,

Nous avons bien pris connaissance de votre demande d\'ajout en tant que fournisseur auprès de la Ville de Trois-Rivières. Après examen de votre dossier, nous regrettons de vous informer que votre demande n\'a pas été retenue.        

La raison de votre refus est la suivante: RAISON_REFUS_DEMANDE

Si vous avez des questions ou si vous souhaitez des précisions supplémentaires, n\'hésitez pas à nous contacter.
                
Nous vous prions d\'agréer, Madame, Monsieur, l\'expression de nos salutations distinguées.
                
Cordialement,
Ville de Trois-Rivières'
            ],
            [
                'NomModele' => 'Ajout fournisseur',
                'ObjetModele' => 'Nouveau fournisseur ajouté au bottin central',
                'MessageModele' => 'Madame, Monsieur,
            
Nous avons le plaisir de vous informer qu\'un nouveau fournisseur a été ajouté avec succès au bottin central de la Ville de Trois-Rivières. Cette entreprise fait désormais partie de notre réseau de partenaires et sera disponible pour vos futures collaborations.
            
Si vous avez des questions ou souhaitez plus d\'informations concernant ce fournisseur, n\'hésitez pas à nous contacter.
            
Nous vous prions d\'agréer, Madame, Monsieur, l\'expression de nos salutations distinguées.
            
Cordialement,
Ville de Trois-Rivières'
            ],
            [
                "NomModele" => "Dépassement de la date de révision du fournisseur",
  "ObjetModele" => "Le fournisseur a dépassé la date de révision",
  "MessageModele" => "Madame, Monsieur,

Nous tenons à vous informer qu'un fournisseur a dépassé la date prévue pour la révision de ses informations dans notre système. Nous vous prions de bien vouloir prendre les mesures nécessaires pour assurer une mise à jour rapide et précise de ses données.

Si vous avez besoin de plus d'informations ou d'assistance pour effectuer cette révision, n'hésitez pas à nous contacter.

Nous vous remercions de votre collaboration et restons disponibles pour toute question.

Cordialement,
Ville de Trois-Rivières"
            ]
         ]);
    }
}
