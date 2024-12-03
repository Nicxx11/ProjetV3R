<?php

namespace App\Console\Commands;

use App\Models\Fournisseur;
use App\Models\ModeleCourriel;
use App\Models\parametres_systeme;
use Illuminate\Console\Command;
use Log;

class expirationDelai extends Command
{    
    protected $signature = 'fournisseur:expiration-delai';
    protected $description = 'Notifier quand le fournisseur a été refusé il y a plus de x (délai dépassé)';
    public function handle()
    {
        $fournisseurs = Fournisseur::where('Date_Changement_Etat', '<', now()->subMonths(parametres_systeme::all()->first()->DelaiRevision))
            ->where('Etat_Demande', '=' , 'Refusée');
        
        if($fournisseurs){
            $mail = new ModeleCourriel();
            $mail->sendFournisseurEmail(parametres_systeme::all()->first()->Approvisionnement, 'Dépassement de la date de révision du fournisseur');
        } else {
            Log::info('notinn');
        }
    }
}
