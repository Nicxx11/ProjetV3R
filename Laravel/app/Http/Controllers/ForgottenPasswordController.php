<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\PasswordResets;
use Illuminate\Http\Request;
use App\Models\Fournisseur;
use Log;


class ForgottenPasswordController extends Controller
{

    public function index($Token){
        return view('auth.reset', compact('Token'));
    }

    public function createToken($Courriel){
        $randomNumber = Str ::random(12);
        $newToken['Courriel'] = $Courriel;
        $newToken['token'] = $randomNumber;

        $token = PasswordResets::where('Courriel', $Courriel)->first();
        if($token){
            PasswordResets::destroy($token->id);
            PasswordResets::create($newToken);
        } else {
            PasswordResets::create($newToken);
        }
        
        

        return "Success;" . $newToken['token'];
    }
    
    public function removeToken($Courriel){
        $token = PasswordResets::where('Courriel', $Courriel)->first();
        if($token){
            PasswordResets::destroy($token->id);
        }
    }

    public function resetPassword(Request $request){
        Log::info('aaaa');
        $validatedData = $request->validate([
            'MotDePasse' => [
                'required',
                'string',
                'min:8', 
                'max:12', 
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,12}$/' //au moins 1 maj, 1 min, 1 chiffre, 1 symbole
            ],
            'Token' => 'required'
        ], [
            'MotDePasse.required' => 'Le mot de passe est obligatoire.',
            'MotDePasse.min' => 'Le mot de passe doit être minimalement 8 caractères.',
            'MotDePasse.max' => 'Le mot de passe ne doit pas dépasser les 12 caractères.',
            'MotDePasse.regex' => 'Le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre et un symbole.',
            'MotDePasse.confirmed' => 'Les mots de passe doivent correspondre.',
            'Token.required' => 'Le code temporaire est obligatoire.'
        ]);

        $token_h = $request->validate(['token_h' => 'required']);

        if(hash('sha1',$validatedData['Token']) === $token_h['token_h']){
            $passwordReset = PasswordResets::where('token', $validatedData['Token'])->first();
            if($passwordReset){
                // call method to update password

                $fournisseur_id = Fournisseur::where('Courriel', $passwordReset['Courriel'])->first();
                if($fournisseur_id){
                    $fournisseurController = new FournisseursController();
                    $fournisseurController->updatePassword($fournisseur_id['id'], $validatedData['MotDePasse']);
                    ForgottenPasswordController::removeToken($fournisseur_id['Courriel']);
                }

                return redirect()->route('index.index')->with('message', 'Mot de passe mis à jour avec succès.');

            } else {
                return redirect()->route('index.index');
            }
        }

        
        
    }

}
