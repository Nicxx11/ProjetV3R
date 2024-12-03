<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Log;

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
            Log::info('USER');
            Log::info($utilisateur);
            session([
                'id' => $utilisateur->id,
                'Role' => $utilisateur->Role
            ]);

            if($utilisateur->Role == 'Commis'){
                Log::info('listeCommis redirection');
                return redirect()->route('fournisseurs.listcommis');
            } else {
                Log::info('liste redirection');
                return redirect()->route('fournisseurs.list');
            }
        } else {
            Log::info('fail');
            return view('employe.connexion');
        }
    }

    public function logout(){
        session()->flush();
        return redirect('/');
    }
}
