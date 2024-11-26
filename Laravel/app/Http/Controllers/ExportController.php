<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactFournisseur;
use App\Models\Coordonnee;
use App\Models\Service;
use App\Models\Licence_Rbq;
use App\Models\Fournisseur;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportController extends Controller
{
    public function getFournisseurData($id){

        $fournisseur = Fournisseur::where('id', $id)->first();
        $coordonnees = Coordonnee::where('No_Fournisseur', $id)->first();
        $contacts = ContactFournisseur::where('No_Fournisseur', $id)->get(); // 0+
        $services = Service::where('No_Fournisseur', $id)->get(); // 0+
        $licences_rbqs = Licence_Rbq::where('No_Fournisseur', $id)->get(); // 0+

        $fournisseurData = [$fournisseur, $coordonnees, $contacts, $services, $licences_rbqs];

        return $fournisseurData;
    }

    public function export($id){

        $fournisseurData = $this->getFournisseurData($id);

        // Create the spreadsheet
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()
                    ->setCreator('Ville de Trois-Rivières')
                    ->setTitle('Export du fournisseur ' . $fournisseurData['fournisseur']->Entreprise);

        // Add Fournisseur to sheet2
        $sheet1 = $spreadsheet->setActiveSheetIndex(0);
        $sheet1->setTitle('Fournisseur');

        $sheet1->setCellValue('A1', 'Fournisseur ID')
               ->setCellValue('B1', 'NEQ')
               ->setCellValue('C1', 'Courriel')
               ->setCellValue('D1', 'Entreprise')
               ->setCellValue('E1', 'Détails')
               ->setCellValue('F1', 'No_TPS')
               ->setCellValue('G1', 'No_TVQ')
               ->setCellValue('H1', 'Conditions_Paiement')
               ->setCellValue('I1', 'Devise')
               ->setCellValue('J1', 'Mode_Communication')
               ->setCellValue('K1', 'Etat_Demande');

        $sheet1->setCellValue('A2', $fournisseurData['fournisseur']->id)
               ->setCellValue('B2', $fournisseurData['fournisseur']->NEQ)
               ->setCellValue('C2', $fournisseurData['fournisseur']->Courriel)
               ->setCellValue('D2', $fournisseurData['fournisseur']->Entreprise)
               ->setCellValue('E2', $fournisseurData['fournisseur']->Details)
               ->setCellValue('F2', $fournisseurData['fournisseur']->No_TPS)
               ->setCellValue('G2', $fournisseurData['fournisseur']->No_TVQ)
               ->setCellValue('H2', $fournisseurData['fournisseur']->Conditions_Paiement)
               ->setCellValue('I2', $fournisseurData['fournisseur']->Devise)
               ->setCellValue('J2', $fournisseurData['fournisseur']->Mode_Communication)
               ->setCellValue('K2', $fournisseurData['fournisseur']->Etat_Demande);

        // Add Coordonnées to sheet2
        $spreadsheet->createSheet();
        $sheet2 = $spreadsheet->setActiveSheetIndex(1);
        $sheet2->setTitle('Coordonnées');

        $sheet2->setCellValue('A1', 'NoCivique')
               ->setCellValue('B1', 'Rue')
               ->setCellValue('C1', 'Bureau')
               ->setCellValue('D1', 'Ville')
               ->setCellValue('E1', 'Province')
               ->setCellValue('F1', 'CodePostal')
               ->setCellValue('G1', 'CodeRegionAdministrative')
               ->setCellValue('H1', 'RegionAdministrative')
               ->setCellValue('I1', 'SiteInternet')
               ->setCellValue('J1', 'Numero')
               ->setCellValue('K1', 'TypeTelephone')
               ->setCellValue('L1', 'Poste');

        $sheet2->setCellValue('A2', $fournisseurData['coordonnees']->NoCivique)
               ->setCellValue('B2', $fournisseurData['coordonnees']->Rue)
               ->setCellValue('C2', $fournisseurData['coordonnees']->Bureau)
               ->setCellValue('D2', $fournisseurData['coordonnees']->Ville)
               ->setCellValue('E2', $fournisseurData['coordonnees']->Province)
               ->setCellValue('F2', $fournisseurData['coordonnees']->CodePostal)
               ->setCellValue('G2', $fournisseurData['coordonnees']->CodeRegionAdministrative)
               ->setCellValue('H2', $fournisseurData['coordonnees']->RegionAdministrative)
               ->setCellValue('I2', $fournisseurData['coordonnees']->SiteInternet)
               ->setCellValue('J2', $fournisseurData['coordonnees']->Numero)
               ->setCellValue('K2', $fournisseurData['coordonnees']->TypeTelephone)
               ->setCellValue('L2', $fournisseurData['coordonnees']->Poste);

        // Add contacts to sheet3
        $spreadsheet->createSheet();
        $sheet3 = $spreadsheet->setActiveSheetIndex(2);
        $sheet3->setTitle('Contacts');

        $sheet3->setCellValue('A1', 'Prénom')
               ->setCellValue('B1', 'Nom')
               ->setCellValue('C1', 'Fonction')
               ->setCellValue('D1', 'Courriel')
               ->setCellValue('E1', 'Numero')
               ->setCellValue('F1', 'TypeTelephone')
               ->setCellValue('G1', 'Poste');

        $row = 2;
        foreach($fournisseurData['contacts'] as $contact){
            $sheet3->setCellValue('A' . $row, $contact->Prenom)
                   ->setCellValue('B' . $row, $contact->Nom)
                   ->setCellValue('C' . $row, $contact->Fonction)
                   ->setCellValue('D' . $row, $contact->Courriel)
                   ->setCellValue('E' . $row, $contact->Numero)
                   ->setCellValue('F' . $row, $contact->TypeTelephone)
                   ->setCellValue('G' . $row, $contact->Poste);
            
            $row++;
        }

    }
}