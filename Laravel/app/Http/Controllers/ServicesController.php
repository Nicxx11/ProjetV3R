<?php

namespace App\Http\Controllers;

use App\Models\Categorie_Rbq;
use App\Models\ContactFournisseur;
use App\Models\Coordonnee;
use App\Models\Fournisseur;
use App\Models\Licence_Rbq;
use App\Models\Service;
use Illuminate\Http\Request;
use Log;

class ServicesController extends Controller
{
    public function addService(Request $request){

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
}
