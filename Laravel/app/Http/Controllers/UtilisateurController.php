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
            return view('employe.connexion')->with('error', 'courriel ou mot de passe erroné');
        }
    }

    public function listUtilisateurs(){
        $utilisateurs = Utilisateur::all();

        return view('admin.listeUtilisateur', compact('utilisateurs'));
    }

    public function updateUtilisateurs(Request $request)
{
        $request->validate([
            'roles' => 'required|array',
            'roles.*' => 'in:Administrateur,Responsable,Commis',
        ]);

        foreach ($request->roles as $userId => $role) {
            $user = Utilisateur::find($userId);
            if ($user) {
                $user->Role = $role;
                $user->save();
            }
        }

        return redirect()->back()->with('success', 'Les rôles ont été mis à jour avec succès.');
    }


    public function store(Request $request){
        $utilisateur = $request->validate([
            'Prenom' => 'required|string|max:32',
            'Nom' => 'required|string|max:32',
            'Courriel' => 'required|email|unique:utilisateurs|max:64',
            'Role' => 'required|string|in:Administrateur,Responsable,Commis',
            'MotDePasse' => [
                'required',
                'string',
                'min:8', 
                'max:12', 
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,12}$/' //au moins 1 maj, 1 min, 1 chiffre, 1 symbole
            ],
        ],
        [
            'Prenom.required' => 'Le prénom est obligatoire.',
            'Prenom.max' => 'Le prénom ne doit pas dépasser les 32 caractères.',
            'Nom.required' => 'Le nom est obligatoire',
            'Nom.max' => 'Le nom ne doit pas dépasser les 32 caractères.',
            'Courriel.required' => 'Le courriel est obligatoire',
            'Courriel.email' => 'Le courriel doit être d\'un format valide.',
            'Courriel.unique' => 'Ce courriel est déjà utilisé par un utilisateur.',
            'Role.required' => 'Le rôle est obligatoire.',
            'Role.in' => 'Le rôle doit être une option valide.',
            'MotDePasse.required' => 'Le mot de passe est obligatoire',
            'MotDePasse.min' => 'Le mot de passe doit contenir un minimum de 8 caractères',
            'MotDePasse.max' => 'Le mot de passe ne doit pas dépasser 12 caractères',
            'MotDePasse.regex' => 'Le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre et un symbole.',
        ]);

        $result = Utilisateur::create($utilisateur);

        if($result) {
            return redirect()->back()->with('success','Utilisateur ajouté avec succès');
        } else {
            return redirect()->back()->with('error','Erreur lors de la création de l\'utilisateur');
        }

    }

    public function destroy($id){
        $utilisateur = Utilisateur::findOrFail($id);

        if(session('id') == $utilisateur->id) {
            $utilisateur->delete();
            session()->flush();
            return redirect('/')->with('success', 'Utilisateur supprimé avec succès');
        } else {
            $utilisateur->delete();
            return redirect()->back()->with('success', 'Utilisateur supprimé avec succès');
        }
        
    }

    public function logout(){
        session()->flush();
        return redirect('/');
    }
}
