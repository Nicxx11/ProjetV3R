<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\PasswordResets;
use Illuminate\Http\Request;


class ForgottenPasswordController extends Controller
{

    public function index($Courriel){
        return view('auth.reset', compact('Courriel'));
    }

    public function createToken($Courriel){
        $randomNumber = Str ::random(8);
        $newToken['Courriel'] = $Courriel;
        $newToken['token'] = $randomNumber;

        $token = PasswordResets::where('Courriel', $Courriel)->first();
        if($token){
            PasswordResets::destroy($token->id);
            PasswordResets::create($newToken);
        } else {
            PasswordResets::create($newToken);
        }
        
        

        return "Success";
    }
    
    public function resetPassword(Request $request){
        $validatedData = $request->validate([
            'MotDePasse' => [
                'required',
                'string',
                'min:8', 
                'max:12', 
                'confirmed', 
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,12}$/' //au moins 1 maj, 1 min, 1 chiffre, 1 symbole
            ]
        ], [
            'MotDePasse.regex' => 'Le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre et un symbole.',
        ]);
    }

}
