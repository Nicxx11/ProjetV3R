<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use App\Models\ModeleCourriel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\parametres_systeme;
use Log;

class ParametresSystemeController extends Controller
{
    public function edit()
    {
        $parametres = parametres_systeme::first();

        return view('admin.parametres', compact('parametres'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'Approvisionnement' => 'required|email|max:64',
            'DelaiRevision' => 'required|integer',
            'TailleMaxBrochures' => 'required|integer',
            'Finances' => 'required|email|max:64',
        ]);

        parametres_systeme::where('id', 1)->update([
            'Approvisionnement' => $validatedData['Approvisionnement'],
            'DelaiRevision' => $validatedData['DelaiRevision'],
            'TailleMaxBrochures' => $validatedData['TailleMaxBrochures'],
            'Finances' => $validatedData['Finances'],
        ]);

        return redirect()->route('parametres_systemes.edit')->with('success', 'Paramètres mis à jour avec succès');
    }
}
