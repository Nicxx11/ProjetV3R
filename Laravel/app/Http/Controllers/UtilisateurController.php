<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;

class UtilisateurController extends Controller
{
    public function index(){
        return view('employe.connexion');
    }

    public function login(Request $request){
        $validatedData = $request->validate([
            'Courriel' => 'required|email',
            'MotDePasse' => 'required'
        ],
        [
            'Courriel.required' => 'L\'identifiant est obligatoire',
            'MotDePasse.required' => 'Le mot de passe est obligatoire'
        ]);


        $utilisateur = Utilisateur::where('Courriel', $validatedData['Courriel'])->first();

        if($utilisateur && hash('sha1', $validatedData['MotDePasse']) == $utilisateur->MotDePasse){
            session([
                'id' => $utilisateur->id,
                'role' => $utilisateur->Role
            ]);

            if($utilisateur->Role == 'Commis'){
                return redirect()->route('fournisseurs.listcommis');
            } else {
                return redirect()->route('fournisseurs.list');
            }
        }
    }
}
