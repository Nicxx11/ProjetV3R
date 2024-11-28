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
use PhpOffice\PhpSpreadsheet\Style\Alignment;

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
                    ->setTitle('Export du fournisseur ' . $fournisseurData[0]->Entreprise);

        // Add Fournisseur to sheet2
        $sheet1 = $spreadsheet->setActiveSheetIndex(0);
        $sheet1->setTitle('Fournisseur');

        $sheet1->setCellValue('A1', 'Fournisseur ID')
               ->setCellValue('B1', 'NEQ')
               ->setCellValue('C1', 'Courriel')
               ->setCellValue('D1', 'Entreprise')
               ->setCellValue('E1', 'Details')
               ->setCellValue('F1', 'No_TPS')
               ->setCellValue('G1', 'No_TVQ')
               ->setCellValue('H1', 'Conditions_Paiement')
               ->setCellValue('I1', 'Devise')
               ->setCellValue('J1', 'Mode_Communication')
               ->setCellValue('K1', 'Etat_Demande');

        $sheet1->setCellValue('A2', $fournisseurData[0]->id)
               ->setCellValue('B2', $fournisseurData[0]->NEQ)
               ->setCellValue('C2', $fournisseurData[0]->Courriel)
               ->setCellValue('D2', $fournisseurData[0]->Entreprise)
               ->setCellValue('E2', $fournisseurData[0]->Details)
               ->setCellValue('F2', $fournisseurData[0]->No_TPS)
               ->setCellValue('G2', $fournisseurData[0]->No_TVQ)
               ->setCellValue('H2', $fournisseurData[0]->Conditions_Paiement)
               ->setCellValue('I2', $fournisseurData[0]->Devise)
               ->setCellValue('J2', $fournisseurData[0]->Mode_Communication)
               ->setCellValue('K2', $fournisseurData[0]->Etat_Demande);

       // align text to the left
       $sheet1->getStyle('A1:K2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

       // auto column width setting for sheet
       foreach (range('A', 'K') as $column) {
              $sheet1->getColumnDimension($column)->setAutoSize(true);
       }


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

        $sheet2->setCellValue('A2', $fournisseurData[1]->NoCivique)
               ->setCellValue('B2', $fournisseurData[1]->Rue)
               ->setCellValue('C2', $fournisseurData[1]->Bureau)
               ->setCellValue('D2', $fournisseurData[1]->Ville)
               ->setCellValue('E2', $fournisseurData[1]->Province)
               ->setCellValue('F2', $fournisseurData[1]->CodePostal)
               ->setCellValue('G2', $fournisseurData[1]->CodeRegionAdministrative)
               ->setCellValue('H2', $fournisseurData[1]->RegionAdministrative)
               ->setCellValue('I2', $fournisseurData[1]->SiteInternet)
               ->setCellValue('J2', $fournisseurData[1]->Numero)
               ->setCellValue('K2', $fournisseurData[1]->TypeTelephone)
               ->setCellValue('L2', $fournisseurData[1]->Poste);

       $sheet2->getStyle('A1:L2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
               
       foreach (range('A', 'L') as $column) {
              $sheet2->getColumnDimension($column)->setAutoSize(true);
       }

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
       foreach($fournisseurData[2] as $contact){
            $sheet3->setCellValue('A' . $row, $contact->Prenom)
                   ->setCellValue('B' . $row, $contact->Nom)
                   ->setCellValue('C' . $row, $contact->Fonction)
                   ->setCellValue('D' . $row, $contact->Courriel)
                   ->setCellValue('E' . $row, $contact->Numero)
                   ->setCellValue('F' . $row, $contact->TypeTelephone)
                   ->setCellValue('G' . $row, $contact->Poste);
            $row++;
       }

       $sheet3->getStyle('A1:G20')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

       foreach (range('A', 'G') as $column) {
              $sheet3->getColumnDimension($column)->setAutoSize(true);
       }

        // Add services et sheet4
        $spreadsheet->createSheet();
        $sheet4 = $spreadsheet->setActiveSheetIndex(3);
        $sheet4->setTitle('Services');

       $sheet4->setCellValue('A1', 'Nature')
              ->setCellValue('B1', 'Code_Categorie')
              ->setCellValue('C1', 'Categorie')
              ->setCellValue('D1', 'UNSPSC')
              ->setCellValue('E1', 'Description');

        $row = 2;
        foreach($fournisseurData[3] as $service){
              $sheet4->setCellValue('A' . $row, $service->Nature)
                     ->setCellValue('B' . $row, $service->Code_Categorie)
                     ->setCellValue('C' . $row, $service->Categorie)
                     ->setCellValue('D' . $row, $service->UNSPSC)
                     ->setCellValue('E' . $row, $service->Description);

              $row++;
        }

        $sheet4->getStyle('A1:E50')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

        foreach (range('A', 'E') as $column) {
              $sheet4->getColumnDimension($column)->setAutoSize(true);
       }

        $spreadsheet->createSheet();
        $sheet5 = $spreadsheet->setActiveSheetIndex(4);
        $sheet5->setTitle('Licences RBQ');

        $sheet5->setCellValue('A1', 'No_Licence_RBQ')
               ->setCellValue('B1', 'Statut')
               ->setCellValue('C1', 'TypeLicence')
               ->setCellValue('D1', 'Categorie')
               ->setCellValue('E1', 'Code_Sous_Categorie')
               ->setCellValue('F1', 'Travaux_Permis');

        $row = 2;
        foreach($fournisseurData[4] as $rbq){
              $sheet5->setCellValue('A' . $row, $rbq->No_Licence_RBQ)
                     ->setCellValue('B' . $row, $rbq->Statut)
                     ->setCellValue('C' . $row, $rbq->TypeLicence)
                     ->setCellValue('D' . $row, $rbq->Categorie)
                     ->setCellValue('E' . $row, $rbq->Code_Sous_Categorie)
                     ->setCellValue('F' . $row, $rbq->Travaux_Permis);

              $row++;
        }

        $sheet5->getStyle('A1:F50')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

        foreach (range('A', 'F') as $column) {
              $sheet5->getColumnDimension($column)->setAutoSize(true);
       }



        // create the actual file temporarily in our public dir
        $spreadsheet->setActiveSheetIndex(0);
        $writer = new Xlsx($spreadsheet);
        $fileName = 'fournisseur_export_' . $fournisseurData[0]->Entreprise . '.xlsx';
        $tempFilePath = storage_path('app/public' . $fileName);

        $writer->save($tempFilePath);

        // download file for user then delete the local copy of it
        return response()->download($tempFilePath)->deleteFileAfterSend(true);

    }
}