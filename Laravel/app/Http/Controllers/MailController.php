<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use App\Models\ModeleCourriel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\parametres_systeme;
use Log;


class MailController extends Controller
{
    public function sendFournisseurEmail($email, $NomModele, $raison=''){
        $modele = ModeleCourriel::where('NomModele', $NomModele)->first();
        $subject = $modele['ObjetModele'];
        $message = $modele['MessageModele'];

        if($NomModele == 'Refus demande'){
            $message = str_replace('RAISON_REFUS_DEMANDE', $raison, $modele['MessageModele']);
        }

        Log::info($message);

        Mail::raw($message, function ($message) use ($email, $subject) {
            $message->to($email)
                    ->subject($subject)
                    ->from('projetv3r2024@gmail.com');
        });
    }

    

    public function sendPasswordResetLink(Request $request){
        
        $request->validate([
            'Courriel' => 'required|email',
        ], [
            'Courriel.required' => 'Veuillez entrer une adresse courriel.',
            'Courriel.email' => 'Le courriel doit être valide'
        ]);

        $status = "";

        $user = Fournisseur::where('Courriel', $request['Courriel'])->first();
        if($user){
            $fournisseurController = new ForgottenPasswordController();
            $status = $fournisseurController->createToken($request['Courriel']);
        }

        Log::info($status);

        if(strpos($status, 'Success') !== false){

            $token = last(explode(';',$status));

            $email = $request['Courriel'];
            $subject = "Réinitialisation de votre mot de passe";
            $message = '<p>Madame, Monsieur,</p>
    
            <p>Nous avons reçu une demande de réinitialisation de mot de passe pour votre compte sur le portail de fournisseurs de la ville de Trois-Rivières. Si vous n\'êtes pas à l\'origine de cette demande, veuillez ignorer ce message.</p>

            <p>Pour réinitialiser votre mot de passe, veuillez cliquer sur le lien ci-dessous :</p>
            
            <p><a href="http://127.0.0.1:8000/Password/Reset/'.hash('sha1', $token).'">Réinitialiser mon mot de passe</a></p>

            <p>Votre code de réinitialisation est le suivant: '.$token.'</p>
            
            <p>Ce lien expirera dans 10 minutes. Si vous ne parvenez pas à réinitialiser votre mot de passe dans ce délai, vous devrez demander une nouvelle réinitialisation.</p>

            <p>Si vous avez des questions ou avez besoin d\'assistance supplémentaire, n\'hésitez pas à nous contacter à projetv3r2024@gmail.com.</p>
            
            <p>Cordialement,</p>
            <p>Ville de Trois-Rivières</p>';
    
            Mail::send([], [], function($mail) use ($email, $subject, $message) {
                $mail->to($email)
                    ->subject($subject)
                    ->from('projetv3r2024@gmail.com')
                    ->html($message);
            });
        }


        return redirect()->route('index.index');
    }

    public function index(){
        $modeles = ModeleCourriel::all();

        return view('admin.modeles', compact('modeles'));

    }

    public function update(Request $request)
    {
        $request->validate([
            'message_modele' => 'required|string',
        ]);

        $modele = ModeleCourriel::findOrFail($request->input('modele_id'));
        $modele->MessageModele = $request->input('message_modele');
        $modele->save();

        return redirect()->back()->with('success', 'Modèle mis à jour avec succès!');
    }

    public function getModele($id){
        $modele = ModeleCourriel::find($id);
            
        if ($modele) {
            return response()->json([
                'message' => $modele->MessageModele
            ]);
        }
        
        return response()->json([
            'message' => ''
        ], 404);
    }    
}