<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
        // Validation du fichier (types et taille)
        $request->validate([
            'file' => 'required|file|mimes:jpg,png,pdf,docx|max:2048',
        ]);

        // Vérification si un fichier est téléchargé
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');

            // Générer un nom unique pour le fichier
            $uniqueFileName = session('id') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Stocker le fichier dans 'public/storage/uploads'
            $filePath = $file->storeAs('uploads', $uniqueFileName, 'public');

            // Retourner un message de succès
            return back()->with('success', 'Le fichier a été téléchargé avec succès !');
        }

        // Si le fichier n'est pas valide, retourner un message d'erreur
        return back()->with('error', 'Il y a eu un problème avec le téléchargement du fichier.');
    }

    public function showFiles()
    {
        // Récupérer tous les fichiers stockés dans le répertoire 'public/uploads'
        $files = Storage::files('public/storage/uploads');

        // Passer les fichiers à la vue
        return view('files.index', compact('files'));
    }}
