<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\parametres_systeme;
use Log;


class MailController extends Controller
{
    
    public function sendPlainTextEmail()
    {
        $subject = "Accusé de réception de votre demande d'ajout au bottin central";
        $message = "Madame, Monsieur,

Nous vous remercions d'avoir contacté la Ville de Trois-Rivières et d'avoir exprimé votre intérêt à être ajouté à 
notre bottin central en tant que fournisseur potentiel.
Nous accusons réception de votre demande ainsi que des documents et informations que vous avez soumis.
Nous tenons à vous assurer que votre demande sera traitée avec l'attention et la diligence requises. 
Notre processus d'évaluation implique une revue détaillée des informations fournies, ainsi qu'une analyse de la 
compatibilité de vos produits et services avec les besoins de la Ville. Ce processus peut prendre un certain 
temps, et nous nous engageons à vous fournir une réponse définitive dans les meilleurs délais.
Nous vous remercions de votre patience et de votre compréhension, et nous sommes impatients d'explorer les 
possibilités d'une collaboration fructueuse. 
        
Cordialement,      
Ville de Trois-Rivières";

        $record = parametres_systeme::findOrFail(1);
        $email = "projetv3r2024@gmail.com";

        Mail::raw($message, function ($message) use ($email, $subject) {
            $message->to($email)
                    ->subject($subject)
                    ->from('projetv3r2024@gmail.com');
        });

        return response('email sent to ' . $email, Response::HTTP_OK);;
    }

    public function sendWelcomeEmail($email)
    {
        $subject = "Accusé de réception de votre demande d'ajout au bottin central";
        $message = "Madame, Monsieur,

Nous vous remercions d'avoir contacté la Ville de Trois-Rivières et d'avoir exprimé votre intérêt à être ajouté à 
notre bottin central en tant que fournisseur potentiel.
Nous accusons réception de votre demande ainsi que des documents et informations que vous avez soumis.
Nous tenons à vous assurer que votre demande sera traitée avec l'attention et la diligence requises. 
Notre processus d'évaluation implique une revue détaillée des informations fournies, ainsi qu'une analyse de la 
compatibilité de vos produits et services avec les besoins de la Ville. Ce processus peut prendre un certain 
temps, et nous nous engageons à vous fournir une réponse définitive dans les meilleurs délais.
Nous vous remercions de votre patience et de votre compréhension, et nous sommes impatients d'explorer les 
possibilités d'une collaboration fructueuse. 
        
Cordialement, 
        
John Doe 
Ville de Trois-Rivières";

        Mail::raw($message, function ($message) use ($email, $subject) {
            $message->to($email)
                    ->subject($subject)
                    ->from('projetv3r2024@gmail.com');
        });

        return response('email sent to ' . $email, Response::HTTP_OK);;
    }

    public function sendAcceptationEmail($email)
    {
        $subject = "Confirmation de l'acceptation de votre demande d'ajout au bottin central";
        $message = "Madame, Monsieur,

Nous avons le plaisir de vous informer que votre demande d'ajout au bottin central de la Ville de Trois-Rivières a été acceptée.
        
Afin de finaliser votre inscription, nous vous invitons à compléter les informations nécessaires relatives à votre compte. Vous pouvez accéder à votre profil et remplir les champs requis directement sur notre plateforme en ligne.
        
Nous vous remercions de l'intérêt que vous portez à la Ville de Trois-Rivières et nous sommes impatients de collaborer avec vous. Si vous avez des questions ou si vous avez besoin d’assistance pour remplir vos informations, n’hésitez pas à nous contacter.

Dans l'attente de votre mise à jour, nous vous prions d’agréer, Madame, Monsieur, l’expression de nos salutations distinguées.
        
Cordialement,
Ville de Trois-Rivières";

        Mail::raw($message, function ($message) use ($email, $subject) {
            $message->to($email)
                    ->subject($subject)
                    ->from('projetv3r2024@gmail.com');
        });

        return response('email sent to ' . $email, Response::HTTP_OK);;
    }

    public function sendFournisseurToFinancesEmail()
    {

        $fournisseur = Fournisseur::findOrFail(1);
        if($fournisseur->NEQ == null){
            $fournisseur->NEQ = "NONAPPLICABLE";
        }

        $subject = "Transmission du dossier fournisseur pour ajout au bottin central";
        $message = "Madame, Monsieur,

Nous vous informons que le dossier du fournisseur ". $fournisseur->Entreprise ." a été évalué et accepté pour être ajouté à notre bottin central des fournisseurs. Nous vous prions de bien vouloir procéder à l’enregistrement de ce fournisseur dans les systèmes financiers de la Ville de Trois-Rivières.
        
Nous vous remercions de prendre les mesures nécessaires pour finaliser l'ajout du fournisseur.

Entreprise: ".$fournisseur->Entreprise.",
Courriel: ".$fournisseur->Courriel.",
NEQ (si applicable): ".$fournisseur->NEQ.",
Détails: ".$fournisseur->Details.",
TPS: ".$fournisseur->No_TPS.",
TVQ: ".$fournisseur->No_TVQ.",
Conditions de paiement: ".$fournisseur->Conditions_Paiement.",
Devise: ".$fournisseur->Devise."

Ceci est un courriel automatisé, veuillez ne pas répondre à ce courriel.
        
Cordialement,
Ville de Trois-Rivières";

        $record = parametres_systeme::findOrFail(1);
        $email = "" . $record->Finances;


        Mail::raw($message, function ($message) use ($email, $subject) {
            $message->to($email)
                    ->subject($subject)
                    ->from('projetv3r2024@gmail.com');
        });

        return response('email sent to ' . $email, Response::HTTP_OK);;
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
        if($status == 'Success'){
            $email = $request['Courriel'];
            $subject = "Réinitialisation de votre mot de passe";
            $message = "Madame, Monsieur,
    
Nous avons reçu une demande de réinitialisation de mot de passe pour votre compte sur le portail de fournisseurs de la ville de Trois-Rivières. Si vous n'êtes pas à l'origine de cette demande, veuillez ignorer ce message.

Pour réinitialiser votre mot de passe, veuillez cliquer sur le lien ci-dessous :
            
http://127.0.0.1:8000/Password/Reset/".$request['Courriel']."
            
Ce lien expirera dans 10 minutes. Si vous ne parvenez pas à réinitialiser votre mot de passe dans ce délai, vous devrez demander une nouvelle réinitialisation.

Si vous avez des questions ou avez besoin d'assistance supplémentaire, n'hésitez pas à nous contacter à projetv3r2024@gmail.com.
            
Cordialement,
Ville de Trois-Rivières";
    
            Mail::raw($message, function ($message) use ($email, $subject) {
                $message->to($email)
                        ->subject($subject)
                        ->from('projetv3r2024@gmail.com');
            });
        }

        return redirect()->route('index.index');
    }


}
