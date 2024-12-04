<?php

namespace App\Http\Controllers;

use App\Models\Categorie_Rbq;
use App\Models\ContactFournisseur;
use App\Models\Coordonnee;
use App\Models\Fournisseur;
use App\Models\Service;
use Illuminate\Http\Request;
use Log;
use Illuminate\Support\Facades\File;

class ServicesController extends Controller
{
    public function addService(){
        $jsonFilePath = public_path('json/UNSPSC.json');

        if (File::exists($jsonFilePath)) {
            // Read the contents of the JSON file
            $jsonFile = File::get($jsonFilePath);
    
            // Decode the JSON into an associative array
            $data = json_decode($jsonFile, true);
    
            // Send data to the view
            return view('fournisseur.ajouterService', compact('data'));
        } else {
            // Handle the case where the file does not exist
            return view('fournisseur.ajouterService')->withErrors(['msg' => 'File not found']);
        }

    }

    public function deleteService($sha1id){
        $id = Service::whereRaw('SHA1(id) = ?', [$sha1id])->value('id');

        if($id){
            $idFournisseur = Service::where('id', $id)->first()->No_Fournisseur;
            Service::where('id', $id)->delete();
            $licRbqData = Service::where('No_Fournisseur', $idFournisseur)->get();

            if(session('Role') == 'Responsable' || session('Role') == 'Administrateur'){
                $hashedId = hash('sha1', $idFournisseur);
                return redirect()->route('fournisseur.editProfileUser', ['id' => $hashedId])->with('messageService', 'Suppression du service réussie!');
            } else {
                $fournisseur = Fournisseur::find($idFournisseur);
                Log::info($fournisseur);
                $contactFourni = ContactFournisseur::where('No_Fournisseur', $fournisseur->id)->get();
                $service = Service::where('No_Fournisseur', $fournisseur->id)->get();
                $coord = Coordonnee::where('No_Fournisseur', $fournisseur->id)->first();
                session(['id' , $fournisseur->id]);
                session(['neq' , $fournisseur->neq]);
                session(['fournisseur', $fournisseur]);
                session(['contactFournis', $contactFourni]);
                session(['service', $service]);
                session(['coord', $coord]);
                session(['licRbq', $licRbqData]);

                return redirect()->route('profile.modifier');                
            }
        }
        
        return redirect()->route('profile.modifier')->with('messageService', 'Erreur lors de la suppresion.');
    }

    public function fetchServices(Request $request)
    {
        // Get the search query from the request (if any)
        $search = $request->get('q');  // 'q' is the search query parameter sent by Select2
        
        // Load the JSON data
        $jsonFilePath = public_path('json/UNSPSC.json');
        if (File::exists($jsonFilePath)) {
            $jsonFile = File::get($jsonFilePath);
            $data = json_decode($jsonFile, true);

            // Filter the data based on the search query (if provided)
            if ($search) {
                $data = array_filter($data, function($item) use ($search) {
                    return stripos($item['Nature du contrat'], $search) !== false || 
                        stripos($item['Description du code UNSPSC'], $search) !== false;
                });
            }

            // Prepare the results to return as an array with "id" and "text" keys
            $results = array_map(function($item) {
                return [
                    'id' => $item['Code UNSPSC'],
                    'text' => $item['Nature du contrat'] . ' - ' . $item['Description du code UNSPSC']
                ];
            }, array_slice($data, 0, 20));  // Limit to 20 items for each AJAX request

            return response()->json(['results' => $results]);
        }

        return response()->json(['results' => []]);
    }

}
