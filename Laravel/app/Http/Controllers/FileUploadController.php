<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Brochure;

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'Brochure' => 'required|file|mimes:jpg,png,pdf,docx|max:250', // La taille max est maintenant 250 KB
        ]);
    
        // Vérification si un fichier est téléchargé
        if ($request->hasFile('Brochure') && $request->file('Brochure')->isValid()) {
            $brochure = $request->file('Brochure');  // Remplacer 'file' par 'Brochure'
    
            // Générer un nom unique pour le fichier
            $uniqueFileName = session('id') . '-' . uniqid() . '.' . $brochure->getClientOriginalExtension();
    
            // Récupérer la taille du fichier en octets
            $brochureSize = $brochure->getSize();  // En octets
    
            // Lire le contenu du fichier sous forme binaire
            $fileContent = file_get_contents($brochure->getRealPath());
    
            // Créer une nouvelle brochure dans la base de données
            Brochure::create([
                'Nom' => $brochure->getClientOriginalName(),
                'TypeFichier' => $brochure->getClientMimeType(),
                'Taille' => $brochureSize,  // Taille en octets
                'DateCreation' => now(),  // Date actuelle de création
                'No_Fournisseur' => session('id'),  // Exemple d'association avec un fournisseur
                'Contenu' => $fileContent,  // Contenu du fichier sous forme binaire
            ]);
    
            // Retourner un message de succès
            return view('files.index', compact('brochure'));
        }
    
        // Si la brochure n'est pas valide, retourner un message d'erreur
        return back()->with('error', 'Il y a eu un problème avec le téléchargement de la brochure.');
    }
    
    public function download($id)
{
    // Récupérer la brochure depuis la base de données
    $brochure = \App\Models\Brochure::findOrFail($id);

    // Retourner le fichier en réponse HTTP
    return response($brochure->Contenu, 200)
        ->header('Content-Type', $brochure->TypeFichier)  // Définir le type MIME du fichier
        ->header('Content-Disposition', 'attachment; filename="' . $brochure->Nom . '"');  // Définir le nom du fichier pour le téléchargement
}
}
