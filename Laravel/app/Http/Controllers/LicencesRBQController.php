<?php

namespace App\Http\Controllers;

use App\Models\Categorie_Rbq;
use App\Models\ContactFournisseur;
use App\Models\Coordonnee;
use App\Models\Fournisseur;
use App\Models\Service;
use Illuminate\Http\Request;
use Exception;
use Log;
use App\Models\Licence_Rbq;
use View;

class LicencesRBQController extends Controller
{
    public function addRBQ(Request $request){
        
        $request['No_Licence_RBQ'] = str_replace('-', '', $request['No_Licence_RBQ']);

        $validatedData = $request->validate([
            'No_Licence_RBQ' => 'required|max:10',
            'Statut' => 'required|max:23',
            'TypeLicence' => 'required|max:26',
            'Categorie' => 'required|max:10',
            'Travaux_Permis' => 'required|max:255'
        ], 
        [
            'No_Licence_RBQ.required' => 'Le numéro de licence RBQ est requis',
            'No_Licence_RBQ.max' => 'Le numéro de licence RBQ ne doit pas dépasser les 10 caractères',
            
            'Statut.required' => 'Le statut est requis',
            'Statut.max' => 'Le statut ne doit pas dépasser les 23 caractères',
        
            'TypeLicence.required' => 'Le type de licence est requis',
            'TypeLicence.max' => 'Le type de licence ne doit pas dépasser les 26 caractères',
        
            'Categorie.required' => 'La catégorie est requise',
            'Categorie.max' => 'La catégorie ne doit pas dépasser les 10 caractères',
        
            'Travaux_Permis.required' => 'Les travaux permis sont requis',
            'Travaux_Permis.max' => 'Les travaux permis ne doivent pas dépasser les 64 caractères',
        ]);
        
        $validatedData['Code_Sous_Categorie'] = trim(preg_match('/^[^a-zA-Z]*/', $validatedData['Travaux_Permis'], $matches) ? $matches[0] : null);
        if($validatedData['Code_Sous_Categorie'] == null){
            return redirect()->back()->withErrors('messageRBQ', 'Travaux permis invalides.');
        }       

        if(session('id') == null || session('id') == ''){
            session()->put('id', $request->idFournisseur);
        }

        $validatedData['No_Fournisseur'] = $request->idFournisseur;

        try{
            Licence_Rbq::create($validatedData);
            session(['licRbq' => Licence_Rbq::where('No_Fournisseur', $request->idFournisseur)->get()]);
        } catch(Exception $e){
            Log::info('Error while adding RBQ: ' . $e->getMessage());
            return redirect()->back()->withErrors(['messageRBQ' => 'Une erreur est survenue lors de l\'ajout de la licence.']);
        }

        if(session('Role') == 'Responsable' || session('Role') == 'Administrateur'){
            $hashedId = hash('sha1', $request->idFournisseur);
            return redirect()->route('fournisseur.editProfileUser', ['id' => $hashedId]);
        } else {
            $fournisseur = Fournisseur::find($request->idFournisseur);
            $contactFourni = ContactFournisseur::where('No_Fournisseur', $fournisseur->id)->get();
            $service = Service::where('No_Fournisseur', $fournisseur->id)->get();
            $coord = Coordonnee::where('No_Fournisseur', $fournisseur->id)->first();
            session(['id' , $fournisseur->id]);
            session(['neq' , $fournisseur->neq]);
            session(['fournisseur', $fournisseur]);
            session(['contactFournis', $contactFourni]);
            session(['service', $service]);
            session(['coord', $coord]);
            session(['messageRbq', 'Ajout de la licence réussie!']);

            return redirect()->route('profile.modifier');
        }
    }

    public function deleteRBQ($sha1id){
        $id = Licence_Rbq::whereRaw('SHA1(id) = ?', [$sha1id])->value('id');

        if($id){
            $idFournisseur = Licence_Rbq::where('id', $id)->first()->No_Fournisseur;
            Licence_Rbq::where('id', $id)->delete();
            $licRbqData = Licence_Rbq::where('No_Fournisseur', $idFournisseur)->get();
            session(['licRbq' => $licRbqData]);

            if(session('Role') == 'Responsable' || session('Role') == 'Administrateur'){
                $hashedId = hash('sha1', $idFournisseur);
                return redirect()->route('fournisseur.editProfileUser', ['id' => $hashedId])->with('messageRbq', 'Suppression de la licence réussie!');
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
                
                return redirect()->route('profile.modifier');
            }
        }
        
        return redirect()->route('profile.modifier')->with('messageRBQ', 'Erreur lors de la suppresion.');
    }
}
