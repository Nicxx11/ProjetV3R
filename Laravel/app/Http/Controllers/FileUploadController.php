<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brochure;
use Log;

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'brochure' => 'required|file|mimes:jpg,png,pdf,docx|max:250', // La taille max est maintenant 250 KB
        ]);

            $brochure = $request->file('brochure');  // Remplacer 'file' par 'Brochure'
    
            // Générer un nom unique pour le fichier
            $uniqueFileName = session('id') . '-' . uniqid() . '.' . $brochure->getClientOriginalExtension();
            Log::info($uniqueFileName);
            // Récupérer la taille du fichier en octets
            $brochureSize = $brochure->getSize();  // En octets
            Log::info($brochureSize);
            // Lire le contenu du fichier sous forme binaire
            $fileContent = file_get_contents($brochure->getRealPath());
            Log::info($fileContent);
            // Créer une nouvelle brochure dans la base de données
                Brochure::create([
                    'Nom' => $brochure->getClientOriginalName(),
                    'NomUnique' => $uniqueFileName,
                    'TypeFichier' => $brochure->getClientMimeType(),
                    'Taille' => $brochureSize,
                    'DateCreation' => now(),
                    'No_Fournisseur' => session('id'),
                    'Contenu' => $fileContent,
                ]);
                return back()->with('success', 'La brochure a été téléchargée avec succès.');
    }
    
}
